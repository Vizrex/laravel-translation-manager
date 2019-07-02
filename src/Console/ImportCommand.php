<?php

namespace Barryvdh\TranslationManager\Console;

use Barryvdh\TranslationManager\Manager;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ImportCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'translations:import {path?} {siteId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import translations from the PHP sources';

    /** @var \Barryvdh\TranslationManager\Manager */
    protected $manager;

    public function __construct(Manager $manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $replace = $this->option('replace');
        $replace = false;
        $path = $this->argument('path');
        $siteId = $this->argument('siteId');

        if (!empty($path) && !empty($siteId))
        {
            $counter = $this->manager->importTranslations($replace,$path, $siteId);
        }
        else
        {
            $counter = $this->manager->importTranslations($replace);
        }



        $this->info('Done importing, processed '.$counter.' items!');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['replace', 'R', InputOption::VALUE_NONE, 'Replace existing keys'],
        ];
    }
}
