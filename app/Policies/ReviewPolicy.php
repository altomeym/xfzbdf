<?php

namespace App\Policies;

use App\Helpers\Authorize;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view Reviews.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_review'))->check();
    }

    /**
     * Determine whether the user can view the Review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return mixed
     */
    public function view(User $user, Review $review)
    {
        return (new Authorize($user, 'view_review', $review))->check();
    }

    /**
     * Determine whether the user can create Reviews.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_review'))->check();
    }

    /**
     * Determine whether the user can update the Review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return mixed
     */
    public function update(User $user, Review $review)
    {
        return (new Authorize($user, 'edit_review', $review))->check();
    }

    /**
     * Determine whether the user can delete the Review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return mixed
     */
    public function delete(User $user, Review $review)
    {
        return (new Authorize($user, 'delete_review', $review))->check();
    }

    /**
     * Determine whether the user can delete the Product.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function massDelete(User $user)
    {
        return (new Authorize($user, 'delete_review'))->check();
    }
}
