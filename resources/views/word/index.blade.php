@extends('layouts.app')

@section('content')
    <div class="container">

    </div>
    <div class="container">

        @if(isset($update))
            <p class="m-0 alert alert-info">{{$update}}</p>
        @endif
        <div class="row">
            @if(count($words) > 0)
                @foreach($words as $word)
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
                <div class="col-12 d-flex flex-row justify-content-center py-3">
                    {{$words->links()}}
                </div>
            @else
                <div class="mx-3 alert alert-warning shadow-sm" role="alert">
                    No Words Available
                </div>
            @endif
            <div class="col-12">
                <a href="/print" class="btn btn-primary shadow-sm btn-block text-white font-weight-bold">Print All</a>
            </div>
        </div>
    </div>
@endsection

