<?php

namespace App\Http\Controllers\Admin;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\UpdateTeamPageSettingRequest;
use App\Models\TeamPageSetting;
use App\Repositories\TeamPageSetting\TeamPageSettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TeamPageSettingController extends Controller
{
    // use Authorizable;

    private $model;

    private $team_page_setting;

    /**
     * construct
     */
    public function __construct(TeamPageSettingRepository $team_page_setting)
    {
        parent::__construct();
        $this->model = trans('app.model.team_page_setting');
        $this->team_page_setting = $team_page_setting;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_page_setting = $this->team_page_setting->one();

        return view('admin.team_page_setting.index', compact('team_page_setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamPageSettingRequest $request, $id)
    {
        $this->team_page_setting->update($request, $id);

        Cache::forget('cached_team_page_settings');

        return back()->with('success', trans('messages.updated', ['model' => $this->model]));
    }

}
