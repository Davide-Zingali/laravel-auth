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
                <div>
                    <form action="{{route('icon-user')}}" method="post" enctype="multipart/form-data">

                        @csrf
                        @method('post')

                        <label for="stringaIcon"></label>
                        <input type="file" name="stringaIcon">
                        <br>
                        <br>
                        <input type="submit">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
