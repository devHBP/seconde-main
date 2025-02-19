<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
        .barcode { text-align: center; margin-top: 20px; }
        .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #555; }
    </style>
</head>
<body>
    <h2>Votre Ticket</h2>
    <p>Date : {{ now()->format('d/m/Y H:i:s') }} </p>
    <p>Bonjour {{ $ticket->client->firstname }} {{ $ticket->client->lastname }},</p>

    <p>Ré édition de votre ticket de reprise</p>

    <table>
        <tr>
            <th>Produit</th>
            <th>État</th>
            <th>Quantité</th>
        </tr>
        @foreach ($ticket->panier->products as $product)
            <tr>
                <td>{{ $product->type->name }} - {{ $product->brand->name }}</td>
                <td>{{ $product->pivot->state }}</td>
                <td>{{ $product->pivot->quantity }}</td>
            </tr>
        @endforeach
    </table>

    <p>Vous avez choisis
        @if($ticket->type_utilisation === "remboursement")
            <strong>le remboursement pour un total de</strong> {{ $ticket->panier->total_remboursement }} €
        @elseif($ticket->type_utilisation === "bon_achat")
            <strong>la remise en bon d'achat pour un total de</strong> {{ $ticket->panier->total_bon_achat }} €
        @endif
    </p>

    @php
        $deactivated_by = str_pad($ticket->created_by, 3, '0', STR_PAD_LEFT)
    @endphp
    <p>Date de comsommation : {{ $ticket->deactivation_date->format('d/m/Y H:i') }}</p>
    <p>Validé par : {{ $deactivated_by }}</p>

    <div class="footer">
        <p>Merci de votre visite, tout l'équipe vous remercies, A bientôt chez {{ Auth::user()->name }}</p>
    </div>
</body>
</html>