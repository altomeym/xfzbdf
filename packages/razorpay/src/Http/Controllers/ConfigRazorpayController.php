<?php

namespace Incevio\Package\Razorpay\Http\Controllers;

// use App\Common\Authorizable;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Incevio\Package\Razorpay\Models\ConfigRazorpay;
use Illuminate\Http\Request;

class ConfigRazorpayController extends Controller
{
    // use Authorizable;

    private $model_name;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();

        $this->model_name = trans('app.model.payment_method');
    }

    /**
     * Activate the Paypal Express checkout gateway
     *
     * @return \Illuminate\Http\Response
     */
    public function activate()
    {
        if (config('app.demo') == true) {
            return view('demo_modal');
        }

        $config = ConfigRazorpay::firstOrCreate(['shop_id' => Auth::user()->merchantId()]);

        return view('razorpay::config', compact('config'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $config = ConfigRazorpay::firstOrCreate(['shop_id' => Auth::user()->merchantId()]);

        $config->update($request->all());

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Deactivate the Paypal Express checkout gateway
     *
     * @return \Illuminate\Http\Response
     */
    public function deactivate()
    {
        $config = ConfigRazorpay::firstOrCreate(['shop_id' => Auth::user()->merchantId()]);

        $config->delete();

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }
}
