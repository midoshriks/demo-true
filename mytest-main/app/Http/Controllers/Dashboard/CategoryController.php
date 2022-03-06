<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Exports\CategoryExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoryImport;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->orderBy('id', 'ASC')->latest()->paginate(5);

        return view('dashboard.categories.index', compact('categories'));

    }//end of index

    public function create()
    {
        return view('dashboard.categories.create');

    }//end of create

    public function store(Request $request)
    {
        // $rules = [];

        // foreach (config('translatable.locales') as $locale) {

        //     $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];

        // }//end of for each

        // $request->validate($rules);

        Category::create($request->all());
        // dd($request->all());


        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');

    }//end of store

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));

    }//end of edit

    public function update(Request $request, Category $category)
    {
        // $rules = [];

        // foreach (config('translatable.locales') as $locale) {

        //     $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];

        // }//end of for each

        // $request->validate($rules);

        $category->update($request->all());
        // dd($category);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.categories.index');

    }//end of update

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');

    }//end of destroy

    public function export()
    {
        return Excel::download(new categoryExport, 'category.xlsx');
    }

    public function importexcel(Request $request){
        $data = $request->file('file');

        $namefile = $data->getClientOriginalName();
        $data->move('cat', $namefile);

        Excel::import(new CategoryImport, \public_path('/cat/'.$namefile));
        return redirect()->back()->with('success', 'Data has been Insert SuccessFully');

    }


}//end of controller
