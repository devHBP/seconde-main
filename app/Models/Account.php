<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'login',
        'name',
        'password',
        'icon_path'
    ];

    protected $hidden = [
        "password",
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function picture()
    {
        return $this->belongsTo(Picture::class, 'icon_path', 'id');
    }
}