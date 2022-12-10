<?php

namespace App\Http\Controllers\Storefront;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\OrderDetailRequest;
use App\Http\Requests\Validations\ProductFeedbackCreateRequest;
use App\Http\Requests\Validations\ShopFeedbackCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// start added by hassan00942 + reviewUiLookLikeFiver00942
use App\Models\FeedbackBreakdown;
use App\Models\Feedback;
use App\Models\FeedbackHelpful;
use Illuminate\Http\Request;
// end added by hassan00942 + reviewUiLookLikeFiver00942

class FeedbackController extends Controller
{
    /**
     * Show feedback form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function feedback_form(OrderDetailRequest $request, Order $order)
    {
        $order->load([
            'shop' => function ($q) {
                return $q->withCount([
                    'feedbacks as ratings' => function ($q2) {
                        $q2->select(DB::raw('avg(rating)'));
                    },
                ]);
            },
            'inventories' => function ($q) {
                return $q->with(['image:path,imageable_id,imageable_type'])
                    ->withCount([
                        'feedbacks as ratings' => function ($q2) {
                            $q2->select(DB::raw('avg(rating)'));
                        },
                    ]);
            },
        ]);

        // $order->load([
        //     'inventories.image',
        //     'inventories.product.feedbacks:id,feedbackable_id'
        // ]);
        // ->loadCount('shop.feedbacks');

        return view('theme::feedback_form', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Order   $order
     * @return \Illuminate\Http\Response
     */
    public function save_shop_feedbacks(ShopFeedbackCreateRequest $request, Order $order)
    {
        $feedback = $order->shop->feedbacks()->create($request->all());

        $order->feedback_given($feedback->id);

        return back()->with('success', trans('theme.notify.your_feedback_saved'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Order   $order
     * @return \Illuminate\Http\Response
     */
    public function save_product_feedbacks(ProductFeedbackCreateRequest $request, Order $order)
    {
        $inputs = $request->input('items');
        $customer_id = Auth::guard('customer')->user()->id; //Set customer_id

        foreach ($order->inventories as $inventory) {
            $feedback_data = $inputs[$inventory->id];
            $feedback_data['customer_id'] = $customer_id;

            $feedback = $inventory->feedbacks()->create($feedback_data);
			
			// start added by hassan00942 + reviewUiLookLikeFiver00942
            $feedback_breakdown = new FeedbackBreakdown;
            $feedback_breakdown->shop_id = $inventory->shop_id;
            $feedback_breakdown->product_id = $inventory->product_id;
            $feedback_breakdown->inventory_id = $inventory->id;
            $feedback_breakdown->feedback_id = $feedback->id;
            $feedback_breakdown->seller_communication_level = $inputs[$inventory->id]['rating_seller_communication_level'];
            $feedback_breakdown->recommend_to_a_friend = $inputs[$inventory->id]['rating_recommend_to_a_friend'];
            $feedback_breakdown->service_as_described = $inputs[$inventory->id]['rating_service_as_described'];
            $feedback_breakdown->created_at = $feedback->created_at;
            $feedback_breakdown->updated_at = $feedback->updated_at;
            $feedback_breakdown->save();
            // end added by hassan00942 + reviewUiLookLikeFiver00942
			
            // Update feedback_id in order_items table
            DB::table('order_items')->where('order_id', $inventory->pivot->order_id)
                ->where('inventory_id', $inventory->id)
                ->update(['feedback_id' => $feedback->id]);
        }

        return back()->with('success', trans('theme.notify.your_feedback_saved'));
    }
	
    // start add hassan00942 + reviewUiLookLikeFiver00942
    public function feedback_helpful_store(Request $request, Feedback $feedback)
    {
        if($request->vote == 'yes'){
            $yes = 1;
            $no = 0;
            $class = 'ml-2 text-go';
            $text = 'You found this review helpful.';
        }else{
            $yes = 0;
            $no = 1;
            $class = 'text-danger';
            $text = '';
        }
        $voted = FeedbackHelpful::updateOrCreate([
            'customer_id' => auth('customer')->user()->id,
            'feedback_id' => $feedback->id,
        ],[
            'yes' => $yes,
            'no' => $no,
        ]);

        if(!$voted->wasRecentlyCreated && $voted->wasChanged()){
            return response()->json([
                'status' => 200,
                'class' => $class,
                'text' => $text,
                'message' => "Your response has been updated"
            ]);
        }
        
        if(!$voted->wasRecentlyCreated && !$voted->wasChanged()){
            // updateOrCreate performed nothing, row did not change
            return response()->json([
                'status' => 200,
                'class' => "",
                'text' => "",
                'message' => ""
            ]);
        }
        
        if($voted->wasRecentlyCreated){
           return response()->json([
               'status' => 200,
               'class' => $class,
               'text' => $text,
               'message' => "Your vote has been subitted"
            ]);
        }
    }
    // end hassan00942 + reviewUiLookLikeFiver00942
}
