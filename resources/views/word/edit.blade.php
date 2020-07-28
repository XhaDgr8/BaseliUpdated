@extends('layouts.app')

@section('content')
    <div class="container my-2">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-10 col-12py-2">
                <form method="post" action="/word/{{$word->id}}">
                    @csrf @method('PUT')
                    <h4>Change The Word</h4>
                    <div class="row m-0 bg-secondary rounded-lg py-2">
                        <div class="col-md-6">
                            <p class="m-0">Word from <strong>{{$word->word}}</strong> to :</p>
                            <input type="text" name="word" required class="form-group rounded-pill w-100 p-1">
                        </div>
                        <div class="text-muted col-md-3">
                            <p class="m-0">lang from <strong>{{$word->language}}</strong> to :</p>
                            <select name="language" class="form-select languages form-control border border-dark rounded-pill">
                                <option selected>{{$word->language}}</option>
                                <option v-for="language in languages" v-text="language" v-bind:value="language"></option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p class="m-0">lang from <strong>{{$word->countary}}</strong> to :</p>
                            <select name="countary" class="form-select languages form-control border border-dark rounded-pill">
                                <option selected>{{$word->countary}}</option>
                                <option v-for="countary in countries" v-text="countary" v-bind:value="countary"></option>
                            </select>
                        </div>
                        <div class="mt-2 col-12">
                            <textarea type="text" style="min-height: 7rem" name="defination" placeholder="{{$word->defination}}" class="form-group p-2 w-100"></textarea>
                        </div>
                        <div class="container">
                            <button type="submit" class="btn btn-block rounded-pill btn-primary font-weight-bold shadow-sm">Update</button>
                        </div>
                    </div>
                </form>

                <div class="container mt-4 bg-secondary rounded-lg py-2">
                    <h4>Add More Synonyms</h4>
                    <form method="post" action="/word/create">
                        @csrf
                        <input name="0_word" value="{{$word->word}}" type="hidden">
                        <input name="0_language" value="{{$word->language}}" type="hidden">
                        <input name="0_countary" value="{{$word->countary}}" type="hidden">
                        <input name="defination" value="{{$word->defination}}" type="hidden">
                        <create-word></create-word>e
{{--                        <div class="container">--}}
{{--                            <h4 class="roboto">Defination</h4>--}}
{{--                            <textarea name="defination" class="w-100 rounded-lg"></textarea>--}}
{{--                        </div>--}}
                        <div class="container mt-3 mb-5">
                            <button class="btn btn-primary container font-weight-bold text-dark success roboto shadow">Save & Create New</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2 col-12 p-md-0 mt-md-0 mt-3">
                <div class="container bg-secondary rounded-lg py-2">
                    <form method="post" action="/word/{{$word->id}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-danger btn btn-sm btn-block mt-3 shadow" type="submit">
                            Delete Word
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <h4>{{count($synonyms)}} synonyms available</h4>
        <div class="row">
            @if(count($synonyms) > 0)
                @foreach($synonyms as $synonym)
                    <div class="col-md-3 col-6 mb-2">
                        <div class="container bg-secondary rounded-lg py-2">
                            <h5 class="font-weight-bold m-0">{{$synonym['word']}}</h5>
                            <hr class="m-0">
                            <p class="text-muted m-0">Lang: <strong>{{$synonym['language']}}</strong></p>
                            <p class="text-muted m-0">Cntry: <strong>{{$synonym['countary']}}</strong></p>
                            <form action={{ route('cats.destroy', [$synonym['id']])}} method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger btn btn-sm btn-block mt-3 shadow" type="submit">
                                    Unlink Synonym
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mx-3 alert alert-warning shadow-sm" role="alert">
                    No Synonyms Available
                </div>
            @endif
        </div>
    </div>
@endsection
