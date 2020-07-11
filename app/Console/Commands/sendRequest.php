<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sendRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendRequest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a post request to url';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $this->apiToken = uniqid();

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment("Send request to url");
        $request = $this->client->request('POST', env('URL'));

    }
}