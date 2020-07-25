@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="container bg-secondary rounded-lg py-3">
        @include('inc.alerts')
        <h3 class="roboto">Create New Word</h3>
        {{-- Language And Countary --}}
        <create-word></create-word>

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
