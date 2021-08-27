<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mail</title>
    </head>
    <style>
        html, body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
        }
    </style>
    <body>
        <img src="{{ URL::asset('assets/images/logo2.png') }}" alt="logo" width="150"><br /><br />
        Félicittions {{ $name }} !<br />
        Nous vous informons que votre compte a été créé avec succès.<br />
        Vous pouvez dorénavant faire des opérations de troc, de partage
        de biens ou services sur la plate-forme. Ci-dessous vous trouverez vos clés (privée et publique)
        pour les différentes opérations marchandes au cours des quelles vous aurez besoin
        d'uilisez votre porte-feuille d'URYAs.<br /><br />

        <b>Vous devez gardez ces clés en lieu sûr. Leurs pertes ne sont en aucun cas réversible !</b><br /><br />
        Clé privée : {{ $cle_privee }}<br />
        Clé publique : {{ $cle_publique }}
    </body>
</html>
