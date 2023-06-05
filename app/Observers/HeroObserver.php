<?php

namespace App\Observers;

use App\Models\Hero;
use Illuminate\Support\Str;

class HeroObserver
{
    /**
     * Handle the Hero "created" event.
     */
    public function creating(Hero $hero): void
    {
        $hero->url = Str::slug($hero->alias, '-');
    }

    /**
     * Handle the Hero "updated" event.
     */
    public function updating(Hero $hero): void
    {
        $hero->url = Str::slug($hero->alias, '-');

    }

    /**
     * Handle the Hero "deleted" event.
     */
    public function deleted(Hero $hero): void
    {
        //
    }

    /**
     * Handle the Hero "restored" event.
     */
    public function restored(Hero $hero): void
    {
        //
    }

    /**
     * Handle the Hero "force deleted" event.
     */
    public function forceDeleted(Hero $hero): void
    {
        //
    }
}
