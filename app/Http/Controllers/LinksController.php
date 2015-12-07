<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Request;

class LinksController extends Controller
{

    public function index()
    {
        return view('auth/register');

    }

  /*  public function inscription(Request $req){

        $param=$req->except(['_token']);

        $login = new \App\User;
        $login->pseudonyme=$param['pseudonyme'];
        $login->email=$param['email'];
        $login->password=$param['password'];
        $login->save();
        //var_dump($param);
        return redirect()->route('lol');

    }
  */


    public function test()
    {

        return view('auth/login');

    }

    public function home()
    {

        return view('home');

    }
}
?>