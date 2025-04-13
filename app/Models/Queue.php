<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = ['start_time', 'title', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}