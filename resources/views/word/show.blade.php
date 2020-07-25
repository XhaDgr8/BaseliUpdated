@extends('layouts.app')

@section('content')
    <div class="container my-2">
        <div class="row">
            <div class="col-md-10 col-12">
                <div class="container bg-secondary rounded-lg py-2">
                    <h5 class="font-weight-bold m-0">{{$word->word}}</h5>
                    <hr class="m-0">
                    <p class="text-muted m-0">Lang: <strong>{{$word->language}}</strong></p>
                    <p class="text-muted m-0">Cntry: <strong>{{$word->countary}}</strong></p>
                    <p class="text-muted mt-2 m-0 border p-2 rounded-lg"><strong>{{$word->defination}}</strong></p>
                </div>
            </div>
            <div class="col p-md-0 mt-md-0 mt-3">
                <div class="container bg-secondary rounded-lg py-2">
                    <a href="/word/{{$word->id}}/edit" class="btn-link btn btn-info btn-block text-white font-weight-bold">Edit</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <h4>{{count($synonyms)}} synonyms available</h4>
        <div class="row">
            @if(count($synonyms) > 0)
                @foreach($synonyms as $synonym)
                    @foreach($synonym as $word)
                        <div class="col-md-3 col-6 mb-2">
                            <a href='/word/{{$word->id}}'>
                                <div class="container bg-secondary rounded-lg py-2">
                                    <h5 class="font-weight-bold m-0">{{$word->word}}</h5>
                                    <hr class="m-0">
                                    <p class="text-muted m-0">Lang: <strong>{{$word->language}}</strong></p>
                                    <p class="text-muted m-0">Cntry: <strong>{{$word->countary}}</strong></p>
                                    <p class="text-info mt-2 m-0">Info -></p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endforeach
                @else
                <div class="mx-3 alert alert-warning shadow-sm" role="alert">
                    No Synonyms Available
                </div>
            @endif
        </div>
    </div>
@endsection
