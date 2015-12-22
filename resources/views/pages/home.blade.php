@extends('template.test')

@section('content')
	<br>
	<br>
	<br>
	<br>

	<H1>Liste de tâches en cours : </H1><br>

	@foreach($liste_unique as $liste_home)

	<br>	<p><b>{{$liste_home->nomliste}}</b>
	<a href="{{ route('updateliste',['id'=>$liste_home->id]) }}"><img src={{asset('images/edit.png')}} alt="Editer"></a>
	<img src={{asset('images/validation.jpg')}} alt="Valider">
	<img src={{asset('images/delete.png')}} alt="Effacer">
	<br>
		@foreach($selection as $tache_home)

			@if($tache_home->liste == $liste_home->nomliste)

				{{$tache_home->tache}} <br>


			@endif

		@endforeach
			</p>
	@endforeach






@endsection