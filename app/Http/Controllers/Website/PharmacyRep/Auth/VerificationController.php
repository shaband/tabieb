<?php

namespace App\Http\Controllers\Website\PharmacyRep\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/pharmacy_rep';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pharmacy_rep.auth');
        $this->middleware('signed')->only('pharmacy_rep.verify');
        $this->middleware('throttle:6,1')->only('pharmacy_rep.verify', 'resend');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        return $request->user('pharmacy_rep')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('website.pharmacy_rep.auth.verify');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        if (! hash_equals((string) $request->route('id'), (string) $request->user('pharmacy_rep')->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user('pharmacy_rep')->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user('pharmacy_rep')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('pharmacy_rep')->markEmailAsVerified()) {
            event(new Verified($request->user('pharmacy_rep')));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user('pharmacy_rep')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user('pharmacy_rep')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

}
