<?php

namespace App\Listeners;

use App\Models\Bitacora;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        //
        Bitacora::create([
            'user_id' => $event->user->id,
            'accion' => 'logout',
            'ip' => Request::ip(),
        ]);
    }
}
