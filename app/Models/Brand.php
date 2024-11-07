<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;


#[ScopedBy([AccountScope::class])]
class Brand extends Model
{
    protected $fillable = [
        "name"
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}