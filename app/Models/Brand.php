<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;


#[ScopedBy([AccountScope::class])]
class Brand extends Model
{
    protected $fillable = [
        "name",
        "icon_path"
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function picture()
    {
        return $this->belongsTo(Picture::class, 'icon_path', 'id');
    }
}