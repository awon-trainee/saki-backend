<?php

namespace App\Policies;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Beneficiaries;


class CategoryPolicy extends Controller
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Beneficiaries $beneficiaries): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Beneficiaries $beneficiaries, Category $category): bool
    {
        if($beneficiaries->categories()->where('category_id' , $category->id)->exists()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Beneficiaries $beneficiaries): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Beneficiaries $beneficiaries, Category $category): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Beneficiaries $beneficiaries, Category $category): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Beneficiaries $beneficiaries, Category $category): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Beneficiaries $beneficiaries, Category $category): bool
    {
        //
    }
}
