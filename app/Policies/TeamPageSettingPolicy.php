<?php

namespace App\Policies;

use App\Helpers\Authorize;
use App\Models\TeamPageSetting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPageSettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view TeamPageSettings.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamPageSetting  $team_page_setting
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_team_page_setting'))->check();
    }

    /**
     * Determine whether the user can view the TeamPageSetting.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamPageSetting  $team_page_setting
     * @return mixed
     */
    public function view(User $user, TeamPageSetting $team_page_setting)
    {
        return (new Authorize($user, 'view_team_page_setting', $team_page_setting))->check();
    }

    /**
     * Determine whether the user can create TeamPageSettings.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_team_page_setting'))->check();
    }

    /**
     * Determine whether the user can update the TeamPageSetting.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamPageSetting  $team_page_setting
     * @return mixed
     */
    public function update(User $user, TeamPageSetting $team_page_setting)
    {
        return (new Authorize($user, 'edit_team_page_setting', $team_page_setting))->check();
    }

    /**
     * Determine whether the user can delete the TeamPageSetting.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamPageSetting  $team_page_setting
     * @return mixed
     */
    public function delete(User $user, TeamPageSetting $team_page_setting)
    {
        return (new Authorize($user, 'delete_team_page_setting', $team_page_setting))->check();
    }

    /**
     * Determine whether the user can delete the Product.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function massDelete(User $user)
    {
        return (new Authorize($user, 'delete_team_page_setting'))->check();
    }
}
