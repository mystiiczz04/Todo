@extends('template.template')

@section('content')

    <br><br><br>
    <p>

        <H1>Ajout d'une tâche</H1><br>

        <b>Liste de tâche(s) : </b>  {{$nomliste->nomliste}}


        <br><br>
    <form method="post" accept-charset="UTF-8" action="{{ route('creation_tâche_soumission')}}">

        <label> Tâche : <input type="text" name="nomtache" placeholder="Nom de la tâche" required/></label><br>
        <label> Echeance : <input type="date" name="date" required></label>

        <input type="hidden" name="nomliste" value="{{$nomliste->nomliste}}" />
        <input type="hidden" name="done" value= "0"/>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" /><br>
        <input type="submit" value="Creer">


    </form>

    </p>



@endsection