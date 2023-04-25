<?php

namespace App\Models\Admin;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone_number',
        'id_card_name',
        'id_card_number',
        'gender',
        'current_address',
        'channel_id',
        'device',
        'login_status',
        'bank_card_number',
        'bank_account',
        'family_relationship',
        'family_name',
        'family_phone_number',
        'family_relationship',
        'friend_name',
        'friend_phone_number',
        'work_experience',
        'work_income',
        'work_address',
        'loan_way',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $table = 'user';

    public $timestamps = true;
}