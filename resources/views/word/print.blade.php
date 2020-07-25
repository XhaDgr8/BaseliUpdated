@extends('layouts.app')

@section('content')
    <div class="container mt-3 rounded-lg">
        <h4>All Available Words</h4>
        <form id="printJS-form" action="">
            @if(count($words) > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Word</th>
                        <th scope="col">Language</th>
                        <th scope="col">Countary</th>
                        <th scope="col">Defination</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($words as $word)
                        <tr>
                            <td><input style="border: 0;box-shadow: none;" type="text" value="{{$word->word}}"></td>
                            <td><input style="border: 0;box-shadow: none;" type="text" value="{{$word->language}}"></td>
                            <td><input style="border: 0;box-shadow: none;" type="text" value="{{$word->countary}}"></td>
                            <td><input style="border: 0;box-shadow: none;" type="text" value="{{$word->defination}}"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="mx-3 alert alert-warning shadow-sm" role="alert">
                    No Words Available
                </div>
            @endif
        </form>

        <button onclick="printJS('printJS-form', 'html')" type="button"
                class="btn btn-primary container shadow-sm btn-block text-white">Print Them All</button>
    </div>
@endsection
