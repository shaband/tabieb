<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuthModelProvider;
use App\Models\Patient;
use App\Repositories\interfaces\AuthModelProviderRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{

    public $repo;

    public function __construct(AuthModelProviderRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();


        if ($user->getEmail() == null) {
            toast('Sorry Your Account Doesn\'t provide any email to login with');
            return redirect()->route('home');
        }
        $patient = $this->repo->storePatientAuthProvider($user, $provider);
        Auth::guard('patient')->login($patient);
        toast('You Logined In Successfully');
        return redirect()->route('home');
    }



}
