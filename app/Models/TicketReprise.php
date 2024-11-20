<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[ScopedBy([AccountScope::class])]
class TicketReprise extends Model
{
    protected $table = "tickets_reprise";
    protected $fillable = [
        "uuid",
        "client_id",
        "panier_id",
        "created_by",
        "deactivated_by",
        "created_by_name",
        "deactivated_by_name",
        "type_utilisation",
        "date_limite",
        "deactivation_date",
        "is_activated"
    ];

    protected $hidden = [
        'account_id'
    ];

    protected $casts = [
        'is_activated' => 'boolean',
        'date_limite' => 'datetime',
        'deactivation_date' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function panier()
    {
        return $this->belongsTo(Panier::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function deactivatedBy()
    {
        return $this->belongsTo(User::class, 'deactivated_by');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($ticket){
            //$ticket->uuid = Str::uuid();

            /** TODO Pour plus tard, quand il sera possible de paramétrer les options de l'account */
            // $account = auth()->user();
            // if($account){
            //     $settings = AccountSettings::where('account_id', $account->id);
            //     $exprirationsDelay = $settings->expiration_delay ?? 1;
            //     $ticket->date_limite = now()->addDays($exprirationsDelay);
            // }
            // else{
            //     $ticket->date_limite = now()->endOfDay();
            // }
            $ticket->date_limite = now()->endOfDay();
        });
    }
}