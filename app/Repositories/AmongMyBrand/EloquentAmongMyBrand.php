<?php

namespace App\Repositories\AmongMyBrand;

use App\Models\AmongMyBrand;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentAmongMyBrand extends EloquentRepository implements BaseRepository, AmongMyBrandRepository
{
    protected $model;

    public function __construct(AmongMyBrand $amongMyBrand)
    {
        $this->model = $amongMyBrand;
    }

    public function all()
    {
        $query = $this->model->with('image');
        return $query->get();
    }

    // public function trashOnly()
    // {
    //     $query = $this->model;

    //     // if (Auth::user()->isFromPlatform()) {
    //     //     return $query->get();
    //     // }

    //     return $query->mine()->get();
    // }

    public function store(Request $request)
    {
        $among_my_brand = parent::store($request);

        return $among_my_brand;
    }

    public function update(Request $request, $id)
    {
        $among_my_brand = parent::update($request, $id);

        return $among_my_brand;
    }

    public function destroy($id)
    {
        $among_my_brand = parent::find($id);
        $among_my_brand->flushImages();

        return $among_my_brand->delete();
    }

    public function massDestroy($ids)
    {
        $among_my_brands = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($among_my_brands as $among_my_brand) {
            $among_my_brand->flushImages();
        }

        return parent::massDestroy($ids);
    }

    public function emptyTrash()
    {
        $among_my_brands = $this->model->get();

        foreach ($among_my_brands as $among_my_brand) {
            $among_my_brand->flushImages();
        }

        return parent::emptyTrash();
    }
}
