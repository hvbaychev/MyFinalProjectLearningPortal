<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;


class User extends Model implements Authenticatable
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'user_type',
        'organization',
        'avatar',
        'user_cv',
        'phone',
        'info',
        'language_id',
        'country_id',
        'city_id',
    ];

    protected $hidden = [
        'password',
    ];


    public function user_type()
    {
        return $this->belongsTo(UserType::class);
    }


    public function courses()
    {
        return $this->belongsToMany(Course::class, 'users_courses')->withPivot('id', 'status')->withTimestamps();
    }

    public function userHomeworkTasks()
    {
        return $this->hasMany(UserHomeworkTask::class, 'user_id');
    }

    public function userLanguages()
    {
        return $this->hasMany(UserLanguage::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function repositories()
    {
        return $this->hasMany(Repository::class);
    }

    public function webPages()
    {
        return $this->hasMany(WebPage::class);
    }

    public function messengerNames()
    {
        return $this->hasMany(MassangerName::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function hobbies()
    {
        return $this->hasMany(Hobby::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function lectures()
{
    return $this->belongsToMany(Lecture::class);
}

}

