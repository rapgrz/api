<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Advertisement;

class Top extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top10';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $ads = Advertisement::orderBy('views', 'DESC')->take(10)->get();
        echo "TOP 10 advertisements: \n";
        foreach($ads as $key => $ad){
          $key += 1;
          echo "#$key $ad->title :: $ad->views views \n";
        }
    }
}
