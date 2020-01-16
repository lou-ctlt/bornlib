<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
    <div style="text-align: center;">
        <img class=""src="{{ asset('storage/img/logo-voiture-electrique.jpg') }}" alt="voiture">
    </div>
    <h1 style="text-align: center; margin-bottom: 3rem;">Mail de validation :</h1>
    <p>Félicitation M <span style="font-weight: bold;">{{ $contact['lastname'] }} {{ $contact['firstname'] }}</span>, vous êtes correctement enregistré sur <span style="font-weight: bold;">BORNLIB</span></p>


    {{-- <h2>Test d'email</h2>
    <ul>
      <li><strong>Nom</strong> : {{ $contact['firstname'] }}</li>
      <li><strong>Email</strong> : {{ $contact['email'] }}</li>
      <li><strong>Bravo, vous êtes correctement enregistré sur notre site :D</strong></li>
    </ul> --}}
</body>
</html>
