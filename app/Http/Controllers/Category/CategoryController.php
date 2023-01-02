<?php

declare(strict_types=1);

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * Show form for create Category
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Create/Store Category
     * @param \App\Http\Requests\StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        try {
            /**
             * @var Category|Exception
             */
            $category = CategoryRepository::createCategory($request->validated());
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return redirect()->back()->withErrors(
                ['message' => 'We are sorry, can`t create category write now']
            );
        }

        return redirect(
            route('category.products', [
                $category->slug
            ]),
            201
        );
    }

    /**
     * Show form for update Category
     * @param \App\Models\Category $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category): View
    {
        return view('categories.create', [
            'category' => $category
        ]);
    }

    /**
     * Update Category
     * @param \App\Http\Requests\StoreCategoryRequest $request Validate data
     * @param \App\Models\Category $category Category for update
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreCategoryRequest $request, Category $category): RedirectResponse
    {
        try {
            $category = CategoryRepository::updateCategory(
                $request->validated(),
                $category
            );
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return redirect()->back()->withErrors(
                ['message' => 'We are sorry, can`t update category write now']
            );
        }

        return redirect(
            route('category.products', [
                $category->slug
            ]),
            201
        );
    }

    /**
     * Delete Category
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        try {
            CategoryRepository::destroyCategory($category);
        } catch (\Throwable $th) {
            Log::info($th->getMessage());

            return redirect()->back()->withErrors(
                ['message' => 'Cant`t delete this category now']
            );
        }

        return redirect(
            '/'
        );
    }

    /**
     * Show Category Products
     * @param \App\Models\Category $category
     * @return \Illuminate\View\View
     */
    public function showProducts(Category $category): View
    {
        return view('categories.category', [
            'category' => $category,
            'products' => CategoryRepository::getCategoryProducts($category)->paginate(15)
        ]);
    }
}
