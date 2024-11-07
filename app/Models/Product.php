<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Phpunit\State;

#[ScopedBy([AccountScope::class])]
class Product extends Model
{
    protected $fillable = [
        'brand_id',
        'type_id'
    ];

    protected $hidden = [
        'account_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function states()
    {
        return $this->belongsToMany(State::class, 'product_state')
                    ->withPivot('prix_remboursement', 'prix_bon_achat')
                    ->withTimestamps();
    }
}