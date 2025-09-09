<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
    protected $guard_name = 'web';
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'birthdate',
        'password',
        'active_status',
        'system_status',
        'user_current_balance',
        'type'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ScopeIsSystemStatusActive($query)
    {
        return $query->where('system_status', 'active');
    }

    public function ScopeIsSystemStatusBlocked($query)
    {
        return $query->where('system_status', 'blocked');
    }

    public function ScopeIsStatusActive($query)
    {
        return $query->where('active_status', 'active');
    }

    public function ScopeIsStatusDeactive($query)
    {
        return $query->where('active_status', 'deactive');
    }

    public function getActiveOrdersCountAttribute()
    {
        return $this->orders()->where('barcode_status', 'not_used')->count();
    }

    public function user_balance_history()
    {
        return $this->hasMany(UserBalanceHistory::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'user_id', 'id');
    }

}
