@extends('template.template')

@section('content')

    <div class="main_nouvelle_tache">
    <H1 class="titre_nouvelle_tache">Edition de tâche</H1>

    <form method="post" accept-charset="UTF-8" action="{{route('updatetache',['id'=>$tache->id])}}">
        <label><b>Nom de la liste : </b></label>{{$tache->liste}}<br>

        <input type="text" name="tache" value="{{$tache->tache}}" required><br>
        <input type="date" name="date" value="{{$tache->date}}" required>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" /><br>
        <input type="submit" value="Modifier">

    </form>
    </div>

@endsection