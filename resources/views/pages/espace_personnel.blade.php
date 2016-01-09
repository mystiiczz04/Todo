@extends('template.template')

@section('content')

        <H1 id="titre_espace">Espace personnel</H1>

            @foreach($selection as $liste)
            <div id="liste_espace">
            <b>Nom de la liste :</b> {{$liste->nomliste}}
            <a href="{{ route('updateliste',['id'=>$liste->id]) }}"><button class="btn btn-group-lg">Editer</button></a>
            <br>
            <b>Description :</b> {{$liste->description}}<br>
            <b>Création : </b> {{$liste->created_at}}<br>
            </div>

            <div id="cours_espace">
            <b>Tâche(s) en cours :</b><br>

                @foreach($taches as $tache_home)

                    @if($tache_home->liste == $liste->nomliste and $tache_home->t_done == 0)

                    {{$tache_home->tache}}<br>

                    @endif

                @endforeach
            </div>
            <div id="done_espace">
            <b>Tâche(s) terminée(s) :</b><br>

            @foreach($taches as $tache_home)

                @if($tache_home->liste == $liste->nomliste and $tache_home->t_done == 1)

                    {{$tache_home->tache}}<br>

                @endif

            @endforeach
            </div>

            @endforeach


    <form id="bouton_espace" action="{{ route('creation_liste') }}">
        <input type="submit" value="Nouvelle Liste">
    </form>
@endsection