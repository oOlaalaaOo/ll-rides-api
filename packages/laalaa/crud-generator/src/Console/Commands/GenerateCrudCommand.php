<?php

namespace LaaLaa\CrudGenerator\Console\Commands;

use Illuminate\Console\Command;
use LaaLaa\CrudGenerator\Services\FileGenerator\FileGeneratorService;

class GenerateCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate crud';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  \App\DripEmailer  $drip
     * @return mixed
     */
    public function handle()
    {
        $fileGeneratorService = new FileGeneratorService($this->argument('model'));
        $fileGeneratorService->generateAllFiles();
    }
}