<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $fillable = ['user_id', 'lecture_id', 'reason', 'note', 'disregarded'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}
