<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Impression Ticket</title>
    <script>
        window.onload = () => {
            const iframe = document.getElementById('ticket-pdf');
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        };
    </script>
</head>
<body>
    @php
        dump($ticket, $barcode);
    @endphp
    <iframe id="ticket-pdf" src="{{ route('reception.ticket.print.get', ['ticket_uuid' => $ticket , "barcode"=> $barcode]) }}" type="application/pdf" style="width:100%;height:100vh;"></iframe>
</body>
</html>