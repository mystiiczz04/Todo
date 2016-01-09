@extends('template.template')

@section('content')


    <div class="main_nouvelle_tache">
        <H1 class="titre_nouvelle_tache">Ajout d'une tâche</H1>

        <b>Liste de tâche(s) : </b>  {{$nomliste->nomliste}}

        <br><br>
    <form method="post" accept-charset="UTF-8" action="{{ route('creation_tâche_soumission')}}">

        <label> Tâche : <input type="text" name="nomtache" placeholder="Nom de la tâche" required/></label><br>
        <label> Échéance : <input type="date" name="date" required></label>

        <input type="hidden" name="nomliste" value="{{$nomliste->nomliste}}" />
        <input type="hidden" name="done" value= "0"/>
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" /><br>
        <input type="submit" value="Creer">

    </form>
    </div>



@endsection