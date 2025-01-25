<?php

namespace App\Http\Controllers;
use App\Http\Resources\HeaderResource;
use App\Models\Header;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $language= getLanguage($request);
        $headers = Header::when($language == 'ar', function ($query) {
            $query->select('imageUrl','type','titleAr as title', 'descriptionAr as description');
        }, function ($query) {
            $query->select('imageUrl','type','titleEn as title', 'descriptionEn as description');
        })->get();
        $data = HeaderResource::collection($headers); // Use a single Resource
        return response()->json([
           'data'=> $data,
            'message'=>'data returned successfully'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $courseDB= new Header;
        $data=$request->all();
        $data['imageUrl'] = uploadFile($request, 'imageUrl', 'headers');

        $header=$courseDB->create($data);
        $data=HeaderResource::make($header);
        return response()->json([
            'data'=> $data,
            'message'=>'data returned successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Header $header)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Header $header)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Header $header)
    {
        $data=$request->all();
        $data['imageUrl'] = uploadFile($request, 'imageUrl', '/headers/');
        dd( $data['imageUrl']);
        $header->update($data);
        $data=HeaderResource::make($header);
        return response()->json([
            'data'=> $data,
            'message'=>'data updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Header $header)
    {
        $oldData=$header;
        $header->delete();
        return response()->json([
            'data'=> $oldData,
            'message'=>'data deleted successfully'
        ]);
    }
}
