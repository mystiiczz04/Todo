@extends('template.test')

@section('content')

    <br><br><br>

    <p>
        <H1>Espace personnel</H1><br>
    </p>

    <p>
            @foreach($selection as $liste)

            Nom de la liste :  {{$liste->nomliste}} <br>
            Description : {{$liste->description}}<br>

            @endforeach


    </p>


    <form action="{{ route('creation_liste') }}">
        <input type="submit" value="Nouvelle Liste">
    </form>
@endsection