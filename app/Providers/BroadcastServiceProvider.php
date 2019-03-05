<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();
        // Route::post('/broadcasting/auth', function (\Illuminate\Http\Request $req) {
        //     if ($req->channel_name == 'presence-chat') {
        //         if (!$req->user()) {
        //             $this->createGuestAndLogin();
        //         }
        //         $broadcast =  Broadcast::auth($req);
        //         // auth()->logout();
        //         return $broadcast;
        //     }
        //     return abort(403);
        // });

        require base_path('routes/channels.php');
    }

    protected function createGuestAndLogin()
    {
        $guest = factory(User::class)->make(['id' => (int)str_replace('.', '', microtime(true))]);
        $guest->makeHidden(['email', 'created_at']);
        Auth::login($guest);
        return $guest;
    }
}
