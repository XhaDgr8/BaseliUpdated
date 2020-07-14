@extends('welcome')

@section('content')
<div class="container mt-2">
    <h3 class="roboto">Create New Word</h3>
    <div class="container bg-secondary rounded-lg py-3">
        {{-- Language And Countary --}}
        <div class="row g-3 align-items-center mb-2">
            <div class="col-auto">
                <select class="form-select form-control border border-dark" 
                aria-label="Default select example">
                    <option selected>Language</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-auto">
                <select class="form-select form-control border border-dark" 
                aria-label="Default select example">
                    <option selected>Countary</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto p-0 pl-2">
                <label for="inputPassword6" class="col-form-label">
                    <img src="{{ asset('storage/sa/downarrow.svg') }}" alt="">
                </label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control border border-dark">
            </div>
        </div>
    </div>
</div>
@endsection
