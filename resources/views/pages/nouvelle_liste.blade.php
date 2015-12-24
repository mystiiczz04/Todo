@extends('template.template')

@section('content')
<br><br><br>
    <p>

    Nouvelle Liste  <br>
        <form method="post" accept-charset="UTF-8" action="{{ route('creation_liste') }}">

            <label> Liste de taches : <input type="text" name="nomliste" placeholder="Nom de la liste" required/></label><br>
            <label> Description : </label><br>
            <textarea name="description" style="resize:none" rows="4" cols="50" placeholder="Décrivez votre liste"></textarea>

            <input type="hidden" name="user" value="{{Auth::user()->id}}" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}" /><br><br>
            <input type="submit" value="Créer">

        </form>

    </p>