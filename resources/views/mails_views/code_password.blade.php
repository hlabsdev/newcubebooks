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
        <img src="{{ URL::asset('assets/images/cubebooks.jpg') }}" alt="logo" width="150"><br /><br />
        Chèr utlilisateur,<br />
        Nous vous informons que votre email a été renseigné sur le plate-fome
        "CUBE BOOKS" pour une reqête de crétion de compte.<br /><br />

        Cliquez sur le lien suivant pour contrinuer<br />
        <a href="https://cubebooks.saeicube.com/register/password?email={{ $email }}&code={{ $code }}">https://cubebooks.saeicube.com/register/password?email={{ $email }}&code={{ $code }}</a>
    </body>
</html>