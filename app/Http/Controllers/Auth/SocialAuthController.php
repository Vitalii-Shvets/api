<?php

namespace App\Http\Controllers\Auth;

use App\Services\SocialiteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    private $socialiteService;

    public function __construct(SocialiteService $socialiteService)
    {

        $this->socialiteService = $socialiteService;
    }

    /**
     * Create a redirect method to facebook api.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     *
     * @return RedirectResponse
     */
    public function handleProviderCallback()
    {
        $user =  $this->socialiteService->createOrGetUser(Socialite::driver('google')->user());
        Auth::login($user);
        return Redirect::to('/');
    }
}
