@extends('template.test')

@section('content')
    <br><br><br>


    <H1>Edition de liste</H1><br>


    <form method="post" accept-charset="UTF-8" action="{{ route('updateliste') }}">
        <Label>Nom de la liste : <input type="text" name="liste" value="{{$liste->nomliste}}"></Label><br>
        <Label>Description : <input type="text" name="description" value="{{$liste->description}}"></Label><br>

        <Label>Liste des tâches à modifier:</Label><br>


        @foreach($liste_tache as $tache_home)

            @if($tache_home->nomliste == $liste->nomliste)

                <input type="text" name="" value="{{$tache_home->tache}} ">
                <br>

            @endif

        @endforeach


        <input type="hidden" name="_token" value="{{ csrf_token() }}" /><br>
        <input type="submit" value="Modifier">

    </form>












@endsection