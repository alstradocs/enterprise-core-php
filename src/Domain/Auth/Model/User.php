<?php

namespace Enterprise\Domain\Auth\Model;

use Illuminate\Events\Dispatcher;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    
    protected $table = 'users';
    protected $fillable = 
    [
        'user_login',
        'user_pass',
        'user_nicename',
        'user_email',
        'user_url',
        'user_registered',
        'user_activation_key',
        'user_status',
        'display_name',
    ];
    public $timestamps = false;

    /**
     * Very important when dealing with Eloquent Events
     */
    public static function boot()
    {
        parent::boot();
        static::setEventDispatcher(new Dispatcher());
    }
}