<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Tache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Liste;
use DateTime;


//use Illuminate\Support\Facades\Request;

class LinksController extends Controller
{

    public function index()
    {
        if(Auth::check())
        {
            return redirect()->route('home');
        }
        else
        {
            return view ('pages/index');
        }


    }


    public function about()
    {
            return view('/pages/about');
    }

    //accede a la page de creation de listes de taches


    public function creation_liste_errors()
    {
        if(Auth::check())
        {
            return view('/errors/nouvelle_liste_errors');
        }
        else
        {
            return redirect()->route('index');
        }

    }

    public function creation_liste()
    {

        if(Auth::check())
        {
            return view('/pages/nouvelle_liste');
        }

        else
        {
            return redirect()->route('index');
        }

    }

    //gestion du formulaire de creation de listes de taches
    public function creation_liste_soumission(Request $req)
    {
        $param=$req->except(['_token']);

        $doublon = DB::table('listes')
            ->select('nomliste', 'user_id')
            ->where('nomliste' ,'=', $param['nomliste'])
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        if (count($doublon) == 0)
        {
            $liste = new \App\Liste;
            $liste->user_id=htmlentities($param['user']);
            $liste->nomliste=htmlentities($param['nomliste']);
            $liste->description=htmlentities($param['description']);
            $liste->save();
            return redirect()->route('home');
        }

        else
        {
            return redirect()->route('creation_liste_errors');
        }



    }

    //accede a la page de creation de listes de taches
    public function creation_tâche($id)
    {
        if(Auth::check())
        {
            $liste_tâche = Liste::find($id);

            return view('/pages/nouvelle_tache') ->with('nomliste', $liste_tâche);
        }
        else
        {
            return redirect()->route('index');
        }

    }

    public function creation_tâche_soumission(Request $req)
    {

            $param=$req->except(['_token']);
            $tache = new \App\Tache;
            $tache->liste=htmlentities($param['nomliste']);
            $tache->tache=htmlentities($param['nomtache']);
            $tache->date=htmlentities($param['date']);
            $tache->user_id=htmlentities($param['user_id']);
            $tache->done=htmlentities($param['done']);
            $tache->save();
            return redirect()->route('home');

        //var_dump($tache);
        //echo $tache->date;

    }

    //mise à jour de la liste et de sa description0
    public function updateliste(Request $req, $id)
    {
        if(Auth::check())
        {
            //recupère l'id en cours de la liste et de la on la manipule
            //idem pour la fonction du dessous
            $liste=Liste::find($id);
            $tache_liste = $liste->nomliste;

            if($req->isMethod('post'))
            {
                $param=$req->except(['_token']);
                //reattribution des valeurs de nomliste et description de la table "listes"
                $liste->nomliste=htmlentities($param['liste']);
                $liste->description=htmlentities($param['description']);

                DB::table('taches')
                    ->where('liste' , $tache_liste)
                    ->update(['liste' => $liste->nomliste]);
                $liste->save();
                return redirect()->route('home');
            }
            return view('pages/update_liste')->with('liste' , $liste);
        }

        else
        {
            return redirect()->route('index');
        }



    }
    //cf explication au dessus
    public function updatetache(Request $req, $id)
    {
        if(Auth::check())
        {
            $tache=Tache::find($id);


            if($req->isMethod('post'))
            {
                $param=$req->except(['_token']);

                $tache->tache=htmlentities($param['tache']);
                $tache->date=htmlentities($param['date']);
                $tache->save();
                return redirect()->route('home');
                //var_dump($liste);
                //echo $liste->id;

            }

            return view('pages/update_tache')->with('tache' , $tache);
        }

        else
        {
            return redirect()->route('index');
        }


    }

    public function deleteliste($id)
    {
        $liste=Liste::find($id);
        $liste->delete();

        DB::table('taches')
            ->where('liste', '=', $liste->nomliste)
            ->where('user_id', '=' , Auth::user()->id)
            ->delete();

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

        if(Auth::check())
        {
            $liste_home = DB::table('listes')
                ->join('taches' , 'taches.liste' ,'=' , 'listes.nomliste')

                ->select(
                    'listes.user_id as id',
                    'listes.nomliste as nomliste',
                    'taches.tache as tache',
                    'taches.liste as liste',
                    'taches.id as tache_id',
                    'taches.done as t_done',
                    'taches.date as date',
                    'taches.user_id'
                )

                ->where('listes.user_id' ,'=', Auth::user()->id)
                ->where('taches.done' ,'=', 0)
                ->where('date', '>=', new DateTime('today'))
                ->where('taches.user_id', '=' , Auth::user()->id)
                ->orderBy('taches.date', 'ASC')
                ->get();

            $liste_unique = DB::table('listes')
                ->select('user_id', 'nomliste', 'id', 'created_at')
                ->groupBy('nomliste')
                ->where('user_id' ,'=', Auth::user()->id)
                ->orderBy('created_at', 'ASC')
                ->get();

            return view('pages/home', array(
                'liste_unique' => $liste_unique,
                'selection' => $liste_home
            ));
        }

        else
        {
            return redirect()->route('index');
        }

    }

    public function espace_personnel()
    {
        //2 requetes sql necessaires, comme pour home, il faut afficher les listes de manière unique et afficher les taches en cours.
        if(Auth::check())
        {
            $taches = DB::table('listes')
                ->join('taches' , 'taches.liste' ,'=' , 'listes.nomliste')

                ->select('listes.user_id as id',
                    'taches.done as t_done',
                    'taches.liste as liste',
                    'taches.tache as tache',
                    'taches.date as date',
                    'taches.user_id'
                )
                ->where('listes.user_id' ,'=', Auth::user()->id)
                ->where('taches.user_id', '=', Auth::user()->id)
                ->where('date', '>=', new DateTime('today'))
                ->orderBy('taches.date', 'ASC')
                ->get();

            $liste = DB::table('listes')
                ->select('id','nomliste','description', 'created_at')
                ->where('user_id', '=' , Auth::user()->id )
                ->orderBy('created_at', 'ASC')
                ->get();

            return view('pages/espace_personnel', array(
                'selection' => $liste,
                'taches' => $taches
            ));
        }

        else
        {
            return redirect()->route('index');
        }

    }


}
?>