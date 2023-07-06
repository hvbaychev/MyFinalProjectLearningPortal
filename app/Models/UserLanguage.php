<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'user_languages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'language_id',
        'level_id',
    ];

    /**
     * Get the user that owns the language.
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Get the language associated with the user language.
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function level()
    {
        return $this->belongsTo(LanguageLevel::class);
    }
}
