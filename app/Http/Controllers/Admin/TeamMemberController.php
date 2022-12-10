<?php

namespace App\Http\Controllers\Admin;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateTeamMemberRequest;
use App\Http\Requests\Validations\UpdateTeamMemberRequest;
use App\Models\TeamMember;
use App\Repositories\TeamMember\TeamMemberRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TeamMemberController extends Controller
{
    // use Authorizable;

    private $model;

    private $team_member;

    /**
     * construct
     */
    public function __construct(TeamMemberRepository $team_member)
    {
        parent::__construct();
        $this->model = trans('app.model.team_member');
        $this->team_member = $team_member;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_members = $this->team_member->all();

        $trashes = $this->team_member->trashOnly();

        return view('admin.team_member.index', compact('team_members', 'trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team_member._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTeamMemberRequest $request)
    {
        $social_links = [
            'facebook' => $request->facebook_profile,
            'twitter' => $request->twitter_profile,
            'skype' => $request->skype_profile,
        ];

        $request->merge([
            'social_links' => $social_links
        ]);
        
        $this->team_member->store($request);

        Cache::forget('cached_team_members');

        return back()->with('success', trans('messages.created', ['model' => $this->model]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamMember  $team_member
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $team_member)
    {
        return view('admin.team_member._edit', compact('team_member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamMemberRequest $request, $id)
    {
        $social_links = [
            'facebook' => $request->facebook_profile,
            'twitter' => $request->twitter_profile,
            'skype' => $request->skype_profile,
        ];

        $request->merge([
            'social_links' => $social_links
        ]);
        
        $this->team_member->update($request, $id);

        Cache::forget('cached_team_members');

        return back()->with('success', trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $this->team_member->trash($id);

        Cache::forget('cached_team_members');

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
        $this->team_member->restore($id);

        Cache::forget('cached_team_members');

        return back()->with('success', trans('messages.restored', ['model' => $this->model]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->team_member->destroy($id);

        Cache::forget('cached_team_members');

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
        $this->team_member->massTrash($request->ids);

        Cache::forget('cached_team_members');

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
        $this->team_member->massRestore($request->ids);

        Cache::forget('cached_team_members');

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
        $this->team_member->massDestroy($request->ids);

        Cache::forget('cached_team_members');

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
        $this->team_member->emptyTrash($request);

        Cache::forget('cached_team_members');

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model])]);
        }

        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }
}
