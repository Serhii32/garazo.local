<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductsAttributesName;
use App\ProductsAttributesValue;
use App\Http\Requests\StoreAttributeNameRequest;

class AttributesController extends Controller
{
    public function index()
    {
        $attributesNames = ProductsAttributesName::all();
        $pageTitle = 'Характеристики товаров';
        return view('admin.attributes.attributes-index', compact(['attributesNames', 'pageTitle']));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit(int $id)
    {
        $attributesName = ProductsAttributesName::findOrFail($id);
        $pageTitle = $attributesName->name;
        return view('admin.attributes.attributes-edit', compact(['attributesName', 'pageTitle']));
    }

    public function update(StoreAttributeNameRequest $request, int $id)
    {
        $attributesName = ProductsAttributesName::findOrFail($id);
        $attributesName->name = $request->name;
        $attributesName->save();
        return redirect()->route('admin.attributes.index')->with(['message' => 'Характеристика успешно обновлена']);
    }

    public function destroy(int $id)
    {
        $attributesName = ProductsAttributesName::findOrFail($id);
        $attributesName->values()->detach();
        $attributesName->products()->detach();
        $attributesName->delete();
        return redirect()->route('admin.attributes.index')->with(['message' => 'Характеристика успешно удалена']);
    }
}
