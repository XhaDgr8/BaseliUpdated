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
        $words = Word::paginate(10);
        return view('word.index', compact('words'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Word $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        $synonymsdb = Synonyms::where('word_id', $word->id)->get();
        $synonyms = [];
        foreach ($synonymsdb as $syno) {
            $getsyno = Word::where('id', $syno->syno_id)->get();
            array_push($synonyms, $getsyno);
        }

        return view('word.show', compact('word', 'synonyms'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allwords = Word::orderBy('word')->get();
        return view('word.create', compact('allwords'));
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

                            $updateDefination = Word::where('word', $record->word)->update(['defination' => $d]);

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

                            $synoword = Synonyms::create([
                                'word_id' => $synos->id,
                                'syno_id' => $word->id,
                            ]);

                            $log['success'][] = $word->word ." And ". $synos->word." relation created successfylly";
                        }
                        $log['success'][] = $word->word .' Created Successfylly';
                    }
                }
            };
        }
        $allwords = Word::orderBy('word')->get();

        return view('word.create', compact('log','allwords'));
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
