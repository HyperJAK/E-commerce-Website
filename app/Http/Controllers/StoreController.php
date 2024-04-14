<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with(['owner', 'getCategories'])->get();
        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        return view('stores.create');
    }

    public function store(Request $request)
    {
        Store::create($request->all());
        return redirect()->route('stores.index');
    }

    public function show(Store $store)
    {
        return view('stores.show', compact('store'));
    }

    public function edit(Store $store)
    {
        return view('stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
        $store->update($request->all());
        return redirect()->route('stores.index');
    }

    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->route('stores.index');
    }
}
