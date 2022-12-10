<?php

namespace App\Http\Controllers\Admin;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Models\CountryWiseWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Http\Requests\Validations\CreateCountryWiseWebsiteRequest;
use App\Http\Requests\Validations\UpdateCountryWiseWebsiteRequest;


class CountryWiseWebsiteController extends Controller
{
    private $model;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = trans('app.country_wise_website');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country_wise_websites = CountryWiseWebsite::with('country')->get();

        // $trashes = CountryWiseWebsite::onlyTrashed()->get();

        return view('admin.country-wise-websites.index', compact('country_wise_websites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country-wise-websites._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCountryWiseWebsiteRequest $request)
    {
        $country_wise_website = CountryWiseWebsite::create($request->except('_token'));

        // Clear cache_country_wise_websites from cache
        Cache::forget('cache_country_wise_websites');

        return back()->with('success', trans('messages.created', ['model' => $this->model]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountryWiseWebsite  $country_wise_website
     * @return \Illuminate\Http\Response
     */
    public function edit(CountryWiseWebsite $country_wise_website)
    {
        return view('admin.country-wise-websites._edit', compact('country_wise_website'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CountryWiseWebsite  $country_wise_website
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryWiseWebsiteRequest $request, CountryWiseWebsite $country_wise_website)
    {
        $country_wise_website->update($request->all());

        // Clear cache_country_wise_websites from cache
        Cache::forget('cache_country_wise_websites');

        return back()->with('success', trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $country_wise_website = CountryWiseWebsite::findOrFail($id);

        $country_wise_website->forceDelete();

        // Clear cache_country_wise_websites from cache
        Cache::forget('cache_country_wise_websites');

        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }

}
