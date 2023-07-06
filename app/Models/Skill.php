<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    protected $fillable = ['user_id', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
