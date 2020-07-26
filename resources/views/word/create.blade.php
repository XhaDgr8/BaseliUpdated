@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="container bg-secondary rounded-lg py-3">
        @include('inc.alerts')
        <h3 class="roboto">Create New Word</h3>
        {{-- Language And Countary --}}
        <form method="post" action="/word/create">
            @csrf
            <create-word></create-word>
            <div class="container">
                <h4 class="roboto">Defination</h4>
                <textarea name="defination" class="w-100 rounded-lg"></textarea>
            </div>
            <div class="container mt-3 mb-5">
                <button class="btn btn-primary container font-weight-bold text-dark success roboto shadow">Save & Create New</button>
            </div>
        </form>
    </div>

    <div class="container bg-secondary rounded-lg py-3 mt-3">
        <h4 class="roboto">Available Words add as Synonum</h4>
        <div class="w-100" style="max-height: 13rem;overflow-y: scroll">
            <get-all-words></get-all-words>
        </div>
    </div>
    <make-relations></make-relations>

</div>
@endsection
