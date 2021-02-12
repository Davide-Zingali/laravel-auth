<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function iconUser(request $request) {

        //validazione per far si che venga caricato un file
        $request -> validate([
            'stringaIcon' => 'required|file'
        ]);
        
        $image = $request -> file('stringaIcon');
        // dd($image);


        //memorizza l'estenzione del file (proprio il suo nome = png)
        $estenzione = $image -> getClientOriginalExtension();
        //assegno nome con parte iniziale numero casuale diviso da _ segue info temporali
        $name = rand(100000, 999999) . "_" . time();
        //unisco il nome combinato con l'estenzione
        $nomeIcon = $name . "." . $estenzione;
        

        $file = $image -> storeAs('icons', $nomeIcon, 'public');
        
        $utenteOnline = Auth::user();
        $utenteOnline -> stringaIcona = $nomeIcon;
        $utenteOnline -> save();
        
        return redirect() -> back();
    }
}
