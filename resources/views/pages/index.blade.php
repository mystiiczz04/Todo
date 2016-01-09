@extends('template.template')

@section('content')

<div id="main_index">

    <h1 id="titre_index">Bienvenue sur TodoTracker !!!</h1>

    <div id="text_index">
        Ici, vous pourrez créer votre liste de tâches à faire, les executer, les valider ! <br><br>
        Qu'attendez-vous pour vous créer un compte !?

    </div>

    <div id="boutons_index">

        <a href="{{ route('inscription') }}"><button class="btn btn-info">Inscription</button></a>
        <a href="{{ route('login') }}"><button class="btn btn-info">Connexion</button></a>

    </div>

</div>
@endsection