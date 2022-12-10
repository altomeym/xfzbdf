<?php

namespace App\Repositories\TeamMember;

use App\Models\TeamMember;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentTeamMember extends EloquentRepository implements BaseRepository, TeamMemberRepository
{
    protected $model;

    public function __construct(TeamMember $team_member)
    {
        $this->model = $team_member;
    }

    public function all()
    {
        return $this->model->with('image')->get();
    }

    public function trashOnly()
    {
        return $this->model->onlyTrashed()->get();
    }

    //Create TeamMember
    public function store(Request $request)
    {
        return parent::store($request);
    }

    public function update(Request $request, $id)
    {
        return parent::update($request, $id);
    }

    public function destroy($id)
    {
        $team_member = parent::findTrash($id);

        $team_member->flushImages();

        return $team_member->forceDelete();
    }

    public function massDestroy($ids)
    {
        $catSubGrps = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($catSubGrps as $catSubGrp) {
            $catSubGrp->flushImages();
        }

        return parent::massDestroy($ids);
    }

    public function emptyTrash()
    {
        $catSubGrps = $this->model->onlyTrashed()->get();

        foreach ($catSubGrps as $catSubGrp) {
            $catSubGrp->flushImages();
        }

        return parent::emptyTrash();
    }
}
