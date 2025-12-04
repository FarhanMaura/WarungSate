<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = \App\Models\Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        \App\Models\Menu::create($input);

        return redirect()->route('menus.index')
                        ->with('success','Menu created successfully.');
    }

    public function show(\App\Models\Menu $menu)
    {
        return view('admin.menus.show',compact('menu'));
    }

    public function edit(\App\Models\Menu $menu)
    {
        return view('admin.menus.edit',compact('menu'));
    }

    public function update(Request $request, \App\Models\Menu $menu)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $menu->update($input);

        return redirect()->route('menus.index')
                        ->with('success','Menu updated successfully');
    }

    public function destroy(\App\Models\Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')
                        ->with('success','Menu deleted successfully');
    }
}
