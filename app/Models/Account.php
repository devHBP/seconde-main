<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Account extends Authenticatable
{
    use HasFactory, Notifiable, HasSlug;


    protected $fillable = [
        'login',
        'name',
        'password',
        'icon_path',
        /* Ajouts feature full custom */
        'header_background',
        'header_title',
        'header_subtitle',
        'header_button_background',
        'header_button_font',
        'subheader_background',
        'subheader_title',
        'subheader_subtitle',
        'subheader_button',
        'subheader_button_font',
        'main_background',
        'main_cards_background',
        'main_cards_title',
        'main_cards_font',
        'main_cards_svg',
        'main_cards_button',
        'pattern_logo'
    ];

    protected $hidden = [
        "slug",
        "password",
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function($model){
                return str_replace('/', '-', $model->name);
            })
            ->saveSlugsTo('slug')
            ->usingLanguage('fr');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function picture()
    {
        return $this->belongsTo(Picture::class, 'pattern_logo', 'id');
    }
}