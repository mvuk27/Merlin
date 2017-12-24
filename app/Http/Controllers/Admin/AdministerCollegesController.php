<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AdministerCollege;
use App\College;
use App\County;
use Illuminate\Http\Request;

class AdministerCollegesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $administercolleges = College::where('name', 'LIKE', "%$keyword%")
                ->orWhere('aka', 'LIKE', "%$keyword%")
                ->orWhere('county_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $administercolleges = College::paginate($perPage);
        }

        $countys = County::orderBy('name','asc')->get();
        return view('admin.administer-colleges.index', compact('administercolleges','countys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countys = County::orderBy('name','asc')->get();
        return view('admin.administer-colleges.create',compact('countys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        College::create($requestData);

        return redirect('admin/administer-colleges')->with('flash_message', 'AdministerCollege added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $administercollege = College::findOrFail($id);

        return view('admin.administer-colleges.show', compact('administercollege'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $administercollege = College::findOrFail($id);
        $countys = County::orderBy('name','asc')->get();
        return view('admin.administer-colleges.edit', compact('administercollege','countys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $administercollege = College::findOrFail($id);
        $administercollege->update($requestData);

        return redirect('admin/administer-colleges')->with('flash_message', 'AdministerCollege updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        College::destroy($id);

        return redirect('admin/administer-colleges')->with('flash_message', 'AdministerCollege deleted!');
    }
}