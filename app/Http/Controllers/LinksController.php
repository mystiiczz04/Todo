<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Tache;
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

        $doublon = DB::table('listes')
            ->select('nomliste')
            ->where('nomliste' ,'=', $param['nomliste'])
            ->get();

        if (count($doublon) == 0)
        {
            $liste = new \App\Liste;
            $liste->user_id=$param['user'];
            $liste->nomliste=$param['nomliste'];
            $liste->description=$param['description'];
            $liste->save();
            return redirect()->route('home');
        }

        else
        {
            //$erreur = "Cette liste existe déjà, veuillez l'editer ou choisir un autre nom de liste.";
            return redirect()->route('creation_liste')->with('erreur', 'pas possible');

        }



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

    //mise à jour de la liste et de sa description
    public function updateliste(Request $req, $id)
    {
        //recupère l'id en cours de la liste et de la on la manipule
        //idem pour la fonction du dessous
        $liste=Liste::find($id);

        $tache_liste = $liste->nomliste;


        if($req->isMethod('post'))
        {
            $param=$req->except(['_token']);
            //reattribution des valeurs de nomliste et description de la table "listes"
            $liste->nomliste=$param['liste'];
            $liste->description=$param['description'];

            DB::table('taches')
                ->where('liste' , $tache_liste)
                ->update(['liste' => $liste->nomliste]);
            $liste->save();
            return redirect()->route('home');

        }

        return view('pages/update_liste')->with('liste' , $liste);

    }
    //cf explication au dessus
    public function updatetache(Request $req, $id)
    {

        $tache=Tache::find($id);


        if($req->isMethod('post'))
        {
            $param=$req->except(['_token']);

            $tache->tache=$param['tache'];
            $tache->save();
            return redirect()->route('home');
            //var_dump($liste);
            //echo $liste->id;

        }

        return view('pages/update_tache')->with('tache' , $tache);

    }

    public function deleteliste($id)
    {
        $liste=Liste::find($id);
        $liste->delete();

        DB::table('taches')->where('liste', '=', $liste->nomliste)->delete();

        return redirect()->route('home');
    }

    public function deletetache($id)
    {
        $tache=Tache::find($id);

        $tache->delete();

        return redirect()->route('home');
    }

    public function validationtache($id)
    {
        $tache=Tache::find($id);

        $tache->done = 1;
        $tache->save();

        return redirect()->route('home');
    }



    public function home()
    {

        $liste_home = DB::table('listes')
            ->join('taches' , 'taches.liste' ,'=' , 'listes.nomliste')

            ->select(
                'listes.user_id as id',
                'listes.nomliste as nomliste',
                'taches.tache as tache',
                'taches.liste as liste',
                'taches.id as tache_id',
                'taches.done as t_done'
                )

            //verifier le select

            ->where('listes.user_id' ,'=', Auth::user()->id)
            ->where('taches.done' ,'=', 0)
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

        $taches = DB::table('listes')
            ->join('taches' , 'taches.liste' ,'=' , 'listes.nomliste')

            ->select('listes.user_id as id',
                'taches.done as t_done',
                'taches.liste as liste',
                'taches.tache as tache'
            )
            ->where('listes.user_id' ,'=', Auth::user()->id)
            ->get();

        $liste = DB::table('listes')
            ->select('id','nomliste','description', 'created_at')
            ->where('user_id', '=' , Auth::user()->id )
            ->get();


        //$split = explode(' ', $liste->created_at);

        return view('pages/espace_personnel', array(
            'selection' => $liste,
            'taches' => $taches
        ));




    }


}
?>