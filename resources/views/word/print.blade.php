@extends('layouts.app')

@section('content')
    <div class="container mt-3 rounded-lg">
        <h4>All Available Words</h4>
        <div style="width: 100%" id="printJS-form">

            @if(count($words) > 0)
                @foreach($words as $word)
                    <div style="margin-bottom: 3rem">
                        <table style="width: 100%; margin-left: auto; margin-right: auto;" border="1px">
                            <tbody style="text-align: center;">
                            <tr style="height: 32px;">
                                <td style="width: 330px;"><strong>Lemma</strong></td>
                                <td style="width: 330px;">{{$word->word}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table style="width: 100%; margin-left: auto; margin-right: auto;" border="1px">
                            <tbody style="text-align: center;">
                            <tr style="height: 32px;">
                                <td style="width: auto; height: 32px;"><strong>Language</strong></td>
                                <td style="width: auto; height: 32px;"><strong>Country</strong></td>
                                <td style="width: auto; height: 32px;"><strong>Definition</strong></td>
                            </tr>
                            <tr style="height: auto;">
                                <td style="width: auto; height: 32px;">{{$word->language}}</td>
                                <td style="width: auto; height: 32px;">{{$word->countary}}</td>
                                <td style="width: 500px; height: 32px;">{{$word->defination}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table style="width: 100%; margin-left: auto; margin-right: auto;" border="1px">
                            <tbody style="text-align: center;">
                            <tr style="height: 32px;">
                                <td style="width: auto;">Synonym</td>
                            </tr>
                            </tbody>
                        </table>
                        @foreach($synos as $nyms)
                            @if(isset($nyms[$word->word]))
                                @foreach($nyms[$word->word] as $syns)
                                    <table style="width: 100%; margin-left: auto; margin-right: auto;" border="1px">
                                        <tbody style="text-align: center;">
                                        <tr style="height: 32px;">
                                            <td style="width: 220px; height: 32px;"><strong>word</strong></td>
                                            <td style="width: 220px; height: 32px;"><strong>Language</strong></td>
                                            <td style="width: 220px; height: 32px;"><strong>Country</strong></td>
                                            <td style="width: 500px; height: 32px;"><strong>Definition</strong></td>
                                        </tr>
                                        <tr style="height: auto;">
                                            <td style="width: 220px; height: 32px;">{{$syns['word']}}</td>
                                            <td style="width: 220px; height: 32px;">{{$syns['language']}}</td>
                                            <td style="width: 220px; height: 32px;">{{$syns['countary']}}</td>
                                            <td style="width: 500px; height: 32px;">{{$syns['defination']}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            @endif
                        @endforeach
                    </div>
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
