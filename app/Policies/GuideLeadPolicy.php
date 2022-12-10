<?php

namespace App\Policies;

use App\Helpers\Authorize;
use App\Models\GuideLead;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuideLeadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view GuideLeads.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GuideLead  $guide_lead
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_page'))->check();
    }

    /**
     * Determine whether the user can view the GuideLead.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GuideLead  $guide_lead
     * @return mixed
     */
    public function view(User $user, GuideLead $guide_lead)
    {
        return (new Authorize($user, 'view_page', $guide_lead))->check();
    }

    /**
     * Determine whether the user can create GuideLeads.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_page'))->check();
    }

    /**
     * Determine whether the user can update the GuideLead.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GuideLead  $guide_lead
     * @return mixed
     */
    public function update(User $user, GuideLead $guide_lead)
    {
        return (new Authorize($user, 'edit_page', $guide_lead))->check();
    }

    /**
     * Determine whether the user can delete the GuideLead.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GuideLead  $guide_lead
     * @return mixed
     */
    public function delete(User $user, GuideLead $guide_lead)
    {
        return (new Authorize($user, 'delete_page', $guide_lead))->check();
    }

    /**
     * Determine whether the user can delete the Product.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function massDelete(User $user)
    {
        return (new Authorize($user, 'delete_page'))->check();
    }
}
