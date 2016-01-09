@extends('template.template')

@section('content')

    <div class="main_nouvelle_liste">
        <h1 class="titre_nouvelle_liste">Nouvelle Liste</h1>

        <form method="post" accept-charset="UTF-8" action="{{ route('creation_liste') }}">

            <label> Liste de taches : <input type="text" name="nomliste" placeholder="Nom de la liste" required/></label><br>
            <label> Description : </label><br>
            <textarea name="description" style="resize:none" rows="4" cols="50" placeholder="Décrivez votre liste"></textarea>
            <br>
            <b>La liste existe déjà, veuillez entrer un nom de liste différent</b>
            <input type="hidden" name="user" value="{{Auth::user()->id}}" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}" /><br><br>
            <input type="submit" value="Créer">

        </form>
    </div>
