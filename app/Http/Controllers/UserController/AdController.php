<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ads\FormAd;
use Illuminate\Http\Request;
use Image;
use Storage;
use File;
use App\UserModels\Ad;
use App\UserModels\UserData;


class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.ad');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormAd $request)
    {   

        $ad = new Ad;
        $text = $request->input('text');
        $header = $request->input('header');

        if ($request->hasFile("image")) 
        {

            $ad->createDirectoryForAd();
            $image = $request->file('image');
            
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $directory = $ad->getFolderAd();
            $path = $directory.$filename;
            $store = Storage::disk('public')->put($path, File::get($image));            
           
            $ad->createAd($text, $header, $path);
        } else
            $ad->createAd($text, $header);


        return redirect()->route('create_ad_form');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = new Ad;

        $ads = $ad->getAdsUser($id);


        return view('user.ads', ['ads' => $ads, 'ad' => $ad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
