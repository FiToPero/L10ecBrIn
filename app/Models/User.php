<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Role;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'company',
        'email',
        'password',
        'password_confirmation',
        'profile_photo_path',
        'role_id',
    ];
  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'password_confirmation',
        'remember_token',
        'role_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role){
        return $this->role()->where('name', $role)->exists();
    }

    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new \App\Notifications\CustomVerifyEmail);
    // }


    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        // 'profile_photo_url',
    ];


    // /**
    //  * Accessor para obtener la URL de la foto de perfil del usuario.
    //  * Esto permite que 'profile_photo_url' aparezca en el array/JSON del modelo.
    //  */
    // public function getProfilePhotoUrlAttribute()
    // {
    //     if ($this->profile_photo_path) {
    //         // Si el usuario tiene una foto subida, devuelve la URL pública
    //         return asset('storage/' . $this->profile_photo_path);
    //     }
    //     // Si no tiene foto, devuelve un avatar por defecto
    //     return 'https://ui-avatars.com/api/?name=' . urlencode($this->first_name . ' ' . $this->last_name);
    // }


    

}


  







