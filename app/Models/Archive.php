<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $table = 'archives';

    protected $fillable = [
        'volume',
        'issue',
        'from_month',
        'to_month',
        'folder_id',
    ];

    public function journal()
    {
        return $this->hasMany(Journal::class, 'archive_id');
    }
}
