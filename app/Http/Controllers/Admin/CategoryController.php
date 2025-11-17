<?php 
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $keyword = $request->search;
            $query->where('name', 'like', "%$keyword%");
        }

        $categories = $query->paginate(10)->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'nullable'
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Category berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'nullable'
        ]);

        $category = Category::findOrFail($id);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Category berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category berhasil dihapus!');
    }
}
