<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Http;
use Illuminate\Http\Request;

class EditorialBoard extends Controller
{
    public function index()
    {
        $editors = User::query()->where('role', 'editor')
            ->orderByRaw("
            CASE 
                WHEN position = 'Editorial in Chief' THEN 1
                WHEN position = 'Associate Editor' THEN 2
                WHEN position = 'Editorial Board' THEN 3
                ELSE 4
            END
        ")
            ->get();

        return view('pages.app.editorial-board.index', compact('editors'));
    }

    public function create()
    {
        return view('pages.app.editorial-board.create');
    }

    public function add(Request $request)
    {
        $accessToken = $this->token();

        $request->validate([
            'profile_picture' => ['required', 'mimes:jpeg,jpg,png', 'max:2048'],
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'position' => ['required'],
            'department' => ['required']
        ]);

        $mainFolder = $this->getOrCreateFolder($accessToken, 'Users', config('services.google.folder_id'));
        $subFolder = $this->getOrCreateFolder($accessToken, 'Editorial Board', $mainFolder);

        $file = $request->file('profile_picture');
        $mimeType = $file->getMimeType();

        $metadata = [
            'name' => 'temp_' . time(),
            'parents' => [$subFolder],
        ];

        $uploadResponse = Http::withToken($accessToken)
            ->attach('metadata', json_encode($metadata), 'metadata.json', ['Content-Type' => 'application/json'])
            ->attach('media', file_get_contents($file), $file->getClientOriginalName(), ['Content-Type' => $mimeType])
            ->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart');

        if ($uploadResponse->successful()) {
            $fileId = $uploadResponse->json()['id'];

            Http::withToken($accessToken)->patch("https://www.googleapis.com/drive/v3/files/{$fileId}", [
                'name' => $fileId,
            ]);

            Http::withToken($accessToken)->post("https://www.googleapis.com/drive/v3/files/{$fileId}/permissions", [
                'role' => 'reader',
                'type' => 'anyone',
            ]);

            User::create([
                'profile_picture' => $fileId,
                'name' => $request->name,
                'email' => $request->email,
                'position' => $request->position,
                'department' => $request->department,
                'role' => 'editor'
            ]);

            return redirect()->back()->with('success', 'Editor added successfully!');
        }
    }

    public function edit($id)
    {
        $editor = User::findOrFail($id);

        return view('pages.app.editorial-board.edit', compact('editor'));
    }

    public function update(Request $request, $id)
    {
        $accessToken = $this->token();

        $editor = User::findOrFail($id);

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $editor->id],
            'position' => ['required'],
            'department' => ['required']
        ]);

        $editor->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'department' => $request->department,
        ]);

        if ($request->hasFile('profile_picture')) {
            $request->validate([
                'profile_picture' => ['mimes:jpeg,jpg,png', 'max:2048']
            ]);

            Http::withToken($accessToken)->delete("https://www.googleapis.com/drive/v3/files/{$editor->profile_picture}");

            $mainFolder = $this->getOrCreateFolder($accessToken, 'Users', config('services.google.folder_id'));
            $subFolder = $this->getOrCreateFolder($accessToken, 'Editorial Board', $mainFolder);

            $file = $request->file('profile_picture');
            $mimeType = $file->getMimeType();

            $metadata = [
                'name' => 'temp_' . time(),
                'parents' => [$subFolder],
            ];

            $uploadResponse = Http::withToken($accessToken)
                ->attach('metadata', json_encode($metadata), 'metadata.json', ['Content-Type' => 'application/json'])
                ->attach('media', file_get_contents($file), $file->getClientOriginalName(), ['Content-Type' => $mimeType])
                ->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart');

            if ($uploadResponse->successful()) {
                $fileId = $uploadResponse->json()['id'];

                Http::withToken($accessToken)->patch("https://www.googleapis.com/drive/v3/files/{$fileId}", [
                    'name' => $fileId,
                ]);

                Http::withToken($accessToken)->post("https://www.googleapis.com/drive/v3/files/{$fileId}/permissions", [
                    'role' => 'reader',
                    'type' => 'anyone',
                ]);

                $editor->update([
                    'profile_picture' => $fileId,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Editor updated successfully!');
    }
}
