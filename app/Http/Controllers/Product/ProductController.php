<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ConditionRepository;
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

        return redirect(
            route('product.show', [$product->id]),
            201
        );
    }

    /**
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        dd($product);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
