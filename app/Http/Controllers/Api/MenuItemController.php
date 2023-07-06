<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuItem;
use App\Http\Controllers\AbstractBaseController;
use App\Http\Requests\MenuItemRequest;
use Illuminate\Http\JsonResponse;

class MenuItemController extends AbstractBaseController
{
    public function index()
    {
        $menuItems = MenuItem::orderBy('order')->get();
        return response()->json(compact('menuItems'));
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(MenuItemRequest $request)
    {
        $menuItem = new MenuItem();
        $menuItem->title = $request->input('title');
        $menuItem->url = $request->input('url');
        $menuItem->order = $request->input('order');
        $menuItem->save();

        return response()->json(['message' => 'Menu item created successfully']);
    }

    public function show(MenuItem $menuItem)
    {
        return response()->json(compact('menuItem'));
    }

    public function edit(MenuItem $menuItem)
    {
        return response()->json(compact('menuItem'));
    }

    public function update(MenuItemRequest $request, MenuItem $menuItem)
    {
        $menuItem->title = $request->input('title');
        $menuItem->url = $request->input('url');
        $menuItem->order = $request->input('order');
        $menuItem->save();

        return response()->json(['message' => 'Menu item updated successfully']);
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return response()->json(['message' => 'Menu item deleted successfully']);
    }
}
