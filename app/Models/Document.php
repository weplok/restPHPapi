<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['file_path', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}