@extends('template.template')

@section('content')
	<br>
	<br>
	<br>
	<br>

	<H1>Liste de tâches en cours : </H1><br>

	@foreach($liste_unique as $liste_home)

	<br>	<p><b>{{$liste_home->nomliste}}</b>
	<a href="{{ route('updateliste',['id'=>$liste_home->id]) }}"><img src={{asset('images/carre-gris.jpg')}} alt="Editer"></a>
	<a href="{{ route('creation_tâche',['id'=>$liste_home->id]) }}"><img src={{asset('images/plus.jpg')}} alt="Ajouter"></a>
	<a href="{{ route('deleteliste',['id'=>$liste_home->id]) }}"><img src={{asset('images/carre-rouge.jpg')}} alt="Effacer"></a>
	<br>
		@foreach($selection as $tache_home)

			@if($tache_home->liste == $liste_home->nomliste)

				{{$tache_home->tache}}

				<a href="{{ route('updatetache',['id'=>$tache_home->tache_id]) }}"><img src={{asset('images/carre-gris.jpg')}} alt="Editer"></a>
				<a href="{{ route('validationtache',['id'=>$tache_home->tache_id]) }}"><img src={{asset('images/carre-vert.jpg')}} alt="Valider"></a>
				<a href="{{ route('deletetache',['id'=>$tache_home->tache_id]) }}"><img src={{asset('images/carre-rouge.jpg')}} alt="Effacer"></a>
				{{$tache_home->date}}
				<br>


			@endif

		@endforeach
			</p>
	@endforeach






@endsection