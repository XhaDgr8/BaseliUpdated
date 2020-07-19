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

    public function store(Request $request)
    {
        $log = [];

        $record = Word::where('word', '=', $request->word)->first();

        if ($record != null) {
            $log['danger'][] = $record->word . " already exists in database";
            
        } else {

            $data = request()->validate([
                'word' => ['string', 'required'],
                'word-lang' => ['string', 'required'],
                'word-cntry' => ['string', 'required'],
                'descreption' => ['string', 'required'],
            ]);

            $word = Word::create([
                'word' => $data["word"],
                'language' => $data["word-lang"],
                'countary' => $data['word-cntry'],
                'defination' => $data['descreption'],
            ]);
            foreach ($request->all() AS $index => $field) {
                for ($i=1; $i < sizeof($request->all()); $i++) { 
    
                    $w = "syn-word-".$i; $l = "syn-lang-".$i;
                    $c = "syn-cntry-".$i; $d = $data['descreption'];
    
                    if ($index == $w) {
                        $record = Word::where('word', '=', $field)->first();
                        if ($record != null) {

                            $synoword = Synonyms::create([
                                'word_id' => $word->id,
                                'syno_id' => $record->id,
                            ]);

                            $log['warning'][] = $record->word . " already exists in database Synonym created Successfully";
                            
                        } else if ($record == null) {
                            
                            $synos = Word::create([
                                'word' => $request->$w,
                                'language' => $request->$l,
                                'countary' => $request->$c,
                                'defination' => $request->descreption,
                            ]);

                            $synoword = Synonyms::create([
                                'word_id' => $word->id,
                                'syno_id' => $synos->id,
                            ]);

                            $log['success'][] = $word->word ." And ". $synos->word." relation created successfylly";
                        }
                        $log['success'][] = $word->word .' Created Successfylly';
                    }
                }
            };
        }

        return view('word.create', compact('log'));
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
