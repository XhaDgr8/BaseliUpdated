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
        $synos = [];
        foreach ($words as $word){
            $aSyns = $this->getAllSynonyms($word->id);
            array_push($synos, [$word->word => $aSyns]);
        }
        return view('word.print', compact('words','synos'));
    }

    public function getAllSynonyms($id)
    {

        $synonyms = [];

        $word_defi = Word::where('id', $id)->first();
        $syno_id = Synonyms::where('word_id', $id)->get();

        if ($syno_id != null) {
            foreach ($syno_id as $find_word){
                $found_word = Word::where('id', $find_word->syno_id)->get();
                foreach ($found_word as $synonym){
                    $defi = $synonym->defination === $word_defi->defination ? '-' : $synonym->defination;
                    array_push($synonyms, [
                        'id' => $synonym->id,
                        'word' => $synonym->word,
                        'language' => $synonym->language,
                        'countary' => $synonym->countary,
                        'defination' => $defi,
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

    public function synLoopers($ids)
    {
        foreach ($ids as $wo) {
            foreach ($ids as $so) {
                if ($wo != $so) {
                    $this->makeRels($wo, $so);
                }
            }
        }
        foreach ($ids as $so) {
            foreach ($ids as $wo) {
                if ($so != $wo) {
                    $this->makeRels($wo, $so);
                }
            }
        }
        return true;
    }

    public function makeSynonyms(Request $request)
    {
        $newArray = [];
        if (count($request->all()) > 1) {
            $this->synLoopers($request->all());
        } else {
            array_push($newArray, 'A minimum of Two Words Are Required to be made synonyms');
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

        $sliced = array_slice($request->all(),1);
        $wos = [];
        $makeSyns = [];

        if (array_key_exists('0_word', $sliced)){
            $rw = '0_word';
            $rl = '0_language';
            $rc = '0_countary';
            array_push($wos, [
                $request->$rw,
                $request->$rl,
                $request->$rc
            ]);
        }

        for ($w = 1; $w <= count($sliced); $w++) {
            if (array_key_exists($w.'_word', $sliced)) {
                $rw = $w.'_word';
                array_key_exists($w.'_language', $sliced) ? $rl = $w.'_language' : $rl = '';
                array_key_exists($w.'_countary', $sliced) ? $rc = $w.'_countary' : $rc = '';
                array_push($wos, [
                    $request->$rw,
                    $rl != '' ? $request->$rl : [],
                    $rc != '' ? $request->$rc : [],
                ]);
            }
        }

        foreach ($wos as $create) {
            $ifWordExists = Word::where('word', $create[0])->first();

            if ($ifWordExists == null) {
                $word = Word::create([
                    'word' => $create[0],
                    'language' => $create[1],
                    'countary' => $create[2],
                    'defination' => $request->defination,
                ]);
                array_push($makeSyns, $word->id);
            } else {
                $syns = Synonyms::where('word_id', $ifWordExists->id)->get();
                foreach ($syns as $syn){
                    array_push($makeSyns, $syn->syno_id);
                }
                array_push($makeSyns, $ifWordExists->id);
            }
        }

        if (count($makeSyns) > 1) {
            $this->synLoopers($makeSyns);
        }

        return back();
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

//        $syn_d = Synonyms::where('word_id', $word->id)->get();
//        foreach ($syn_d as $syns) {
//            $get_words = Word::where('id', $syns->syno_id)->get();
//            foreach ($get_words as $gw){
//                $gw->update([
//                    "defination" => $word->defination
//                ]);
//            }
//        }

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
