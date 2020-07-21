@extends('layouts.app')

@section('content')
<form action="/word" method="POST">
    @csrf
    <div class="container mt-2">
        <div class="container bg-secondary rounded-lg py-3">
            @include('inc.alerts')
            <h3 class="roboto">Create New Word</h3>
            {{-- Language And Countary --}}
            <div class="row g-3 align-items-center mb-2">
                <div class="col-6">
                    <select name="word-lang" required class="form-select languages form-control border border-dark">
                        
                    </select>
                </div>
                <div class="col-6">
                    <select name="word-cntry" required class="form-select countries form-control border border-dark">
                        
                    </select>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-1">
                    <label for="inputPassword6" class="col-form-label">
                        <img src="{{ asset('storage/sa/downarrow.svg') }}" alt="">
                    </label>
                </div>
                <div class="col-10 pr-0">
                    <input type="text" name="word" required placeholder="Word" class="form-control border border-dark">
                </div>
            </div>

        </div>

        <div class="container bg-secondary rounded-lg py-3 mt-3">
            <h4 class="roboto">Available Words add as Synonum</h4>

            <div class="col-12 mt-3" style="max-height: 13rem;overflow-y: scroll">
                @if(isset($allwords))
                    @if(count($allwords) > 0)
                        @foreach($allwords as $syn)
                            <button type="button" 
                            data-word="{{$syn->word}}"
                            data-language="{{$syn->language}}"
                            data-countary="{{$syn->language}}"
                            class="asSyn mt-3 btn btn-outline-primary container font-weight-bold text-dark roboto shadow-sm">
                                <h5>{{$syn->word}}</h5>
                                <p class="m-0">
                                    <span> lang: {{$syn->language}}</span> 
                                    <span>cntry: {{$syn->countary}}</span>
                                </p>
                            </button>
                        @endforeach
                        @else
                        <div class="alert alert-warning" role="alert">
                            No Words Available
                        </div>
                    @endif
                @endif
            </div>
            
        </div>

        <div class="container bg-secondary rounded-lg py-3 mt-3">
            <h4 class="roboto">Add Synonums</h4>

            <div class="col-12 mt-3">
                
                <div id="append"></div>
                
                <button id="appender" type="button" class="btn btn-outline-primary container font-weight-bold text-dark roboto shadow-sm">
                    Add New Synonum
                </button>
            </div>
            
        </div>

        <div class="container bg-secondary rounded-lg mt-3 py-3">
            <h4 class="roboto">Description</h4>
            <textarea name="descreption" required class="w-100 rounded-lg"></textarea>
        </div>

    </div>
    <div class="container mt-3 mb-5">
        <button type="submit" class="btn btn-primary container font-weight-bold 
        text-dark success roboto shadow">Save & Create New</button>
    </div>
</form>
@endsection
