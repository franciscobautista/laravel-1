<?php

namespace App\Console\Commands;
use App\Request;
use Illuminate\Console\Command;
use App\Events\FailedRequest;
use App\Events\SuccessRequest;

class verifyFailedRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:verifyFailedRequests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify failed request';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $failed_requests = Request::Where('status', 'failed')->get();
        foreach($failed_requests as $request)
        {
            //try send request
            try {
                $this->client->request('POST', env('URL').'?token='.$request->token);
                event(new SuccessRequest($request));
            }
            catch(\GuzzleHttp\Exception\BadResponseException $e){
                event(new FailedRequest(['error' => $e->getMessage(),'token' =>$request->token,'request_id'=>$request->id]));
            }

        }
    }
}
