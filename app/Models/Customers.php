<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;

class Customers extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = "customers";
    protected $primaryKey = "customer_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'password_confirmation',
        'bus_address',
        'city',
        'zipcode',
        'state',
        'country',
        'gstin',
        'pan',
        'bank',
        'account',
        'business',
        //'certificate' => [File::types(['pdf', 'jpg','png','gif'])]

        

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function locations()
    {
        return $this->hasMany(Locations::class);
    }

    public function bankings()
    {
        return $this->hasMany(Bankings::class);
    }

    public function firms()
    {
        return $this->hasMany(Firms::class);
    }
}
