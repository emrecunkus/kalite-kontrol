<?php 
namespace App\Observers;

use Illuminate\Support\Facades\Log;

class LoginObserver
{
    /**
     * Handle the user login event.
     */
    public function userLoggedIn($samAccountName)
    {
        Log::info('User ' . $samAccountName . ' logged in.');
    }

    /**
     * Handle the user logout event.
     */
    public function userLoggedOut($samAccountName)
    {
        Log::info('User ' . $samAccountName . ' logged out.');
    }
}
