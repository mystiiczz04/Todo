<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Liste;


//use Illuminate\Support\Facades\Request;

class LinksController extends Controller
{

    public function index()
    {
        return view('auth/register');

    }

    //accede a la page de creation de listes de taches
    public function creation_liste()
    {
      return view('/pages/nouvelle_liste');
    }

    //gestion du formulaire de creation de listes de taches
    public function creation_liste_soumission(Request $req)
    {
        $param=$req->except(['_token']);

        $liste = new \App\Liste;
        $liste->user_id=$param['user'];
        $liste->nomliste=$param['nomliste'];
        $liste->description=$param['description'];
        $liste->done=$param['done'];
        $liste->save();
        return redirect()->route('home');

    }

    //accede a la page de creation de listes de taches
    public function creation_tâche($id)
    {
        $liste_tâche = Liste::find($id);

        return view('/pages/nouvelle_tache') ->with('nomliste', $liste_tâche);
    }

    public function creation_tâche_soumission(Request $req)
    {
        $param=$req->except(['_token']);

        $tache = new \App\Tache;
        $tache->liste=$param['nomliste'];
        $tache->tache=$param['nomtache'];

        $tache->done=$param['done'];
        $tache->save();
        return redirect()->route('home');

    }

    public function updateliste(Request $req,$id){
        $link=Liste::find($id);

        $liste_taches = DB::table('listes')
            ->join('taches' , 'taches.liste' ,'=' , 'listes.nomliste')

            ->select('listes.user_id as id',
                'listes.nomliste as nomliste',
                'taches.tache as tache',
                'taches.liste as liste'
            )
            ->where('listes.user_id' ,'=', Auth::user()->id)
            ->get();




        if($req->isMethod('post')) {
            //$parametres=$req->except(['_token']);
            //$link->nom=$parametres['nom'];
            //$link->link=$parametres['lien'];
            //$link->description=$parametres['description'];
            //$link->save();
            return redirect()->route('home');
        }

        return view('pages/update')->with(array(
            'liste_tache' => $liste_taches,
            'liste' => $link
            ));


    }



    public function home()
    {

        $liste_home = DB::table('listes')
            ->join('taches' , 'taches.liste' ,'=' , 'listes.nomliste')

            ->select('listes.user_id as id',
                'listes.nomliste as nomliste',
                'taches.tache as tache',
                'taches.liste as liste'
                )
            ->where('listes.user_id' ,'=', Auth::user()->id)
            ->get();

        $liste_unique = DB::table('listes')
            ->select('user_id', 'nomliste', 'id')
            ->groupBy('nomliste')
            ->where('user_id' ,'=', Auth::user()->id)
            ->get();


        return view('pages/home', array(
            'liste_unique' => $liste_unique,
            'selection' => $liste_home
            ));
            //->with('selection', $liste_home);
           // ->with('unique', $liste_unique);
    }

    public function espace_personnel()
    {
        $liste = DB::table('listes')
            ->select('nomliste','description')
            ->where('user_id', '=' , Auth::user()->id )
            ->where('done', '=' , 0)
            ->get();

        return view('pages/espace_personnel')->with('selection', $liste);

    }


}
?>