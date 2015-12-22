@extends('template.test')

@section('content')
    <br><br><br>


    <H1>Edition de tâche</H1><br>


    <form method="post" accept-charset="UTF-8" action="{{route('updatetache',['id'=>$tache->id])}}">
        <b>Nom de la liste : </b>{{$tache->liste}}<br>
        <input type="text" name="tache" value="{{$tache->tache}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" /><br>
        <input type="submit" value="Modifier">

    </form>

@endsection