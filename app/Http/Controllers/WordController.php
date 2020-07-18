<?php

namespace App\Http\Controllers;

use App\Word;
use App\Synonyms;
use App\Events\NewWord;
use App\Jobs\SyncMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\WordStoreRequest;
use App\Http\Requests\WordUpdateRequest;

class WordController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $words = Word::all();
        return view('word.index', compact('words'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Word $word
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('word.show', compact('word'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('word.create');
    }

    /**
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */

    public function insertWord($w, $l, $c, $d)
    {
        $record = Word::where('word', '=', $w)->first();
        if ($record === null) {
            $word = DB::table('words')->insertOrIgnore([
                'word' => $w,
                'countary' => $c,
                'language' => $l,
                'defination' => $d,
            ]);
        } else {
            $error = $record->word . " already exists in database";
        }
    }

    public function store(Request $request)
    {
        $error = "";
        $data = request()->validate([
            'word-lang' => ['string', 'required'],
            'word-cntry' => ['string', 'required'],
            'word' => ['string', 'required'],
            'descreption' => ['string', 'required'],
        ]);

        $this->insertWord($data['word'], $data['word-lang'], $data['word-cntry'], $data['descreption']);

        dd($error);


        foreach ($request->all() AS $index => $field) {
            for ($i=1; $i < sizeof($request->all()); $i++) { 
                $w = "syn-word-".$i;
                $l = "syn-lang-".$i;
                $c = "syn-cntry-".$i;
                if ($index == $w) {
                    echo "<br>".$index;

                    $data = request()->validate([
                        $l => ['string', 'required'],
                        $c => ['string', 'required'],
                        $w => ['string', 'required'],
                        'descreption' => ['string', 'required'],
                    ]);
        
                    $synos = Word::insertOrIgnore([
                        'word' => $data[$w],
                        'countary'=> $data[$c],
                        'language'=> $data[$l],
                        'defination'=> $data['descreption'],
                    ]);

                    $synoword = Synonyms::insertOrIgnore([
                        'word_id' => $word->id,
                        'syno_id' => $synos->id,
                    ]);

                }
            }
        };

        dd($synoword);
        SyncMedia::dispatch($word);

        event(new NewWord($word));

        $request->session()->flash('word.word', $word->word);

        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Word $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Word $word)
    {
        return view('word.edit');
    }

    /**
     * @param \App\Http\Requests\WordUpdateRequest $request
     * @param \App\Word $word
     * @return \Illuminate\Http\Response
     */
    public function update(WordUpdateRequest $request, Word $word)
    {
        $word->update([]);

        SyncMedia::dispatch($word);

        event(new NewWord($word));

        $request->session()->flash('word.word', $word->word);

        return redirect()->route('word.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Word $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Word $word)
    {
        $word->delete();

        return redirect()->route('back');
    }
}
