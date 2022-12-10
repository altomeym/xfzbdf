<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategorySubGroup;
use App\Models\Category;

class AjaxController extends Controller
{
    /**
     * [ajaxGetFromPHPHelper description]
     *
     * @param  string $funcName name of the PHP helper fucntion
     * @param  mix $args     arguments will need to pass to the helper function
     *
     * @return mix         results from PHP Helper fucntion
     */
    public function ajaxGetFromPHPHelper(Request $request)
    {
        // \Log::info($request->all());

        if ($request->ajax()) {
            $funcName = $request->input('funcName');
            $args = $request->input('args');

            $args = is_array($args) ? $args : explode(',', $args);

            $results = call_user_func_array($funcName, $args);

            if (is_object($results)) {
                return json_encode($results);
            }

            return $results;
        }

        return false;
    }

    /**
     * Return Shipping Options
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function filterShippingOptions(Request $request)
    {
        if ($request->ajax()) {
            return filterShippingOptions($request->input('zone'), $request->input('price'), $request->input('weight'));
        }

        return false;
    }

    public function category_sub_groups(Request $request)
    {
        return CategorySubGroup::select('id','name')->where('category_group_id', $request->id)->get();
    }

    public function categories(Request $request)
    {
        return Category::select('id','name')->where('category_sub_group_id', $request->id)->get();
    }
    
}
