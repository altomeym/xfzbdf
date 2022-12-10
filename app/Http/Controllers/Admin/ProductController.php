<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateProductRequest;
use App\Http\Requests\Validations\UpdateProductRequest;
use App\Http\Requests\Validations\UpdateProductGallery;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Models\ProductFaq;
use App\Models\ProductQuestion;

class ProductController extends Controller
{

    // use Authorizable;
    // fiverLikeAddingProduct00942 // need to understand logic

    private $model;

    private $product;

    /**
     * construct
     */
    public function __construct(ProductRepository $product)
    {
        parent::__construct();

        $this->model = trans('app.model.product');

        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trashes = $this->product->trashOnly();

        return view('admin.product.index', compact('trashes'));
    }

    // function will process the ajax request
    public function getProducts(Request $request)
    {
        // $products = Product::select('*');
        $products = Product::with('categories', 'shop.logo', 'featureImage', 'image')
            ->withCount('inventories');

        // When accessing by a merchent user
        if (Auth::user()->isFromMerchant()) {
            $products->mine();
        }

        return Datatables::of($products)
            ->editColumn('checkbox', function ($product) {
                return view('admin.partials.actions.product.checkbox', compact('product'));
            })
            ->addColumn('option', function ($product) {
                return view('admin.partials.actions.product.options', compact('product'));
            })
            ->editColumn('image', function ($product) {
                return view('admin.partials.actions.product.image', compact('product'));
            })
            ->editColumn('name', function ($product) {
                return view('admin.partials.actions.product.name', compact('product'));
            })
            ->editColumn('gtin', function ($product) {
                return view('admin.partials.actions.product.gtin', compact('product'));
            })
            ->editColumn('category', function ($product) {
                return view('admin.partials.actions.product.category', compact('product'));
            })
            ->editColumn('inventories_count', function ($product) {
                return view('admin.partials.actions.product.inventories_count', compact('product'));
            })
            ->editColumn('added_by', function ($product) {
                return view('admin.partials.actions.product.added_by', compact('product'));
            })
            ->rawColumns(['image', 'name', 'gtin', 'category', 'inventories_count', 'added_by', 'status', 'checkbox', 'option'])
            ->make(true);
    }

    // function will process the ajax request
    public function getProductsList(Request $request)
    {
        // $products = Product::select('*');
        $products = Product::with('inventory')->with('image');

        // When accessing by a merchent user
        if (Auth::user()->isFromMerchant()) {
            $products->mine();
        }

        return Datatables::of($products)
            // ->editColumn('checkbox', function ($product) {
            //     return view('admin.partials.actions.product.checkbox', compact('product'));
            // })
            // ->addColumn('option', function ($product) {
            //     return view('admin.partials.actions.product.options', compact('product'));
            // })
            ->editColumn('image', function ($product) {
                return '<img src="'.get_storage_file_url(optional($product->image)->path, null).'" width="100%" height="100%" alt="'.trans('app.image') .'">';
                // return view('admin.partials.actions.product.image', compact('product'));
            })
            ->editColumn('name', function ($product) {
                return view('admin.partials.actions.product.name', compact('product'));
            })
            // ->editColumn('gtin', function ($product) {
            //     return view('admin.partials.actions.product.gtin', compact('product'));
            // })
            // ->editColumn('category', function ($product) {
            //     return view('admin.partials.actions.product.category', compact('product'));
            // })
            // ->editColumn('inventories_count', function ($product) {
            //     return view('admin.partials.actions.product.inventories_count', compact('product'));
            // })
            // ->editColumn('added_by', function ($product) {
            //     return view('admin.partials.actions.product.added_by', compact('product'));
            // })
            // ->rawColumns(['image', 'name', 'gtin', 'category', 'inventories_count', 'added_by', 'status', 'checkbox', 'option'])
            ->rawColumns(['image', 'name'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $this->authorize('create', Product::class); // Check permission

        $product = $this->product->store($request);

        $request->session()->flash('success', trans('messages.created', ['model' => $this->model]));

        return response()->json($this->getJsonParams($product));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);

        $this->authorize('view', $product); // Check permission

        return view('admin.product._show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id);

        $this->authorize('update', $product); // Check permission

        $preview = $product->previewImages();

        return view('admin.product.edit', compact('product', 'preview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        // return 1;
        $product = $this->product->update($request, $id);

        $this->authorize('update', $product); // Check permission

        $request->session()->flash('success', trans('messages.updated', ['model' => $this->model]));

        return response()->json($this->getJsonParams($product));
    }

    /**
     * update product descripiton & faqs
     *
     */
    public function update_description_faqs(Request $request)
    {
        // create custom request ?

        // permssion ?
        // $this->authorize('update', Product::class); // Check permission

        // update description
        $product = $this->product->update_description($request);

        // update/add faqs questions
        $new_faqs_ids = null;
        if(is_array($request->faq)){
            $new_faqs_ids = array_keys($request->faq);
        }

        if($new_faqs_ids){
            // delete removed faqs
            ProductFaq::where('product_id', $request->id)->whereId('id', $new_faqs_ids)->delete();
            
            // add + update faqs
            foreach($request->faq as $index => $faq){
                $f = ProductFaq::find($index);
                if(!$f){
                    $f = ProductFaq::where('product_id', $request->id)->where('question', @$faq['question'])->first();
                }

                if(!$f){
                    $f = new ProductFaq;
                }
                $f->product_id = $request->id;
                $f->question = @$faq['question'];
                $f->answer = @$faq['answer'];
                $f->save();
            }    
        }

        return $request->all();

        // return ajax response

    }

    /**
     * update product requirements
     *
     */
    public function update_requirements(Request $request)
    {
        // return $request->all();
        // create custom request
        
        // permssion ?
        // $this->authorize('update', Product::class); // Check permission

        // update/add questions
        $new_questions_ids = null;
        if(is_array($request->question)){
            $new_questions_ids = array_keys($request->question);
        }

        if($new_questions_ids){
            // delete removed questions
            ProductQuestion::where('product_id', $request->id)->whereId('id', $new_questions_ids)->delete();
            
            // add + update questions
            foreach($request->question as $index => $question){
                $f = ProductQuestion::find($index);
                if(!$f){
                    $f = ProductQuestion::where('product_id', $request->id)->where('question', @$question['question'])->first();
                }

                if(!$f){
                    $f = new ProductQuestion;
                }
                $f->product_id = $request->id;
                $f->is_required = @$question['required'] == "on" ? 1 : 0;
                $f->question = @$question['question'];
                $f->type = @$question['type'];
                $f->save();
            }    
        }

        // return ajax response
        return $request->all();
    }

    /**
     * update product gallery
     *
     */
    public function update_gallery(UpdateProductGallery $request)
    {
        // $request->validate([
        //     'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        // return $request->abc->move(public_path('images'), 'asd.jpg');

        // return $request->images[0];
        // create custom request

        // permssion ?
        // $this->authorize('update', Product::class); // Check permission
        
        return $product = $this->product->update_gallery($request);

        // permssion

        // return response ajax
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $this->product->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model]));
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
        $this->product->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model]));
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
        $this->product->destroy($id);

        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        $this->product->massTrash($request->ids);

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.trashed', ['model' => $this->model])]);
        }

        return back()->with('success', trans('messages.trashed', ['model' => $this->model]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massRestore(Request $request)
    {
        $this->product->massRestore($request->ids);

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.restored', ['model' => $this->model])]);
        }

        return back()->with('success', trans('messages.restored', ['model' => $this->model]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        $this->product->massDestroy($request->ids);

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model])]);
        }

        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * Empty the Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emptyTrash(Request $request)
    {
        $this->product->emptyTrash($request);

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model])]);
        }

        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * return json params to procceed the form
     *
     * @param  Product $product
     *
     * @return array
     */
    private function getJsonParams($product)
    {
        return [
            'id' => $product->id,
            'model' => 'product',
            'redirect' => route('admin.catalog.product.index'),
        ];
    }
}
