<?php

namespace App\Repositories\ShopAppearance;

use App\Helpers\ListHelper;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use App\Models\ShopAppearance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Storage;

class EloquentShopAppearance extends EloquentRepository implements BaseRepository, ShopAppearanceRepository
{
    protected $model;

    public function __construct(ShopAppearance $shop_appearance)
    {
        $this->model = $shop_appearance;
    }

    public function mine()
    {
        return $this->model->whereShopId(auth()->user()->shop_id)->first();
    }

    public function save(Request $request)
    {
        $shop = $this->model->where('shop_id', auth()->user()->shop_id)->first();
        if(!$shop){
            $shop = new $this->model;
            $shop->shop_id = auth()->user()->shop_id;
            $shop->save();
        }
        
        $column = $this->model->fillableFind($request->type);
        if(!$column){
            return ['status' => 0, 'message' => trans('app.something_went_wrong')];
        }

        $additional_data = null;

        if($request->type == "info_bullets"){
            $vv = $shop->info_section_bullets;
            if(!is_array($vv)){
                $vv = [];
            }

            $loop_stop_at = $request->bullet <= 3 ? 2 : ($request->bullet - 1);
            for($i = 0; $i <= $loop_stop_at; $i++){
                if(!array_key_exists($i,$vv))
                    array_splice($vv, $i, $i, '');

                if(((int)$request->bullet - 1) == $i)
                    $vv[$i] = $request->value;
            }
            $value = $vv;
            $entered_value = $value;
        }elseif($request->type == "popular"){
            $vv = $shop->popular_links;
            if(!is_array($vv)){
                $vv = [];
            }
            
            if($request->action == 'edit' && !$request->has('action')){
                return ['status' => 0, 'message' => trans('app.something_went_wrong')];
            }

            if($request->action == 'edit'){
                $entered_value = ['index' => $request->index, 'title' => $request->popular_link_text, 'link' => $request->popular_link, 'action' => $request->action];
                $vv[$request->index] = ['title' => $request->popular_link_text, 'link' => $request->popular_link];
            }else{
                $index = count($vv);
                $entered_value = ['index' => $index, 'title' => $request->popular_link_text, 'link' => $request->popular_link, 'action' => $request->action];
                array_push($vv,['title' => $request->popular_link_text, 'link' => $request->popular_link]);
            }
            $value = $vv;
        }elseif($request->type == "slider"){
            $vv = $shop->slider_links;
            if(!is_array($vv)){
                $vv = [];
            }

            if($request->action == 'edit' && !$request->has('action')){
                return ['status' => 0, 'message' => trans('app.something_went_wrong')];
            }

            if($request->action == 'add' && !$request->has('slider_link_image')){
                return ['status' => 0, 'message' => trans('app.image_is_required')];
            }elseif($request->has('slider_link_image')){
                // return $request->image;
                $file = $request->file('slider_link_image');
                $extension = $file->getClientOriginalExtension(); 
                $imageName = md5(time()).'.' . $extension;
                // return $imageName = time().'.'.$request->image->extension();
                $image = $request->slider_link_image->storeAs('images', $imageName);
                $image_url = url("image/$image");
            }else{
                $image_url = $vv[$request->index]['image'];
            }

            if($request->action == 'edit'){
                $entered_value = ['index' => $request->index, 'title' => $request->slider_link_text, 'image' => $image_url, 'link' => $request->slider_link, 'action' => $request->action];
                $vv[$request->index] = ['title' => $request->slider_link_text, 'image' => $image_url, 'link' => $request->slider_link];
            }else{
                $index = count($vv);
                $entered_value = ['index' => $index, 'title' => $request->slider_link_text, 'image' => $image_url, 'link' => $request->slider_link, 'action' => $request->action];
                array_push($vv,['title' => $request->slider_link_text, 'image' => $image_url, 'link' => $request->slider_link]);
            }

            $value = $vv;
        }elseif($request->type == "banners"){
            if($request->has('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); 
                $imageName = md5(time()).'.' . $extension;
                // return $imageName = time().'.'.$request->image->extension();
                $image = $request->image->storeAs('images', $imageName);
                $image_url = url("image/$image");
                $value = $image_url;
                $entered_value = ['type' => 'image', 'image' => $image_url];
            }else{
                $value = $request->video;
                $entered_value = ['type' => 'video', 'url' => $request->video];
            }
        }elseif($request->type == "hot"){
            $value = $request->hot_product;
            $entered_value = $request->hot_product;
            $additional_data = \App\Models\Product::with(['inventory','images'])->where('id', $value)->first();
        }elseif($request->type == "feature"){
            // $vv = $shop->$column;
            // if(!is_array($vv)){
                $vv = [];
            // }

            // if($request->save == 'edit'){

            // }else{
                $porduct_ids = explode(',',$request->featured_products);
                for($i = 0; $i < count($porduct_ids); $i++){
                    if($porduct_ids[$i]){
                        $vv[$i] = $porduct_ids[$i];
                    }
                }
            // }
            $value = array_unique($vv);
            $entered_value = $request->featured_products;
            $additional_data = \App\Models\Product::with(['inventory',
                  'inventory.avgFeedback:rating,count,feedbackable_id,feedbackable_type',
                  'inventory.images:path,imageable_id,imageable_type',
                  'images'
                ])->whereIn('id', $value)->get();
        }else{
            $value = $request->value;
            $entered_value = $value;
        }
        
        
        $shop->shop_id = auth()->user()->shop_id;
        $shop->$column = $value;
        $is_saved = $shop->save();

        if ($is_saved) {
            return [
                'status' => 1,
                'message' =>  trans('app.successfully_updated'),
                'data' => $entered_value,
                'additional' => $additional_data
            ];
        }
        
        return ['status' => 0, 'message' => trans('app.error_message_ge')];
    }

    public function delete(Request $request)
    {
        $shop = $this->model->where('shop_id', auth()->user()->shop_id)->first();
        if(!$shop){
            return ['status' => 0, 'message' => trans('app.error_message_ge')];
        }
        
        $column = $this->model->fillableFind($request->type);
        if(!$column){
            return ['status' => 0, 'message' => trans('app.error_message_ge')];
        }

        if(
            $request->type == "popular" ||
            $request->type == "slider"
        ){
            $vv = $shop->$column;
            if(!is_array($vv)){
                return ['status' => 0, 'message' => trans('app.error_message_ge')];
            }
            unset($vv[$request->index]);
            Sort($vv);

            $value = $vv;
        }

        $shop->$column = $value;
        $is_saved = $shop->save();

        if ($is_saved) {
            return [
                'status' => 1,
                'message' =>  trans('app.successfully_deleted'),
            ];
        }
        
        return ['status' => 0, 'message' => trans('app.error_message_ge')];

    }
}
