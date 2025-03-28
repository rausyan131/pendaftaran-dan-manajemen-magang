<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'name',
        'mahasiswa_id',
        'email',
        'password',
        
    ];

    protected $cascadeDeletes = ['mahasiswa', 'admin'];

  
    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, function ($query, $search) {

            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' .  $search . '%')
                ->orWhere('role', 'like', '%' .  $search . '%');
        });
    }
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
        'password' => 'hashed',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'nim_nisn');
    }



    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'nip');
    }


}
