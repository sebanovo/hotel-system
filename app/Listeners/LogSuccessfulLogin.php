<?php

namespace App\Listeners;

use App\Models\Bitacora;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
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
    public function handle(Login $event): void
    {
        //
        Bitacora::create([
            'user_id' => $event->user->id,
            'accion' => 'login',
            'ip' => Request::ip(),
        ]);
    }
}
