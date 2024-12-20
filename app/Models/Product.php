<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
//use NunoMaduro\Collision\Adapters\Phpunit\State;

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
        return $this->belongsToMany(State::class, 'product_states')
                    ->withPivot('prix_remboursement', 'prix_bon_achat', 'code_caisse')
                    ->withTimestamps();
    }

    public function paniers()
    {
        return $this->belongsToMany(Panier::class, 'product_panier')
            ->with('prix_remboursement', 'prix_bon_achat', 'state', 'quantity')
            ->withTimeStamps();
    }
}