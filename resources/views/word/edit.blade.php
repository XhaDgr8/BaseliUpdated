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
            <form method="post" action="/word/{{$word->id}}" class="col-md-10 col-12">
                @csrf @method('PUT')
                <div class="container bg-secondary rounded-lg py-2">
                    <h5 class="font-weight-bold m-0">{{$word->word}} Change to :
                        <input type="text" name="word" class="form-group" placeholder="{{$word->word}}">
                    </h5>
                    <hr class="m-0">
                    <p class="text-muted m-0">Lang:
                        <select name="language" required class="form-select languages form-control border border-dark">
                            <option v-for="language in languages" v-text="language" v-bind:value="language"></option>
                        </select>
                    </p>
                    <p class="text-muted m-0">Cntry:
                        <select name="countary" required class="form-select languages form-control border border-dark">
                            <option v-for="countary in countries" v-text="countary" v-bind:value="countary"></option>
                        </select>
                    </p>
                    <p class="text-muted mt-2 m-0 border p-2 rounded-lg">
                        <textarea type="text" name="defination" placeholder="{{$word->defination}}" class="form-group w-100"></textarea>
                    </p>
                </div>
                <div class="container">
                    <button type="submit" class="btn btn-block btn-primary font-weight-bold shadow-sm">Update</button>
                </div>
            </form>
            <div class="col p-md-0 mt-md-0 mt-3">
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
