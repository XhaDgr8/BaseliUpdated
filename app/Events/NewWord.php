<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class NewWord
{
    use SerializesModels;

    public $word;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($word)
    {
        $this->word = $word;
    }
}
