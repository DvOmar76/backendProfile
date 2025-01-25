<?php

namespace App\Http\Controllers;

use App\Http\Resources\SocialResource;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $socials=SocialResource::collection(Social::all()) ;
        return response()->json([
            'data'=>$socials,
            'message'=>'data returned successfully'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['iconUrl']=uploadFile($request,'iconUrl','social');
        $socialDB=new Social;
        $newSocial= $socialDB->create($data);
        return response()->json([
            'data'=>SocialResource::make($newSocial),
            'message'=>'data created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Social $social)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Social $social)
    {
        $data = $request->all();
        $data['iconUrl']=uploadFile($request,'iconUrl','social');
        $social->update($data);
        return response()->json([
            'data'=>SocialResource::make($social),
            'message'=>'data updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Social $social)
    {
        $data=SocialResource::make($social);
        $social->delete();
        return response()->json([
            'data'=>$data,
            'message'=>'data deleted successfully'
        ]);
    }
}
