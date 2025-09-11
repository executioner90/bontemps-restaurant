<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableStoreRequest;
use App\Models\Table;
use App\Support\Global\Breadcrumbs;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class TableController extends Controller
{
    protected Breadcrumbs $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = (new Breadcrumbs())
            ->add(Lang::get('Table'), URL::route('admin.table.index'));
    }

    public function index(): Renderable
    {
        return View::make('admin.tables.index')->with([
            'tables' => Table::all(),
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    public function create(): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Create'), URL::route('admin.table.create'));

        return View::make('admin.tables.form')->with([
            'breadcrumbs' => $this->breadcrumbs,
            'title' => Lang::get('Create table'),
            'method' => 'POST',
            'action' => URL::route('admin.table.store'),
            'backRoute' => URL::route('admin.table.index'),
            'submitButton' => Lang::get('Create'),
        ]);
    }

    public function store(TableStoreRequest $request): RedirectResponse
    {
        Table::query()->create($request->validated());

        return Redirect::route('admin.table.index')->with([
            'success' => 'Table created successfully'
        ]);
    }

    public function edit(Table $table): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Edit'), URL::route('admin.table.edit', ['table' => $table->id]));

        return View::make('admin.tables.form')->with([
            'table' => $table,
            'breadcrumbs' => $this->breadcrumbs,
            'title' => Lang::get('Edit table'),
            'method' => 'PUT',
            'action' => URL::route('admin.table.update', ['table' => $table->id]),
            'backRoute' => URL::route('admin.table.index'),
            'submitButton' => Lang::get('Edit'),
        ]);
    }

    public function update(TableStoreRequest $request, Table $table): RedirectResponse
    {
        $table->update($request->validated());

        return Redirect::route('admin.table.index')->with([
            'success' => 'Table updated successfully'
        ]);
    }

    public function destroy(Table $table): RedirectResponse
    {
        $table->delete();

        return Redirect::route('admin.table.index')->with([
            'success' => 'Table deleted successfully'
        ]);
    }
}
