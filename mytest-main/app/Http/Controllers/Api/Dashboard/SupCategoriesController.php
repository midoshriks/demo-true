<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\SupCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $test = SupCategories::all();
        // return $test;

        return 'test';

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SupCategories  $supCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupCategories $supCategories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SupCategories  $supCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupCategories $supCategories)
    {
        //
    }
}
