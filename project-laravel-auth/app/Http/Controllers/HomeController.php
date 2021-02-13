<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;


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



// ---------------------------------------------------------------------------


    // metodo che aggiunge foto profilo
    public function updateIcon(request $request) {
        //richiamo funzione
        $this -> deleteIcons();

        //validazione per far si che venga caricato un file
        $request -> validate([
            'inputIcon' => 'required|file'
        ]);
        //seleziona il file (immagine) con nome originale
        $image = $request -> file('inputIcon');
        //----------------------------------------------------------
        //memorizza l'estenzione del file (proprio il suo nome = png)
        $estenzione = $image -> getClientOriginalExtension();
        //assegno nome con parte iniziale: numero casuale diviso da _ segue info temporali
        $name = rand(100000, 999999) . "_" . time();
        //unisco il nome combinato con l'estenzione
        $nomeIcon = $name . "." . $estenzione;
        //----------------------------------------------------------
        //prendo l'immagine opriginale e la salvo nella cartella icons, con nome della var $nomeIcon e visibilitá in cartella public
        $file = $image -> storeAs('icons', $nomeIcon, 'public');
        //prelevo l'utente online
        $utenteOnline = Auth::user();
        //dall'utente estraggo il campo (colonna del DB) stringaIcona ed assegno il nome di $nomeIcon 
        $utenteOnline -> stringaIcona = $nomeIcon;
        //salvo tutto nel DB
        $utenteOnline -> save();
        //ritorno alla rotta precedente
        return redirect() -> back();
    }

    // metodo che elimina foto profilo selezionata
    public function clearIcon() {
        //richiamo funzione
        $this -> deleteIcons();

        //seleziono utente online
        $utenteOnline = Auth::user();
        //dall'utente estraggo il campo (colonna del DB) stringaIcona ed assegno come valore null, che cancellerá l'img selezionata
        $utenteOnline -> stringaIcona = null;
        //salvo tutto nel DB
        $utenteOnline -> save();
        //ritorno alla rotta precedente
        return redirect() -> back();
    }

    // metodo che elimina tutte le foto che si accumulano man mano che l'utente cambia foto
    public function deleteIcons() {
        //seleziono utente online
        $utenteOnline = Auth::user();
        // dd('ciao');
        // condizione che gestisce le eccezioni in caso di presenza di errore dopo al try, eseguendo ció che sta nel catch (ma sará vuoto e quindi non fará nulla)
        try {
            // estraggo il nome (dal DB) dell'icona dell'utente
            $nomeFile = $utenteOnline -> stringaIcona;
            // dd($nomeFile);
            $file = storage_path('app/public/icons/' . $nomeFile);

            File::delete($file);

        } catch (\Exception $e) {
            //essendo vuota non fará nulla
        }
    }
}
