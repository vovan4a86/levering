<?php

namespace App\Console\Commands;

use App\Imports\LightsImport;
use Fanky\Admin\ImportXls;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Lights extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:lights';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Парсим освещение';

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
     * @return int
     */
    public function handle() {
//        Excel::import(new LightsImport, public_path('test/test.xlsx'));

        $import = new ImportXls(public_path('/test/test.xlsx'));
        $import->getImages();
    }
}
