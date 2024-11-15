<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy([AccountScope::class])]
class Panier extends Model
{

    /**
     * Ajout du status['en_cours', 'valide', 'annule', 'restitue']
     */
    protected $fillable =[
        "status",
    ];

    protected $hidden = [
        "account_id",
        "client_id",
        "total_remboursement",
        "total_bon_achat"
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_panier')
            ->withPivot('state', 'prix_remboursement', 'prix_bon_achat', 'quantity')
            ->withTimestamps();
    }
}