<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ConditionRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Show for for create product
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('products.create', [
            'categories' => CategoryRepository::getAllCategories(),
            'conditions' => ConditionRepository::getAllConditions()
        ]);
    }

    /**
     * Create/Store Product
     * @param \App\Http\Requests\StoreProductRequest $request Validate data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        try {
            $product = ProductRepository::createProduct($request->validated());
        } catch (\Throwable $th) {
            Log::info($th->getMessage());

            return redirect()->back()->withErrors(
                ['message' => 'Sorry can`t create this product now']
            );
        }

        return redirect(
            route('product.show', [$product->id]),
            201
        );
    }

    /**
     * Show specific Product
     * @param \App\Models\Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product): View
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.create', [
            'product' => $product,
            'categories' => CategoryRepository::getAllCategories(),
            'conditions' => ConditionRepository::getAllConditions()
        ]);
    }

    /**
     * Update Category
     * @param \App\Http\Requests\StoreProductRequest $request Validate data
     * @param \App\Models\Product $product Product for update
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreProductRequest $request, Product $product): RedirectResponse
    {

        try {
            $product = ProductRepository::updateProduct($product, $request->validated());
        } catch (\Throwable $th) {
            Log::info($th->getMessage());

            return redirect()->back()->withErrors(
                ['message' => 'Sorry can`t update this product now']
            );
        }

        return redirect(
            route('product.show', [$product->id]),
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            ProductRepository::destroyProduct($product);
        } catch (\Throwable $th) {
            Log::info($th->getMessage());

            return redirect()->back()->withErrors(
                ['message' => 'Cant`t delete this product now']
            );
        }

        return redirect(
            '/'
        );
    }
}
