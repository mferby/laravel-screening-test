<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;

class EventTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_warmup_events(): void
    {
        $datePast = (new Carbon)->subYear()->setDay(21);
        $dateFuture = (new Carbon)->addYears(1);

        $response = $this->get('/warmupevents');
        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonPath('0.name', 'Laravel convention '.$datePast->year)
            ->assertJsonPath('1.name', 'Laravel convention '.$dateFuture->year)
            ->assertJsonPath('2.name', 'React convention '.$dateFuture->year);
    }

    public function test_events(): void
    {
        $datePast = (new Carbon)->subYear()->setDay(21);
        $dateFuture = (new Carbon)->addYears(1);

        $response = $this->get('/events');
        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonPath('0.name', 'Laravel convention '.$datePast->year)
            ->assertJsonPath('0.workshops.0.name', 'Illuminate your knowledge of the laravel code base')
            ->assertJsonPath('1.name', 'Laravel convention '.$dateFuture->year)
            ->assertJsonPath('1.workshops.0.name', 'The new Eloquent - load more with less')
            ->assertJsonPath('1.workshops.1.name', 'AutoEx - handles exceptions 100% automatic')
            ->assertJsonPath('2.name', 'React convention '.$dateFuture->year)
            ->assertJsonPath('2.workshops.0.name', '#NoClass pure functional programming')
            ->assertJsonPath('2.workshops.1.name', 'Navigating the function jungle');
    }

    public function test_future_events(): void
    {
        $dateFuture = (new Carbon)->addYears(1);

        $response = $this->get('/futureevents');
        $response->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonPath('0.name', 'Laravel convention '.$dateFuture->year)
            ->assertJsonPath('0.workshops.0.name', 'The new Eloquent - load more with less')
            ->assertJsonPath('0.workshops.1.name', 'AutoEx - handles exceptions 100% automatic')
            ->assertJsonPath('1.name', 'React convention '.$dateFuture->year)
            ->assertJsonPath('1.workshops.0.name', '#NoClass pure functional programming')
            ->assertJsonPath('1.workshops.1.name', 'Navigating the function jungle');
    }
}
