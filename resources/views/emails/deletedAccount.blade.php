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
    <p>Votre compte BORNLIB a bien été supprimé.</p>

    <small>Cet email vous a été envoyé par Bornlib pour vous informez du suivie de votre compte.</small>
</body>
</html>
