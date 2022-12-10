<?php

namespace App\Http\Controllers\Admin;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateGuideLeadRequest;
use App\Http\Requests\Validations\UpdateGuideLeadRequest;
use App\Models\GuideLead;
use App\Repositories\GuideLead\GuideLeadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DB;
use Str;
use File;

class GuideLeadController extends Controller
{
    // use Authorizable;

    private $model;

    private $guide_lead;

    /**
     * construct
     */
    public function __construct(GuideLeadRepository $guide_lead)
    {
        parent::__construct();
        $this->model = trans('app.model.guide_lead');
        $this->guide_lead = $guide_lead;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 1;
        $guide_leads = $this->guide_lead->all();

        // $trashes = $this->guide_lead->trashOnly();

        return view('admin.guide_leads.index', compact('guide_leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guide_leads._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGuideLeadRequest $request)
    {
        // $fileTemp = $request->file('link_file');
        // if($fileTemp->isValid()){
        //     $fileExtension = $fileTemp->getClientOriginalExtension();
        //     $fileName = Str::random(4). '.'. $fileExtension;
        //     $path = $fileTemp->storeAs(
        //         'image/documents/guide-leads', $fileName
        //     );

        //     $request->merge([
        //         'link' => url($path),
        //     ]);
        // }
        
        $this->guide_lead->store($request);

        Cache::forget('cached_guide_leads');
        Cache::forget('cached_guide_lead_feature');

        return back()->with('success', trans('messages.created', ['model' => $this->model]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GuideLead  $guide_lead
     * @return \Illuminate\Http\Response
     */
    public function edit(GuideLead $guide_lead)
    {
        return view('admin.guide_leads._edit', compact('guide_lead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGuideLeadRequest $request, $id)
    {

        // $fileTemp = $request->file('link_file');
        // if($fileTemp && $fileTemp->isValid()){

        //     // for deleting the previous one
        //     $record = $this->guide_lead->find($id);
        
        //     if(!$record){
        //         return back()->with('error', 'not found');
        //     }
    
        //     $is_file_exist = str_replace(url('/').'/','',$record->link);
            
        //     if ($record->type == 'pdf' && File::exists(storage_path('app/public/'.$is_file_exist))) {
        //         File::delete(File::exists(storage_path('app/public/'.$is_file_exist)));
        //     }
    
    
        //     $fileExtension = $fileTemp->getClientOriginalExtension();
        //     $fileName = str_replace(' ','-', $request->title). '.'. $fileExtension;
        //     $path = $fileTemp->storeAs(
        //         'documents/guide-leads', $fileName
        //     );

        //     $request->merge([
        //         'link' => 'documents/guide-leads/'.$fileName,
        //     ]);
        // }
        
        DB::beginTransaction();
        try {
            if($request->is_featured == "1"){
                $req = new Request;
                $req->merge(['is_featured' => 0]);

                foreach($this->guide_lead->all() as $s){
                    if($s->is_featured == 1){
                        $this->guide_lead->update($req, $s->id);
                    }
                }
                Cache::forget('cached_guide_lead_feature');
            }

            
            $this->guide_lead->update($request, $id);

            // return $this->guide_lead;
            Cache::forget('cached_guide_leads');
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
        return back()->with('success', trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function trash(Request $request, $id)
    // {
    //     $this->guide_lead->trash($id);

    //     Cache::forget('cached_guide_leads');
    //     Cache::forget('cached_guide_lead_feature');
        
    //     return back()->with('success', trans('messages.trashed', ['model' => $this->model]));
    // }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function restore(Request $request, $id)
    // {
    //     $this->guide_lead->restore($id);

    //     Cache::forget('cached_guide_leads');

    //     return back()->with('success', trans('messages.restored', ['model' => $this->model]));
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->guide_lead->destroy($id);

        Cache::forget('cached_guide_leads');
        Cache::forget('cached_guide_lead_feature');

        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function massTrash(Request $request)
    // {
    //     $this->guide_lead->massTrash($request->ids);

    //     Cache::forget('cached_guide_leads');

    //     if ($request->ajax()) {
    //         return response()->json(['success' => trans('messages.trashed', ['model' => $this->model])]);
    //     }

    //     return back()->with('success', trans('messages.trashed', ['model' => $this->model]));
    // }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function massRestore(Request $request)
    // {
    //     $this->guide_lead->massRestore($request->ids);

    //     Cache::forget('cached_guide_leads');

    //     if ($request->ajax()) {
    //         return response()->json(['success' => trans('messages.restored', ['model' => $this->model])]);
    //     }

    //     return back()->with('success', trans('messages.restored', ['model' => $this->model]));
    // }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        $this->guide_lead->massDestroy($request->ids);

        Cache::forget('cached_guide_leads');
        Cache::forget('cached_guide_lead_feature');

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
    // public function emptyTrash(Request $request)
    // {
    //     $this->guide_lead->emptyTrash($request);

    //     Cache::forget('cached_guide_leads');

    //     if ($request->ajax()) {
    //         return response()->json(['success' => trans('messages.deleted', ['model' => $this->model])]);
    //     }

    //     return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    // }
}
