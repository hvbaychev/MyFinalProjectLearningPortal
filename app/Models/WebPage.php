<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebPage extends Model
{
    protected $table = 'web_pages';
    
    protected $fillable = ['user_id', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
