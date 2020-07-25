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
use PhpOffice\PhpWord\TemplateProcessor;

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
    public function printAll()
    {
        $words = Word::all();
        return view('word.print', compact('words'));
    }

    public function getAllSynonyms($id)
    {

        $synonyms = [];
        $syno_id = Synonyms::where('word_id', $id)->get();

        if ($syno_id != null) {
            foreach ($syno_id as $find_word){
                $found_word = Word::where('id', $find_word->syno_id)->get();
                foreach ($found_word as $synonym){
                    array_push($synonyms, [
                        'id' => $synonym->id,
                        'word' => $synonym->word,
                        'language' => $synonym->language,
                        'countary' => $synonym->countary,
                    ]);
                };
            };
        }
        return $synonyms;
    }

    public function makeRels($word, $synonym)
    {
        $who = Synonyms::where("word_id", $word)
            ->where('syno_id', $synonym)->get();
        if (count($who) > 0) {
            $doo = Synonyms::where("word_id", $synonym)->where('syno_id', $word)->get();
            if (count($doo) > 0) {
            } else {
                Synonyms::create([
                    'word_id' => $synonym,
                    'syno_id' => $word
                ]);
            }
        }else{
            Synonyms::create([
                'word_id' => $word,
                'syno_id' => $synonym
            ]);
        }
        return true;
    }

    public function makeSynonyms(Request $request)
    {
        $newArray = [];
        if (count($request->all()) > 1) {


            foreach ($request->all() as $wo) {
                $word = Word::where('id', $request[0])->get();
                $syn_d = Word::where('id', $wo)->get();
                $syn_d->first()->update([
                    "defination" => $word->first()->defination
                ]);
                foreach ($request->all() as $so) {
                    if ($wo != $so) {
                        if ($this->makeRels($wo, $so, $newArray)){
                            array_push($newArray,$wo ." Done");
                        }
                    }
                }
            }
            foreach ($request->all() as $so) {
                foreach ($request->all() as $wo) {
                    if ($so != $wo) {
                        if ($this->makeRels($wo, $so, $newArray)){
                            array_push($newArray,$so. "Done");
                        }
                    }
                }
            }

        } else {
            array_push($newArray, 'Only 2 words can be made Synonyms at a Time');
        }
        return $newArray;
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
    public function getAllWords()
    {
        $allwords = Word::orderBy('word')->get();
        return $allwords;
    }

    /**
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $log = '';

        $data = $request->validate([
            'word' => ['string', 'required'],
            'word_lang' => ['string', 'required'],
            'word_cntry' => ['string', 'required'],
            'word_defination' => ['string', 'required'],
        ]);

        $record = Word::where('word', '=', $data['word'])->first();

        if ($record != null) {
            $log = '<div class="container alert alert-danger"> '.$record->word . ' already exists in database</div>';
        } else {

            $word = Word::create([
                'word' => $data["word"],
                'language' => $data["word_lang"],
                'countary' => $data['word_cntry'],
                'defination' => $data['word_defination'],
            ]);
            $log = '<div class="container alert alert-success"> '.$word->word. ' Created Successfylly</div>';
        }

        return $log;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Word $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {
        $synonyms = [];
        $syno_id = Synonyms::where('word_id', $word->id)->get();

        if ($syno_id != null) {
            foreach ($syno_id as $find_word){
                $found_word = Word::where('id', $find_word->syno_id)->get();
                foreach ($found_word as $synonym){
                    array_push($synonyms, [
                        'id' => $synonym->id,
                        'word' => $synonym->word,
                        'language' => $synonym->language,
                        'countary' => $synonym->countary,
                    ]);
                };
            };
        }
        return view('word.edit', compact('word', 'synonyms'));
    }

    /**
     * @param \App\Http\Requests\WordUpdateRequest $request
     * @param \App\Word $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {

        $word->update([
            'word' => $request->word,
            'language' => $request->language,
            'countary' => $request->countary,
            'defination' => $request->defination,
        ]);

        $syn_d = Synonyms::where('word_id', $word->id)->get();
        foreach ($syn_d as $syns) {
            $get_words = Word::where('id', $syns->syno_id)->get();
            foreach ($get_words as $gw){
                $gw->update([
                    "defination" => $word->defination
                ]);
            }
        }

        return redirect()->back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Word $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {

        $w_syns = Synonyms::where('word_id', $word->id)->get();
        $s_syns = Synonyms::where('syno_id', $word->id)->get();
        foreach ($w_syns as $delSyn) {
            $delSyn->delete();
        }
        foreach ($s_syns as $delSyn) {
            $delSyn->delete();
        }

        $word->delete();

        return redirect('/');
    }


    public function synDelete($id)
    {

        $w_syns = Synonyms::where('word_id', $id)->get();
        $s_syns = Synonyms::where('syno_id', $id)->get();
        foreach ($w_syns as $delSyn) {
            $delSyn->delete();
        }
        foreach ($s_syns as $delSyn) {
            $delSyn->delete();
        }

        return redirect('/');
    }

}
