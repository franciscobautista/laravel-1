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
        \Log::info('solo actualizar');
        if(!isset($event->request['request_id']))
        {
            $request = \App\Request::create(['status' => 'failed','token' =>$event->request['token'] ]);
            $request_id = $request->id;
        }else $request_id = $event->request['request_id'];

        \App\FailedRequest::create(['request_id' => $request_id,'description'=>$event->request['error'] ]);
    }
}
