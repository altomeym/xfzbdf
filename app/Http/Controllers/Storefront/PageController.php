<?php

namespace App\Http\Controllers\Storefront;
use App\Http\Controllers\Controller;
use App\Models\TeamPageSetting;
use App\Models\TeamMember;
use Cache;

class PageController extends Controller
{
    public function team_page()
    {

        $team = Cache::rememberForever('cached_team_page_settings', function () {
            return TeamPageSetting::first();
        });

        $team_members = Cache::rememberForever('cached_team_members', function () {
            return TeamMember::orderByRaw('ISNULL(position), position ASC')->get();
        });

        return view('theme::team', compact('team', 'team_members'));
    }
}