@extends('layouts.app')

@section('content')
<form action="/word" method="POST">
    @csrf
    <div class="container mt-2">
        <div class="container bg-secondary rounded-lg py-3">
            <h3 class="roboto">Create New Word</h3>
            {{-- Language And Countary --}}
            <div class="row g-3 align-items-center mb-2">
                <div class="col-6">
                    <select name="word-lang" class="form-select form-control border border-dark"
                        aria-label="Default select example">
                        <option selected>Language</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-6">
                    <select name="word-cntry" class="form-select form-control border border-dark"
                        aria-label="Default select example">
                        <option selected>Countary</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
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
                    <input type="text" name="word" placeholder="Word" class="form-control border border-dark">
                </div>
            </div>

        </div>

        <div class="container bg-secondary rounded-lg py-3 mt-3">
            <h4 class="roboto">Add Synonums</h4>

            <add-synonyms></add-synonyms>

            
        </div>

        <div class="container bg-secondary rounded-lg mt-3 py-3">
            <h4 class="roboto">Description</h4>
            <textarea name="descreption" class="w-100 rounded-lg"></textarea>
        </div>

    </div>
    <div class="container mt-3 mb-5">
        <button type="submit" class="btn btn-primary container font-weight-bold 
        text-dark success roboto shadow">Save & Create New</button>
    </div>
</form>
@endsection
