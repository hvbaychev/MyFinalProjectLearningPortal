<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $table = 'hobbies';
    
    protected $fillable = ['user_id', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
