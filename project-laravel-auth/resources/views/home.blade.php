@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <br>
            <div class="card padd">
                <h3>Inserisci foto profilo</h3>

{{-- --------------------------------------------------------------------------- --}}
                
                <div>
                    <form action="{{route('update-icon')}}" method="post" enctype="multipart/form-data">

                        @csrf
                        @method('post')

                        <label for="inputIcon"></label>
                        <input type="file" name="inputIcon">
                        <br>
                        <br>
                        <input class="btn btn-primary" type="submit">
                        <button class="btn btn-danger">
                            <a href="{{route('clear-icon')}}">Elimina</a>
                        </button>

                    </form>
                </div>
            </div>

            {{-- condizione if che fa si che se il campo stringaIcon nel DB non esista (questo succede se non ha immagine profilo) allora non esegue il codice sotto --}}
            @if (Auth::user() -> stringaIcona)
                <div class="card padd">
                    <h3>Foto Profilo selezionata</h3>
                    <div>
                        {{-- percorso dentro la cartella public, il nome viene preso dal DB --}}
                        <img src="{{asset ('storage/icons/' . Auth::user() -> stringaIcona)}}" alt="">
                    </div>
                </div>    
            @endif

        </div>
    </div>
</div>
@endsection
