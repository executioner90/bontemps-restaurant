<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Support\Global\Breadcrumbs;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    protected Breadcrumbs $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = (new Breadcrumbs())
            ->add(Lang::get('Product'), URL::route('admin.product.index'));
    }

    public function index(): Renderable
    {
        return View::make('admin.products.index')->with([
            'products' => Product::all(),
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    public function create(): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Create'), URL::route('admin.product.create'));

        return View::make('admin.products.form')->with([
            'breadcrumbs' => $this->breadcrumbs,
            'title' => Lang::get('Create product'),
            'method' => 'POST',
            'action' => URL::route('admin.product.store'),
            'backRoute' => URL::route('admin.product.index'),
            'submitButton' => Lang::get('Create'),
        ]);
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        Product::query()->create($request->validated());

        return Redirect::route('admin.product.index')->with([
            'success' => 'Product created successfully'
        ]);
    }

    public function edit(Product $product): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Edit'), URL::route('admin.product.edit', ['product' => $product->id]));

        return View::make('admin.products.form')->with([
            'product' => $product,
            'breadcrumbs' => $this->breadcrumbs,
            'title' => Lang::get('Update product'),
            'method' => 'PUT',
            'action' => URL::route('admin.product.update', ['product' => $product->id]),
            'backRoute' => URL::route('admin.product.index'),
            'submitButton' => Lang::get('Update'),
        ]);
    }

    public function update(ProductStoreRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return Redirect::route('admin.product.index')->with([
            'success' => 'Product updated successfully'
        ]);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return Redirect::route('admin.product.index')->with([
            'success' => 'Product deleted successfully'
        ]);
    }
}
