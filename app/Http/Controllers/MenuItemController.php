<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Http\Controllers\AbstractBaseController;
use App\Http\Requests\MenuItemRequest;

class MenuItemController extends AbstractBaseController
{   
    public function index()
    {
        $menuItems = MenuItem::orderBy('order')->get();
        return view('menuItem.index', compact('menuItems'));
    }

    public function create()
    {

        return view('menuItem.create');
    }

    public function store(MenuItemRequest $request)
    {
        
        $menuItem = new MenuItem();
        
        $request->merge([
            'menuItem' => $menuItem,
        ]);
        
        $menuItem->title = $request->input('title');
        $menuItem->url = $request->input('url');
        $menuItem->order = $request->input('order');
        $menuItem->save();

        return redirect()->route('menuItem.index')->with('success', 'Menu item created successfully.');
    }

    public function show(MenuItem $menuItem)
    {
        return view('menuItem.show', compact('menuItem'));
    }

    public function edit(MenuItem $menuItem)
    {
        return view('menuItem.edit', compact('menuItem'));
    }

    public function update(MenuItemRequest $request, MenuItem $menuItem)
    {

        $request->merge([
            'menuItem' => $menuItem,
        ]);

        $menuItem->title = $request->input('title');
        $menuItem->url = $request->input('url');
        $menuItem->order = $request->input('order');
        $menuItem->save();

        return redirect()->route('menuItem.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return redirect()->route('menuItem.index')->with('success', 'Menu item deleted successfully.');
    }
}
