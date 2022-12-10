<?php

namespace App\Policies;

use App\Models\AmongMyBrand;
use App\Helpers\Authorize;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AmongMyBrandPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view among_my_brands.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_among_my_brand'))->check();
    }

    /**
     * Determine whether the user can view the AmongMyBrand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AmongMyBrand  $among_my_brand
     * @return mixed
     */
    public function view(User $user, AmongMyBrand $among_my_brand)
    {
        return (new Authorize($user, 'view_among_my_brand', $among_my_brand))->check();
    }

    /**
     * Determine whether the user can create AmongMyBrands.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_among_my_brand'))->check();
    }

    /**
     * Determine whether the user can update the AmongMyBrand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AmongMyBrand  $among_my_brand
     * @return mixed
     */
    public function update(User $user, AmongMyBrand $among_my_brand)
    {
        return (new Authorize($user, 'edit_among_my_brand', $among_my_brand))->check();
    }

    /**
     * Determine whether the user can delete the AmongMyBrand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AmongMyBrand  $among_my_brand
     * @return mixed
     */
    public function delete(User $user, AmongMyBrand $among_my_brand)
    {
        return (new Authorize($user, 'delete_among_my_brand', $among_my_brand))->check();
    }

    /**
     * Determine whether the user can delete the Product.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function massDelete(User $user)
    {
        return (new Authorize($user, 'delete_among_my_brand'))->check();
    }
}
