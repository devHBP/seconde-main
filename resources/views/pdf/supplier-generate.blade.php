<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bon de Livraison</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            margin-left:-40px;
            padding: 0;
            width: 100%;
        }
        .container {
            width: 260mm;
            margin: 0 auto;
            padding: 10mm;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 18px;
            text-transform: uppercase;
            margin: 0;
        }
        .header p {
            margin: 0;
            font-size: 14px;
        }
        .client-info, .supplier-info {
            margin-bottom: 10px;
            display: inline-block;
        }

        .info-title {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            margin-bottom: 3px;
        }
        .inline-container{
            width: 100%;
            padding-bottom: 110px;
        }
        .inline-container > .client-info{
            float: 45%;
            text-align: left;
        }
        .inline-container > .supplier-info{
            float: right;
            text-align: right;
            
        }
        .info-content {
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-transform: uppercase;
            font-size: 12px;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
        .footer {
            position: absolute;
            bottom: 20mm;
            width: calc(100% - 40mm);
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Bon de Livraison</h1>
            <p>Date : {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
            <p>Bon n°: {{ $ticket->uuid }}</p>
        </div>

        <div class="inline-container">
            <!-- Client Information -->
            <div class="client-info">
                <div class="info-title">Fournisseur</div>
                <div class="info-content">
                    <p>Nom : {{ $ticket->client->firstname }} {{ $ticket->client->lastname }}</p>
                    <p>Email : {{ $ticket->client->email }}</p>
                    <p>Téléphone : {{ $ticket->client->phone }}</p>
                </div>
            </div>

            <!-- Supplier Information -->
            <div class="supplier-info">
                <div class="info-title">Client</div>
                <div class="info-content">
                    <p>{{ $ticket->panier->account->name }}</p>
                    <p>SIRET ?</p>
                </div>
            </div>
        </div>

        <!-- Product Table -->
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>État</th>
                    <th>Quantité</th>
                    <th>Code Caisse</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product['designation'] }} - {{ $product['marque'] }}</td>
                    <td>{{ $product['etat'] }}</td>
                    <td>{{ $product['quantite'] }}</td>
                    <td>
                        <div>
                            @if (!empty($product['code_caisse']))
                                <img src="data:image/png;base64,{{ $product['base64']}}" alt="">
                                <p>{{ $product['code_caisse'] }}</p>
                            @else
                                <p>N/C</p>
                            @endif
                        </div>
                    </td>
                    {{-- Bon je dois tester sur une route ou je peux débug ? --}}
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>Merci de votre collaboration. Ce document est généré automatiquement.</p>
        </div>
    </div>
</body>
</html>