<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'mobile',
        'password',
        'role',
        'status',
    ];

    // Mutator
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        if (empty($this->attributes['username'])) {
            $baseUsername = Str::slug($value);
            $username = $baseUsername;
            $count = 1;

            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . '-' . $count++;
            }

            $this->attributes['username'] = $username;
        }
    }


    protected function store($data)
    {
        $data['password'] = Hash::make($data['password']);
        self::create($data);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    protected function updateData($data, $user)
    {
        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
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
}