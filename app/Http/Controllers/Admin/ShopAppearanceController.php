<?php

namespace App\Http\Controllers\Admin;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\UpdateShopAppearanceRequest;
use App\Repositories\ShopAppearance\ShopAppearanceRepository;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ShopAppearanceController extends Controller
{
    // use Authorizable;

    private $model_name;

    private $shop_appearance;

    /**
     * construct
     */
    public function __construct(ShopAppearanceRepository $shop_appearance)
    {
        parent::__construct();

        $this->model_name = trans('app.model.shop_appearance');

        $this->shop_appearance = $shop_appearance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Cache::rememberForever('sliders', function () {
            return Slider::orderBy('order', 'asc')
                ->with([
                    'featureImage:path,imageable_id,imageable_type',
                    'mobileImage:path,imageable_id,imageable_type',
                ])
                ->get()->toArray();
        });

        $shop_appearance = $this->shop_appearance->mine();

        return view('admin.shop_appearance.index', compact('shop_appearance', 'sliders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function save(UpdateShopAppearanceRequest $request)
    {
        // return 1;
        $status = $this->shop_appearance->save($request);

        if($status['status'] == 1){
            return response()->json([
                'toastr' => 'success',
                'title' => 'Success',
                'message' => $status['message'],
                'data' => $status['data'],
                'additional' => $status['additional'],
            ]);
        }else if($status['status'] == 0){
            return response()->json([
                'toastr' => 'error',
                'title' => 'Error',
                'message' => $status['message'],
                'data' => '',
            ]);
        }

        return response()->json([
            'toastr' => 'error',
            'title' => 'Error',
            'message' => 'There is an error, please make sure everything is right',
            'data' => '',
        ]);
        // return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * delete from array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // return 1;
        $delete = $this->shop_appearance->delete($request);
        if($delete['status'] == 1){
            return response()->json([
                'toastr' => 'success',
                'title' => 'Success',
                'message' => $delete['message'],
            ]);
        }else if($delete['status'] == 0){
            return response()->json([
                'toastr' => 'error',
                'title' => 'Error',
                'message' => $delete['message'],
            ]);
        }

        return response()->json([
            'toastr' => 'error',
            'title' => 'Error',
            'message' => 'There is an error, please make sure everything is right',
        ]);
    }
}
