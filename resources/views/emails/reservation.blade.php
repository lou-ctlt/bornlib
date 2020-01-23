<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>deletedAccount</title>
</head>
<body style="text-align:center;">
    <img class=""src="{{ asset('storage/img/logo-voiture-electrique.jpg') }}" alt="voiture">
    <h2>Email d'information.</h2>
    <p>M {{ Auth::user()->lastname }} {{ Auth::user()->firstname }}</p>
    <p>Vous venez de reserver une borne, vous pouvez cliquer sur le lien suivant pour voir le trajet vers la borne dans google maps :</p>
    <img src="http://bornlib.test/storage/electric_terminal_photo/{{ $allValues["electric_terminal_photo"] }}" alt="Photo de la borne réservé"><br>
    <a href="{{ $allValues["lien"] }}" target="_blank">Votre lien</a>

    <small>Cet email vous a été envoyé par Bornlib pour vous informez du suivie de votre compte.</small>
</body>
</html>
