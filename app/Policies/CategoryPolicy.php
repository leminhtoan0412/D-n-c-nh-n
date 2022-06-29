<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Account $account)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Account $account, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Account $account)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Account $account, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Account $account, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Account $account, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Account $account, Category $category)
    {
        //
    }
}
