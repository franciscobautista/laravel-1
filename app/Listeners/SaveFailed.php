<?php

namespace App\Listeners;

use App\Events\FailedRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveFailed implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FailedRequest  $event
     * @return void
     */
    public function handle(FailedRequest $event)
    {
        $request = \App\Request::create(['status' => 'failed','token' =>$event->request['token'] ]);
        \App\FailedRequest::create(['request_id' => $request->id,'description'=>$event->request['error'] ]);
    }
}
