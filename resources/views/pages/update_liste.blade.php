@extends('template.template')

@section('content')

    <div class="main_nouvelle_liste">
    <H1 class="titre_nouvelle_liste">Edition de liste</H1><br>


    <form method="post" accept-charset="UTF-8" action="{{ route('updateliste',['id'=>$liste->id]) }}">
        <Label>Nom de la liste : <input type="text" name="liste" value="{{$liste->nomliste}}"></Label><br>
        <Label>Description : </Label><br>

        <textarea name="description" style="resize:none" rows="4" cols="50">{{$liste->description}}</textarea>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" /><br>
        <input type="submit" value="Modifier">

    </form>
    </div>

@endsection