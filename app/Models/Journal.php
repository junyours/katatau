<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $table = 'journals';

    protected $fillable = [
        'archive_id',
        'title',
        'author',
        'country',
        'page_number',
        'abstract',
        'keyword',
        'pdf_path',
        'doi',
        'publication_date',
    ];

    public function archive()
    {
        return $this->belongsTo(Archive::class, 'archive_id');
    }
}
