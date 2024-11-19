<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            margin-top: -35px;
            margin-left: -35px;
            padding: 0;
        }
        .container {
            width: 75mm;
        }
        .header, .footer {
            text-align: left;
            margin-bottom: 5px;
        }
        h2{
            margin-bottom: 2px;
        }
        .content {
            margin-bottom: 5px;
        }
        .client h3, p{
            margin-bottom: 2px;
            margin-top: 1px;
            padding-bottom: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 2px 0;
        }
        td>span{
            display:block;
        }
        .details {
            text-align: left;
        }
        .details td:last-child {
            text-align: right;
        }
        .states{
            font-size: 9px;
            font-weight: bold;
        }
        .bold {
            font-weight: bold;
        }
        hr {
            border: 0.5px dashed #000;
            margin: 5px 0;
        }
        .barcode {
            text-align: center;
            margin-top: 10px;
        }
        .barcode img {
            width: 90%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- En-tête du ticket -->
        <div class="header">
            <h2>Ticket de Reprise</h2>
            <p>Réceptionné par : {{ $ticket->created_by_name }}</p>
            <p>Date : {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
            <p>Date de Validité : {{ $ticket->date_limite->format('d/m/Y H:i')}}</p>
        </div>
        <div class="client">
            <h3>Client</h3>
            <p>{{ $ticket->client->firstname }} {{ $ticket->client->lastname }}</p>
            <p>{{ $ticket->client->email }}</p>
            <p>{{ $ticket->client->phone}}</p>
        </div>
        <hr>

        <!-- Détails du panier -->
        <table class="content">
            <th>
                <tr class="details">
                    <td>Designation</td>
                    <td>
                        Qty | Remb. | B.A.
                    </td>
                </tr>
            </th>
            @foreach ($ticket->panier->products as $product)
            <tr class="details">
                <td>{{ $product->type->name }} - {{ $product->brand->name }} <span class="states">{{ $product->pivot->state }}</span></td>
                <td>{{ $product->pivot->quantity }} x {{ number_format($product->pivot->prix_remboursement, 2, ',', ' ') }} | {{ number_format($product->pivot->prix_bon_achat, 2, ',', ' ') }} €</td>
            </tr>
            @endforeach
        </table>
        <hr>

        <!-- Totaux -->
        <table>
            <tr>
                <td class="bold">Total Remboursement :</td>
                <td>{{ number_format($ticket->panier->total_remboursement, 2, ',', ' ') }} €</td>
            </tr>
            <tr>
                <td class="bold">Total Bon d'Achat :</td>
                <td>{{ number_format($ticket->panier->total_bon_achat, 2, ',', ' ') }} €</td>
            </tr>
        </table>
        <hr>

        <!-- Code-barres -->
        <div class="barcode">
            <img src="data:image/png;base64,{{ $barcode }}" alt="Code-barres">
        </div>
        <hr>

        <!-- Pied de page -->
        <div class="footer">
            <p>Merci de votre visite !</p>
        </div>
    </div>
</body>
</html>