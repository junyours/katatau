<?php

namespace App\Http\Controllers;

use Http;

abstract class Controller
{
    public function token()
    {
        $client_id = config('services.google.client_id');
        $client_secret = config('services.google.client_secret');
        $refresh_token = config('services.google.refresh_token');

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'refresh_token' => $refresh_token,
            'grant_type' => 'refresh_token',
        ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to get Google access token: ' . $response->body());
        }

        return $response->json()['access_token'];
    }

    public function getOrCreateFolder($accessToken, $folderName, $parentId)
    {
        $response = Http::withToken($accessToken)->get('https://www.googleapis.com/drive/v3/files', [
            'q' => "name='{$folderName}' and '{$parentId}' in parents and mimeType='application/vnd.google-apps.folder' and trashed=false",
            'fields' => 'files(id)',
        ]);

        if ($response->successful() && count($response['files']) > 0) {
            return $response['files'][0]['id'];
        }

        $create = Http::withToken($accessToken)->post('https://www.googleapis.com/drive/v3/files', [
            'name' => $folderName,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => [$parentId],
        ]);

        return $create->json()['id'];
    }

    public function renameDriveFolder($accessToken, $folderId, $newName)
    {
        $response = Http::withToken($accessToken)
            ->patch("https://www.googleapis.com/drive/v3/files/{$folderId}", [
                'name' => $newName,
            ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to rename Google Drive folder: ' . $response->body());
        }
    }
}
