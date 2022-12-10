<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeedbackBreakdown;
use App\Models\Feedback;
use Auth;
use View;


use App\Models\Review;
class FakeReviewController extends Controller
{
  

    public function add_csv()
    {
		if(auth()->user()->can('create', \App\Models\Review::class)){
            return view('admin.review.add_csv');
		}
		return redirect('/')->with('message', 'buhaha!');
		
    }       
      

	public function parse_csv ($csv_string, $delimiter = ",", $skip_empty_lines = true, $trim_fields = true)
	{
		$enc = preg_replace('/(?<!")""/', '!!Q!!', $csv_string);
		$enc = preg_replace_callback(
			'/"(.*?)"/s',
			function ($field) {
				return urlencode(utf8_encode($field[1]));
			},
			$enc
		);
		$lines = preg_split($skip_empty_lines ? ($trim_fields ? '/( *\R)+/s' : '/\R+/s') : '/\R/s', $enc);
		return array_map(
			function ($line) use ($delimiter, $trim_fields) {
				$fields = $trim_fields ? array_map('trim', explode($delimiter, $line)) : explode($delimiter, $line);
				return array_map(
					function ($field) {
						return str_replace('!!Q!!', '"', utf8_decode(urldecode($field)));
					},
					$fields
				);
			},
			$lines
		);
	}


	public function parse_ecsv($file, $options = null)
	{
		$delimiter = empty($options['delimiter']) ? "," : $options['delimiter'];
		$to_object = empty($options['to_object']) ? false : true;
	  
		$str = $file;
	  
		$lines = explode("\n", $str);
	   // pr($lines);
		$field_names = explode($delimiter, array_shift($lines));
		foreach ($lines as $line) {
			// Skip the empty line
			if (empty($line)) continue;
			$fields = explode($delimiter, $line);
			$_res = $to_object ? new stdClass : array();
			foreach ($field_names as $key => $f) {
				if ($to_object) {
					$_res->{$f} = $fields[$key];
				} else {
					$_res[$f] = $fields[$key];
				}
			}
			$res[] = $_res;
		}
		return $res;
	}

	  
    
	public function add_csv_reivews(Request $request)
	{

		if(auth()->user()->can('create', \App\Models\Review::class)){ 
			$texqw = $request->file('csv_file')->get();		
			//$fullcsv = $this->parse_csv($texqw, ";");  
			//$fullcsv = array_map('str_getcsv', str_getcsv($texqw,"\n"));
			$fullcsv = self::parse_ecsv($texqw, array("delimiter" => ";"));    
			$type_of_s = $request->input('shop');
			
			for ($i=0; $i < count($fullcsv); $i++) {
				$us_id = trim($fullcsv[$i]['user']);
				$rating = trim($fullcsv[$i]['star']);
				$rating_seller_communication_level = trim($fullcsv[$i]['communication_level']);
				$rating_recommend_to_a_friend = trim($fullcsv[$i]['recommend_to_freind']);
				$rating_service_as_described = trim($fullcsv[$i]['service_as_described']);
				$prod = trim($fullcsv[$i]['product']);  
				$tmqwew = trim($fullcsv[$i]['time']); 
				$comm = trim($fullcsv[$i]['comment']);
						
				$prldqw2 = str_replace(array("<p>","</p>"), array("",""), $comm);

				if ($type_of_s == 'yep') $type = "App\Models\Shop";
				if ($type_of_s != 'yep') $type = "App\Models\Inventory";
			
				$fed_id = 1;
				$appr = 1;
				$spam = 0;

				$prqd21sdq = array("0", "1", "2", "3", "4", "5");

				if (!in_array($rating, $prqd21sdq)) {
					return back()->with('message', ' Star must be from 0 to 5');
				} if (!in_array($rating_seller_communication_level, $prqd21sdq) && !in_array($rating_recommend_to_a_friend, $prqd21sdq) && !in_array($rating_service_as_described, $prqd21sdq)) {
					return back()->with('message', ' Rating breakdowns must be valid from 0 to 5');
				} else if (!is_numeric($us_id)) {
					return back()->with('message', ' user id must be a number');
				} else if (strlen($comm)<5) {
					return back()->with('message', ' comment cant be lesser than 5 symbol ');
				} else if (!is_numeric($prod)) {
					return back()->with('message', ' product/shop id must be a number');
				} else if (strlen($tmqwew)<19) {
					return back()->with('message', ' you should pick up time correctly ');
				} else {
					$countp = \DB::table('shops')->where('id', $prod)->count();       
					$countp2 = \DB::table('inventories')->where('product_id', $prod)->count();

					$countu = \DB::table('customers')->where('id', $us_id)->count();

					if ($countp == 0 && $type_of_s == 'yep') { 
						return back()->with('message', ' Shop id doesn\'t exist in our database ! ');
					}else if ($countp2 == 0 && $type_of_s != 'yep') { 
						return back()->with('message', ' Product id has not inventory in our database ! ');
					} else if ($countu == 0) { 
						return back()->with('message', ' user id doesn\'t exist in our database ! ');
					} else {
						if ($type_of_s == 'yep') {
							// record shop feedback
							\DB::insert('insert into feedbacks (customer_id, rating, comment, feedbackable_id, feedbackable_type, approved, spam, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',  [$us_id, $rating, $prldqw2, $prod, $type, $appr, $spam, $tmqwew, $tmqwew]);
						} else {
							// record invenroty feeback
							$arwd12 = \DB::table('inventories')->where('product_id', $prod)->first();

							$feedback = new Feedback;
							$feedback->customer_id = $us_id;
							$feedback->rating = $rating;
							$feedback->comment = $prldqw2;
							$feedback->feedbackable_id = $arwd12->id;
							$feedback->feedbackable_type = $type;
							$feedback->approved = $appr;
							$feedback->spam = $spam;
							$feedback->created_at = $tmqwew;
							$feedback->updated_at = $tmqwew;
							$feedback->save();

							// start added by hassan00942
							$feedback_breakdown = new FeedbackBreakdown;
							$feedback_breakdown->shop_id = $arwd12->shop_id;
							$feedback_breakdown->product_id = $arwd12->product_id;
							$feedback_breakdown->inventory_id = $arwd12->id;
							$feedback_breakdown->feedback_id = $feedback->id;
							$feedback_breakdown->seller_communication_level = $rating_seller_communication_level;
							$feedback_breakdown->recommend_to_a_friend = $rating_recommend_to_a_friend;
							$feedback_breakdown->service_as_described = $rating_service_as_described;
							$feedback_breakdown->created_at = $tmqwew;
							$feedback_breakdown->updated_at = $tmqwew;
							$feedback_breakdown->save();
							// end added by hassan00942
						}
					}
				}
			}
			
			return back()->with('message', 'Reviews has been added!');
			
		} else {
			return redirect('/')->with('message', 'buhaha!');
		}
		
	}
   
    public function addfake()
    {
        if(auth()->user()->can('create', \App\Models\Review::class)){ 
            return view('admin.review.add_fake');
        } else {
           return redirect('/')->with('message', 'buhaha!');
        }
    }       
       
    
	public function add_fake_reivews(Request $request)
	{

		if(auth()->user()->can('create', \App\Models\Review::class)){
			$rating = $request->input('rating');
			$us_id = $request->input('user_id');
			$rating_seller_communication_level = $request->input('communication_level');
			$rating_recommend_to_a_friend = $request->input('recommend_to_freind');
			$rating_service_as_described = $request->input('service_as_described');
			$comm = $request->input('comment');
			$prod = $request->input('product_id');        
			$tmqwew = $request->input('time_set');       
			$prldqw2 = str_replace(array("<p>","</p>"), array("",""), $comm);

			$type_of_s = $request->input('shop');
			
			$id_of_product = 2; // product id
			
			$fed_id = 1;
			
			if ($type_of_s == 'yep') $type = "App\Models\Shop";
			if ($type_of_s != 'yep') $type = "App\Models\Inventory";

			$appr = 1;
			$spam = 0;
			$timer = date("Y-m-d G:i:s");
			$upd =  date("Y-m-d G:i:s");

			$prqd21sdq = array("0", "1", "2", "3", "4", "5");

			if (!in_array($rating, $prqd21sdq)) {
				return back()->with('message', ' Star must be from 0 to 5');
			} if (!in_array($rating_seller_communication_level, $prqd21sdq) && !in_array($rating_recommend_to_a_friend, $prqd21sdq) && !in_array($rating_service_as_described, $prqd21sdq)) {
					return back()->with('message', ' Rating breakdowns must be valid from 0 to 5');
			} else if (!is_numeric($us_id)) {
				return back()->with('message', ' user id must be a number');
			} else if (strlen($comm)<5) {
				return back()->with('message', ' comment cant be lesser than 5 symbol ');
			} else if (!is_numeric($prod)) {
				return back()->with('message', ' product/shop id must be a number');
			} else if (strlen($tmqwew)<19) {
				return back()->with('message', ' you should pick up time correctly ');
			} else {
		   
				$countp = \DB::table('inventories')->where('product_id', $prod)->count();       
	   
				$countu = \DB::table('customers')->where('id', $us_id)->count();       
		
				if ($countp == 0) { 

					return back()->with('message', ' product id doesn\'t exist in our database ! ');

				} else if ($countu == 0) { 

					return back()->with('message', ' user id doesn\'t exist in our database ! ');
		
				} else {       
						
					if ($type_of_s == 'yep') {
						
						\DB::insert('insert into feedbacks (customer_id, rating, comment, feedbackable_id, feedbackable_type, approved, spam, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',  [$us_id, $rating, $prldqw2, $prod, $type, $appr, $spam, $tmqwew, $tmqwew]);

					} else {
						
						$arwd12 = \DB::table('inventories')->where('product_id', $prod)->first();
		   
						//$results = DB::select('select * from users where id = ?', [1]);
						
						//\DB::insert('insert into feedbacks (customer_id, rating, comment, feedbackable_id, feedbackable_type, approved, spam, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',  [$us_id, $rating, $prldqw2, $arwd12->id, $type, $appr, $spam, $tmqwew, $tmqwew]);
						$feedback = new Feedback;
						$feedback->customer_id = $us_id;
						$feedback->rating = $rating;
						$feedback->comment = $prldqw2;
						$feedback->feedbackable_id = $arwd12->id;
						$feedback->feedbackable_type = $type;
						$feedback->approved = $appr;
						$feedback->spam = $spam;
						$feedback->created_at = $tmqwew;
						$feedback->updated_at = $tmqwew;
						$feedback->save();


						// start added by hassan00942
						$feedback_breakdown = new FeedbackBreakdown;
						$feedback_breakdown->shop_id = $arwd12->shop_id;
						$feedback_breakdown->product_id = $arwd12->product_id;
						$feedback_breakdown->inventory_id = $arwd12->id;
						$feedback_breakdown->feedback_id = $feedback->id;
						$feedback_breakdown->seller_communication_level = $rating_seller_communication_level;
						$feedback_breakdown->recommend_to_a_friend = $rating_recommend_to_a_friend;
						$feedback_breakdown->service_as_described = $rating_service_as_described;
						$feedback_breakdown->created_at = $tmqwew;
						$feedback_breakdown->updated_at = $tmqwew;
						$feedback_breakdown->save();
						// end added by hassan00942
					}
					
					return back()->with('message', ' WORKS! ');

				}
			}

		} else {
			return redirect('/')->with('message', 'buhaha!');
		}

	}
}
