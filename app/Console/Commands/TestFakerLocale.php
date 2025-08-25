<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestFakerLocale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:faker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menjalankan tes langsung pada Faker locale untuk diagnosis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("=============================================");
        $this->info("HASIL TES FAKER LOCALE");
        $this->info("=============================================");

        $this->line("Nilai config('app.faker_locale'): " . config('app.faker_locale'));
        $this->line("");

        $this->comment("--> Menjalankan fake()->name():");
        $this->line(fake()->name());
        $this->line("");
        
        $this->comment("--> Menjalankan fake()->city():");
        $this->line(fake()->city());
        $this->line("");

        $this->comment("--> Menjalankan fake()->sentence():");
        $this->line(fake()->sentence());
        $this->line("");

        $this->info("=============================================");

        return 0;
    }
}