@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3 rounded-lg">
        <h4>All Available Words</h4>
        <hr>
        <div style="width: 100%" id="printJS-form">

            @if(count($synos) > 0)
                @foreach($synos as $syno)
                    @foreach($syno as $key => $syn)
                        @php
                            $word = \App\Word::where('word', $key)->first();
                        @endphp
                        <h4 class="m-0">{{$word->word}}</h4>
                        <p>
                            @foreach($syn as $sy)
                                @if($sy["language"] == "Latin")
                                    {{$sy["language"]}} - {{$sy["word"]}}
                                @endif
                            @endforeach
                             . {{$word->defination}} .
                                @foreach($syn as $sy)
                                    @if($sy["language"] != "Latin" AND $sy["language"] != "English")
                                        {{$sy["countary"]}}.: {{$sy['word']}}
                                    @endif
                                @endforeach
                                @foreach($syn as $sy)
                                    @if($sy["language"] == "English")
                                        - {{$sy["language"]}}.: {{$sy['word']}}
                                    @endif
                                @endforeach
                        </p>
                        @foreach($syn as $key => $sy)
                            <p style="margin-bottom: 0">{{$sy['word']}}<</p>
                            <p style="margin-bottom: 0">{{$sy['countary']}}.: ver {{$word->word}}</p>
                        @endforeach
                    @endforeach
                @endforeach
            @else
                <div class="mx-3 alert alert-warning shadow-sm" role="alert">
                    No Words Available
                </div>
            @endif
        </div>
        <button onclick="printJS('printJS-form', 'html')" type="button"
                class="btn btn-primary container shadow-sm btn-block mt-3 text-white">Print Them All</button>
    </div>
@endsection
