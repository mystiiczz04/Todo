@extends('template.test')

@section('content')

    <p>

    Nouvelle Liste : <br>
        <form method="post" action="{{ route('hometache') }}">

            <label> Tâches : <input type="text" name="nomtache" /></label>
            <input type="hidden" name="user" value="{{Auth::user()->id}}" />
            <input type="hidden" name="done" value= "0"/>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="submit" value="Soumettre">

        </form>

    </p>