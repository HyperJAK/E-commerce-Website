<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // Display a list of all stores
    public function index()
    {
        $stores = Store::all();
        return view('stores.index', compact('stores'));
    }

    // Show the form for creating a new store
    public function create()
    {
        return view('stores.create');
    }

    // Store a newly created store in the database
    public function store(Request $request)
    {
        $store = Store::create($request->all());
        return redirect()->route('stores.index');
    }

    // Display the specified store
    public function show($id)
    {
        $store = Store::find($id);
        return view('stores.show', compact('store'));
    }

    // Show the form for editing the specified store
    public function edit($id)
    {
        $store = Store::find($id);
        return view('stores.edit', compact('store'));
    }

    // Update the specified store in the database
    public function update(Request $request, $id)
    {
        $store = Store::find($id);
        $store->update($request->all());
        return redirect()->route('stores.index');
    }

    // Remove the specified store from the database
    public function destroy($id)
    {
        $store = Store::find($id);
        $store->delete();
        return redirect()->route('stores.index');
    }
}
