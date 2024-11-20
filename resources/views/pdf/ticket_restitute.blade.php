<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            margin-top: -30px;
            margin-left: -30px;
            padding: 0;
        }
        .container {
            width: 75mm;
        }
        .header, .footer {
            text-align: left;
            margin-bottom: 2px;
        }
        .client h3, p{
            margin-bottom: 2px;
            margin-top: 1px;
            padding-bottom: 0;
        }
        .content {
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .state{
            display: block;
            font-size: 9px;
            font-weight: bold;
        }
        td {
            padding: 2px 0;
        }
        .details {
            text-align: left;
        }
        .details td:last-child {
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }
        hr {
            border: 0.5px dashed #000;
            margin: 5px 0;
        }
        .block{
            display:block;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- En-tête du ticket -->
        <div class="header">
            <h2>Ticket de Reprise <span class="block">n°{{ $ticket->uuid }}</span></h2>
            @php
                $deactivated_by = str_pad($ticket->deactivated_by, 3, 0, STR_PAD_LEFT)
            @endphp
            <p>Validé par : {{ $deactivated_by }}</p>
            <p>Consommé le : {{ $ticket->deactivation_date->format('d/m/Y H:i') }}</p>
        </div>
        <div class="client">
            <h3>Client</h3>
            <p>{{ $ticket->client->firstname}} {{ $ticket->client->lastname }}</p>
            <p>{{ $ticket->client->email }}</p>
            <p>{{ $ticket->client->phone }}</p>
        </div>
        <hr>

        <!-- Détails du panier -->
        <table class="content">
            @foreach ($ticket->panier->products as $product)
            <tr class="details">
                <td>{{ $product->type->name }} - {{ $product->brand->name }} <span class="state">{{ $product->pivot->state }}</span></td>
                <td>x {{ $product->pivot->quantity }}</td>
            </tr>
            @endforeach
        </table>
        <hr>

        <!-- Totaux -->
        <table>
            <tr>
                <td>Vous avez choisis l'annulation</td>
            </tr>
        </table>
        <hr>

        <!-- Pied de page -->
        <div class="footer">
            <p>Nous vous invitons à vous diriger</p>
            <p>vers l'accueil Seconde Main de votre magasin</p>
            <p>afin de procéder à la restitution</p>
            <p>Merci de votre visite !</p>
        </div>
    </div>
</body>
</html>