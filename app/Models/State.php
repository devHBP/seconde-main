<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy([AccountScope::class])]
class State extends Model
{
    protected $fillable =[
        'name',
        'definition'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_states')
                    ->withPivot('prix_remboursement', 'prix_bon_achat')
                    ->withTimestamps();
    }
}