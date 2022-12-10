<?php

namespace App\Policies;

use App\Helpers\Authorize;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamMemberPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view TeamMembers.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamMember  $team_member
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_team_member'))->check();
    }

    /**
     * Determine whether the user can view the TeamMember.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamMember  $team_member
     * @return mixed
     */
    public function view(User $user, TeamMember $team_member)
    {
        return (new Authorize($user, 'view_team_member', $team_member))->check();
    }

    /**
     * Determine whether the user can create TeamMembers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_team_member'))->check();
    }

    /**
     * Determine whether the user can update the TeamMember.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamMember  $team_member
     * @return mixed
     */
    public function update(User $user, TeamMember $team_member)
    {
        return (new Authorize($user, 'edit_team_member', $team_member))->check();
    }

    /**
     * Determine whether the user can delete the TeamMember.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamMember  $team_member
     * @return mixed
     */
    public function delete(User $user, TeamMember $team_member)
    {
        return (new Authorize($user, 'delete_team_member', $team_member))->check();
    }

    /**
     * Determine whether the user can delete the Product.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function massDelete(User $user)
    {
        return (new Authorize($user, 'delete_team_member'))->check();
    }
}
