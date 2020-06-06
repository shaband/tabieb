<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Services\Drivers\TokBoxDriver;
use Illuminate\Http\Request;
use OpenTok\ArchiveMode;
use OpenTok\MediaMode;
use OpenTok\OpenTok;
use OpenTok\OutputMode;
use OpenTok\Session;
use OpenTok\Role;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('test');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test(Request $request)
    {

        


        $opentok = new TokBoxDriver();

        if (!$request->sessionId) {
            $sessionId = $opentok->defaultSession()->getSessionId();
        } else {
            $sessionId = $request->sessionId;
        }


        $token = $opentok->generateToken($sessionId);

        $type = 'doctor';

        $chat=new Chat();

        return view('call', compact('token', 'sessionId', 'type','chat'));
    }

}
