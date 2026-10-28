<?php
namespace App\Http\Controllers;

use App\Models\MembershipCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = MembershipCategory::latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100|unique:membership_categories,name',
            'description' => 'nullable',
        ]);
        MembershipCategory::create($data);
        return redirect()->route('categories.index')->with('success', 'Category added.');
    }

    public function edit(MembershipCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, MembershipCategory $category)
    {
        $data = $request->validate([
            'name' => 'required|max:100|unique:membership_categories,name,' . $category->id,
            'description' => 'nullable',
        ]);
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    public function destroy(MembershipCategory $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }
}