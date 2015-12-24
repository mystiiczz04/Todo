@extends('template.template')

@section('content')
    <br><br><br>


    <H1>Edition de tâche</H1><br>


    <form method="post" accept-charset="UTF-8" action="{{route('updatetache',['id'=>$tache->id])}}">
        <label><b>Nom de la liste : </b></label>{{$tache->liste}}<br>

        <input type="text" name="tache" value="{{$tache->tache}}"><br>
        <input type="date" name="date" value="{{$tache->date}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" /><br>
        <input type="submit" value="Modifier">

    </form>

@endsection