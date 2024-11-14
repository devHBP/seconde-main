<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy([AccountScope::class])]
class Client extends Model
{
    protected $fillable = [
        "lastname",
        "firstname",
        "email",
        "phone",
        "consent"
    ];

    protected $hidden =[
        "account_id",
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function paniers()
    {
        return $this->hasMany(Panier::class);
    }
}