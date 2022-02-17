<?php


namespace Miniyus\TistoryApi\Console\Commands;

use Illuminate\Console\Command;

class StartChromeDriver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chromedriver:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'start chrome driver';

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
    public function handle(): int
    {
        $driverPath = config('webdriver.driver_path') ?? config('api_server.tistory.webdriver.driver_path');
        exec("screen -d -m -S lumen $driverPath/chromedriver --port=4444", $output);
        $this->info('start chrome driver');
        $this->info(json_encode($output, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        return 0;
    }
}
