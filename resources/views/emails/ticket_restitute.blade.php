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
    <h2>Votre ticket n°{{ $ticket->uuid }}</h2>
    <p>Bonjour {{ $ticket->client->firstname }} {{ $ticket->client->lastname }},</p>

    <p>Votre ticket de reprise à été annulé</p>

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

    <p>Vous avez choisis d'<strong>annuler</strong></p>

    <p>Date de comsommation : {{ $ticket->deactivation_date->format('d/m/Y H:i') }}</p>
    @php
        $deactivated_by = str_pad($ticket->deactivated_by, '3', 0, STR_PAD_LEFT);
    @endphp
    <p>Validé par : {{ $deactivated_by }}</p>

    <div class="footer">
        <p>Veuillez vous rendre à l'accueil Seconde-Main de votre magasin, pour la restition de vos articles précedemment déposés.</p> 
    </div>
</body>
</html>