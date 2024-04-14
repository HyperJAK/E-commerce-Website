<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|boolean',
            'user_id' => 'required|exists:users,id'
        ]);

        $store = Store::create($validated);
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
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'boolean',
            'user_id' => 'exists:users,id'
        ]);

        $store = Store::find($id);
        $store->update($validated);
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
