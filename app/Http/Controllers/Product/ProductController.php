<?php

namespace App\Http\Controllers\Product;

use App\Events\ProductCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ConditionRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\HttpCache\StoreInterface;

class ProductController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create(): View
    {
        return view('products.create', [
            'categories' => CategoryRepository::getAllCategories(),
            'conditions' => ConditionRepository::getAllConditions()
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        /**
         * @var Product created product
         */
        $product = Product::create(
            Arr::only($request->validated(), app(Product::class)->getFillable())
        );

        if (array_key_exists('categories', $request->validated())) {
            $product->categories()->attach(
                $request->validated('categories')
            );
        }

        ProductCreated::dispatch($product);
        
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
        dd(
            __METHOD__,
            $product
        );
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
