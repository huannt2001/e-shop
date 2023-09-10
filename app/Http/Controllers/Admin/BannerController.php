<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.banners.index', [
            'banners' => Banner::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $banner = Banner::create($request->only(['title', 'slug', 'description', 'photo', 'status']));
        
        if ($banner) {
            return redirect()->route('admin.banner.index')->withSuccess('Banner successfully added');
        }

        return redirect()->route('admin.banner.index')->withErrors('Error occurred while adding banner');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('backend.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        $result = $banner->update($request->only(['title', 'slug', 'description', 'photo', 'status']));
        if ($result) {
            return redirect()->route('admin.banner.index')->withSuccess('Banner updated successfully');
        }

        return redirect()->route('admin.banner.index')->withErrors('Error occurred while updating banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $deletedBannerId = $banner->id;
        $result = $banner->delete();
        if ($result) {
            return response()->json(['success' => true, 'deletedBannerId' => $deletedBannerId]);
        }

        return response()->json('Error occurred while deleting banner');
    }
}
