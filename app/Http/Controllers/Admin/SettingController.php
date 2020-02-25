<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController as Controller;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Repositories\interfaces\SettingRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    protected $repo;
    protected $routeName = 'admin.settings.';
    protected $viewPath = 'admin.settings.';


    public function __construct(SettingRepository $repo)
    {
        $this->repo = $repo;
        parent::__construct($repo);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $settings = $this->repo->findByField('category', '1');


        return view($this->viewPath . 'index', compact('settings'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $setting = $this->repo->find($id);
        if ($setting->input_type == $setting::INPUT_TEXT) {

            $type = 'text';
        } elseif ($setting->input_type == $setting::INPUT_NUMBER) {
            $type = 'number';
        } else {
            $type = 'textarea';
        }
        return view($this->viewPath . 'edit', compact('setting', 'type'));
    }

    /**
     * @param SettingRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingRequest $request, $id)
    {
        $setting = $this->repo->update($request->all(), $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route($this->routeName . 'index');
    }
}
