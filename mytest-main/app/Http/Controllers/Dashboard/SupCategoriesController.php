<?php

namespace App\Http\Controllers\Dashboard;

// use App\SupCategories;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

use App\Category;
use App\Exports\SupCatexport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SupCatImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SupCategories;

class SupCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $supcategories = SupCategories::orderBy('id', 'ASC')->get();

        $supcategories = SupCategories::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->orderBy('id', 'ASC')->latest()->paginate(5);

        // $supcategoriesT = SupCategories::all();
        return view('dashboard.supcategories.index', compact('supcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('dashboard.supcategories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        supcategories::create($request->all());
        // dd($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.supcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SupCategories  $supCategories
     * @return \Illuminate\Http\Response
     */
    public function show(SupCategories $supCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SupCategories  $supCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(SupCategories $supCategories,$id)
    {
        //
        $category = Category::all();
        $supcategories = supcategories::find($id);
        return view('dashboard.supcategories.edit', compact('category','supcategories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SupCategories  $supCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupCategories $supCategories ,$id)
    {
        // dd($supcategories);

        // $supcategories->update($request->all());
        $supcategories = SupCategories::find($id);
        dd($supcategories);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.supcategories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SupCategories  $supCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupCategories $supCategories,$id)
    {
        $supCategories = SupCategories::find($id);
        $supCategories->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.supcategories.index');
    }

    public function export()
    {
        return Excel::download(new SupCatexport, 'sup_category.xlsx');
    }

    public function importsupexcel(Request $request){
        $data = $request->file('file');

        $namefile = $data->getClientOriginalName();
        $data->move('cat', $namefile);

        Excel::import(new SupCatImport, \public_path('/cat/'.$namefile));
        return redirect()->back()->with('success', 'Data has been Insert SuccessFully');
    }
}
