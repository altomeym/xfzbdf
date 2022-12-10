<?php

namespace App\Http\Controllers\Admin;

// use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateAmongMyBrandRequest;
use App\Http\Requests\Validations\UpdateAmongMyBrandRequest;
use App\Repositories\AmongMyBrand\AmongMyBrandRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AmongMyBrandController extends Controller
{
    // use Authorizable;

    private $model_name;

    private $among_my_brand;

    /**
     * construct
     */
    public function __construct(AmongMyBrandRepository $among_my_brand)
    {
        parent::__construct();

        $this->model_name = trans('app.model.among_my_brand');

        $this->among_my_brand = $among_my_brand;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $among_my_brands = $this->among_my_brand->all();

        // $trashes = $this->among_my_brand->trashOnly();

        return view('admin.among-my-brand.index', compact('among_my_brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.among-my-brand._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAmongMyBrandRequest $request)
    {
        $this->among_my_brand->store($request);
        Cache::forget('among_my_brands');
        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $among_amy_brand = $this->among_my_brand->find($id);

        return view('admin.among-my-brand._show', compact('among_amy_brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AmongMyBrand  $among_my_brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $among_my_brand = $this->among_my_brand->find($id);

        return view('admin.among-my-brand._edit', compact('among_my_brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAmongMyBrandRequest $request, $id)
    {
        $this->among_my_brand->update($request, $id);
        Cache::forget('among_my_brands');
        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        return 1;
        $this->among_my_brand->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->among_my_brand->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->among_my_brand->destroy($id);

        return back()->with('success', trans('messages.deleted', ['model' => $this->model_name]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        $this->among_my_brand->massTrash($request->ids);

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.trashed', ['model' => $this->model_name])]);
        }

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        $this->among_my_brand->massDestroy($request->ids);

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model_name])]);
        }

        return back()->with('success', trans('messages.deleted', ['model' => $this->model_name]));
    }

    /**
     * Empty the Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emptyTrash(Request $request)
    {
        $this->among_my_brand->emptyTrash($request);

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model_name])]);
        }

        return back()->with('success', trans('messages.deleted', ['model' => $this->model_name]));
    }
}
