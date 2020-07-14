<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\NewWord;
use App\Jobs\SyncMedia;
use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\WordController
 */
class WordControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $words = factory(Word::class, 3)->create();

        $response = $this->get(route('word.index'));

        $response->assertOk();
        $response->assertViewIs('word.index');
        $response->assertViewHas('words');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $word = factory(Word::class)->create();

        $response = $this->get(route('word.show', $word));

        $response->assertOk();
        $response->assertViewIs('word.show');
        $response->assertViewHas('word');
    }


    /**
     * @test
     */
    public function create_redirects()
    {
        $response = $this->get(route('word.create'));

        $response->assertRedirect(route('word.create'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WordController::class,
            'store',
            \App\Http\Requests\WordStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $word = $this->faker->word;
        $countary = $this->faker->word;
        $language = $this->faker->word;
        $meaning = $this->faker->word;
        $defination = $this->faker->text;

        Queue::fake();
        Event::fake();

        $response = $this->post(route('word.store'), [
            'word' => $word,
            'countary' => $countary,
            'language' => $language,
            'meaning' => $meaning,
            'defination' => $defination,
        ]);

        $words = Word::query()
            ->where('word', $word)
            ->where('countary', $countary)
            ->where('language', $language)
            ->where('meaning', $meaning)
            ->where('defination', $defination)
            ->get();
        $this->assertCount(1, $words);
        $word = $words->first();

        $response->assertRedirect(route('word.index'));
        $response->assertSessionHas('word.word', $word->word);

        Queue::assertPushed(SyncMedia::class, function ($job) use ($word) {
            return $job->word->is($word);
        });
        Event::assertDispatched(NewWord::class, function ($event) use ($word) {
            return $event->word->is($word);
        });
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $word = factory(Word::class)->create();

        $response = $this->get(route('word.edit', $word));

        $response->assertOk();
        $response->assertViewIs('word.edit');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WordController::class,
            'update',
            \App\Http\Requests\WordUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $word = factory(Word::class)->create();
        $word = $this->faker->word;
        $countary = $this->faker->word;
        $language = $this->faker->word;
        $meaning = $this->faker->word;
        $defination = $this->faker->text;

        Queue::fake();
        Event::fake();

        $response = $this->put(route('word.update', $word), [
            'word' => $word,
            'countary' => $countary,
            'language' => $language,
            'meaning' => $meaning,
            'defination' => $defination,
        ]);

        $word->refresh();

        $response->assertRedirect(route('word.index'));
        $response->assertSessionHas('word.word', $word->word);

        $this->assertEquals($word, $word->word);
        $this->assertEquals($countary, $word->countary);
        $this->assertEquals($language, $word->language);
        $this->assertEquals($meaning, $word->meaning);
        $this->assertEquals($defination, $word->defination);

        Queue::assertPushed(SyncMedia::class, function ($job) use ($word) {
            return $job->word->is($word);
        });
        Event::assertDispatched(NewWord::class, function ($event) use ($word) {
            return $event->word->is($word);
        });
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $word = factory(Word::class)->create();

        $response = $this->delete(route('word.destroy', $word));

        $response->assertRedirect(route('back'));

        $this->assertDeleted($word);
    }
}
