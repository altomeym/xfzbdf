<?php

namespace App\Repositories\TeamPageSetting;

use App\Models\TeamPageSetting;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentTeamPageSetting extends EloquentRepository implements BaseRepository, TeamPageSettingRepository
{
    protected $model;

    public function __construct(TeamPageSetting $team_page_setting)
    {
        $this->model = $team_page_setting;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function one()
    {
        return $this->model->first();
    }


    public function update(Request $request, $id)
    {
        return parent::update($request, $id);
    }

}
