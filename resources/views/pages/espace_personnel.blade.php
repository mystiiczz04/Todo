@extends('template.template')

@section('content')

    <br><br><br>

    <p>
        <H1>Espace personnel</H1><br>
    </p>

    <p>
            @foreach($selection as $liste)
            <b>Nom de la liste :</b> {{$liste->nomliste}}
            <a href="{{ route('updateliste',['id'=>$liste->id]) }}"><img src={{asset('images/carre-gris.jpg')}} alt="Editer"></a>
            <br>
            <b>Description :</b> {{$liste->description}}<br>
            <b>Création : </b> {{$liste->created_at}}<br>
            <br><br>


            <b>Tâche(s) en cours :</b><br>

                @foreach($taches as $tache_home)

                    @if($tache_home->liste == $liste->nomliste and $tache_home->t_done == 0)

                    {{$tache_home->tache}}<br>

                    @endif

                @endforeach

            <br><b>Tâche(s) terminée(s) :</b><br>

            @foreach($taches as $tache_home)

                @if($tache_home->liste == $liste->nomliste and $tache_home->t_done == 1)

                    {{$tache_home->tache}}<br>

                @endif

            @endforeach

            <br>
            @endforeach


    </p>


    <form action="{{ route('creation_liste') }}">
        <input type="submit" value="Nouvelle Liste">
    </form>
@endsection