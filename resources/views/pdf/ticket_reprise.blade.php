<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            margin-top: -32px;
            margin-left: -32px;
            padding: 0;
        }
        .container {
            width: 75mm;
        }
        .header, .footer {
            text-align: left;
            margin-bottom: 0;
            padding:0;
        }
        .header p:last-child{
            margin-bottom:10px;
        }
        h2, h3{
            margin-top: 2px;
            margin-bottom: 2px;
            padding: 0;
        }
        .uuid, .client{
            margin-bottom: 10px;
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
        .footer{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- En-tête du ticket -->
        @php
            $created_by = str_pad($ticket->created_by, 3, '0', STR_PAD_LEFT)
        @endphp
        <div class="header">
            <h2>Ticket de Reprise</h2>
            <h3 class='uuid'>{{ $ticket->uuid }}</h3>
            <p>Réceptionné par : {{ $created_by }}</p>
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
            <tr class="details">
                <td class="bold">Total Remboursement :</td>
                <td>{{ number_format($ticket->panier->total_remboursement, 2, ',', ' ') }} €</td>
            </tr>
            <tr class="details">
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
            <p>Veuillez faire scanner ce code-barres en caisse</p>
            <p>afin de bénéficier de votre remise ou remboursement.</p>
        </div>
    </div>
</body>
</html>