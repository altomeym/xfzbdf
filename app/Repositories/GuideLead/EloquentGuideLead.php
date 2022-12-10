<?php

namespace App\Repositories\GuideLead;

use App\Models\GuideLead;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentGuideLead extends EloquentRepository implements BaseRepository, GuideLeadRepository
{
    protected $model;

    public function __construct(GuideLead $guide_lead)
    {
        $this->model = $guide_lead;
    }

    public function all()
    {
        return $this->model/*->with('coverImage')*/->get();
    }

    // public function trashOnly()
    // {
    //     return $this->model->get();
    // }

    //Create GuideLead
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
        $guide_lead = parent::find($id);

        $guide_lead->flushImages();

        return $guide_lead->delete();
    }

    public function massDestroy($ids)
    {
        $catSubGrps = $this->model->whereIn('id', $ids)->get();

        foreach ($catSubGrps as $catSubGrp) {
            $catSubGrp->flushImages();
        }

        return parent::massDestroy($ids);
    }

    // public function emptyTrash()
    // {
    //     $catSubGrps = $this->model->onlyTrashed()->get();

    //     foreach ($catSubGrps as $catSubGrp) {
    //         $catSubGrp->flushImages();
    //     }

    //     return parent::emptyTrash();
    // }
}
