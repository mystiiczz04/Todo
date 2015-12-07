<?php
session_start();
if(isset($_SESSION['mail']))
{

    //header('Location: pageprincipal.php');
}?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TO-DO List </title>
</head>
<body>

            <form method="post" action="{{ route('inscription') }}">
                <label> Login : <input type="text" name="login" /></label>
                <label> Mot de passe : <input type="password" name="password" /></label>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <p><input type="submit" value="S'inscrire" /></p>
            </form>


</body>
</html>