@extends('template.template')

@section('content')

		<H1 id="titre_home">Liste de tâches en cours</H1><br>




	@foreach($liste_unique as $liste_home)
		<div id="conteneur_liste_home">
			<div id="liste_home">
				<b>{{$liste_home->nomliste}}</b>
			</div>
			<div id="liste_boutons_home">
				<a href="{{ route('updateliste',['id'=>$liste_home->id]) }}"><button class="btn btn-group-lg">Editer</button></a>
				<a href="{{ route('creation_tâche',['id'=>$liste_home->id]) }}"><button class="btn btn-info">Créer</button></a>
				<a href="{{ route('deleteliste',['id'=>$liste_home->id]) }}"><button class="btn btn-danger">Supprimer</button></a>
			</div>
		</div>


		@foreach($selection as $tache_home)

			@if($tache_home->liste == $liste_home->nomliste)
			<div id="conteneur_tache_home">
				<div id="tache_home">{{$tache_home->tache}}</div>

				<div id="boutons">
					<a href="{{ route('updatetache',['id'=>$tache_home->tache_id]) }}"><button class="btn btn-group-lg">Editer</button></a>
					<a href="{{ route('validationtache',['id'=>$tache_home->tache_id]) }}"><button class="btn btn-success">Valider</button></a>
					<a href="{{ route('deletetache',['id'=>$tache_home->tache_id]) }}"><button class="btn btn-danger">Supprimer</button></a>
				</div>
				<div id="echeance"><b>Echéance:</b> {{$tache_home->date}}</div>
			</div>
			@endif

		@endforeach

	@endforeach

@endsection