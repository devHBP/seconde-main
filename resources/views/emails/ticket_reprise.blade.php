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
    <h2>Votre Ticket de Reprise</h2>
    <p>Bonjour {{ $ticket->client->firstname }} {{ $ticket->client->lastname }},</p>

    <p>Voici le récapitulatif de votre ticket :</p>

    <table>
        <tr>
            <th>Produit</th>
            <th>État</th>
            <th>Quantité</th>
            <th>Prix Remboursement</th>
            <th>Prix Bon d'Achat</th>
        </tr>
        @foreach ($ticket->panier->products as $product)
            <tr>
                <td>{{ $product->type->name }} - {{ $product->brand->name }}</td>
                <td>{{ $product->pivot->state }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ $product->pivot->prix_remboursement }} €</td>
                <td>{{ $product->pivot->prix_bon_achat }} €</td>
            </tr>
        @endforeach
    </table>

    <p><strong>Total Remboursement :</strong> {{ $ticket->panier->total_remboursement }} €</p>
    <p><strong>Total Bon d'Achat :</strong> {{ $ticket->panier->total_bon_achat }} €</p>

    <div class="barcode">
        <h3>Votre Code-Barres :</h3>
        <img src="{{ $message->embedData($barcodeBase64, $filename, 'image/png') }}" alt="Code-barres">
        <p>{{$ticket->uuid}}</p>
    </div>

    <p>Date de création : {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
    <p>Date limite de validité : {{ $ticket->date_limite->format('d/m/Y H:i')}}</p>
    <p>Crée par : {{ $ticket->createdBy->name }}</p>

    <div class="footer">
        <p>Merci de présenter ce ticket en caisse pour bénéficier de votre reprise.</p>
    </div>
</body>
</html>