<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Contact\ContactResource;
use App\Repositories\interfaces\ContactRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{


    public $repo;

    public function __construct(ContactRepository $repo)
    {
        $this->repo = $repo;
    }

    public function send(Request $request)
    {

        $this->validate($request, [
            'name' => 'nullable|string|max:191',
            'email' => 'required|email|max:191',
            'subject' => 'nullable|string|max:191',
            'message' => 'required|string',
        ]);


        $contact = $this->repo->store($request->all());


        alert(__('Your Message Sent Successfully'), __("We Will Contact With You Soon"), 'success');
        return redirect()->route('home');

    }
}
