<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            margin-top: -35px;
            margin-left: -38px;
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
            <h3>{{ Auth()->user()->name }}</h3>
            <h4>Ticket de Reprise <span class="block">n°{{ $ticket->uuid }}</span></h4>
            <p>Validé par : {{ $ticket->deactivated_by }}</p>
            <p>Consommé le : {{ $ticket->deactivation_date->format('d/m/Y H:i') }}</p>
        </div>
        <div class="client">
            <h4>Client</h4>
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
            @if($ticket->type_utilisation === "remboursement")
                <tr>
                    <td class="bold">Vous avez choisis le remboursement d'un total de:</td>
                </tr>
                <tr>
                    <td>{{ number_format($ticket->panier->total_remboursement, 2, ',', ' ') }} €</td>
                </tr>
            @elseif ($ticket->type_utilisation === "bon_achat")
                <tr>
                    <td class="bold">Vous avez choisis la remise en bon d'achat pour un total de :</td>  
                </tr>
                <tr>
                    <td>{{ number_format($ticket->panier->total_bon_achat, 2, ',', ' ') }} €</td>
                </tr>
            @endif
        </table>
        <hr>

        <!-- Pied de page -->
        <div class="footer">
            <p>Merci de votre visite !</p>
        </div>
    </div>
</body>
</html>