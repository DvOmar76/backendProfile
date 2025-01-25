<?php

namespace App\Http\Controllers;

use App\Http\Resources\AR\ExperienceResourceAR;
use App\Http\Resources\EN\ExperienceResourceEN;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $experiences=ExperienceResource::collection(Experience::with('skills')->get());
        return response()->json([
            'data'=>$experiences,
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
        $language= getLanguage($request);
        $data = $request->all();
        $data['imageUrl'] = uploadFile($request, 'imageUrl', 'experience');
        $data['certificateUrl'] =uploadFile($request, 'certificateUrl', 'experience');

        $courseDB= new Experience;
        $experience= $courseDB->create($data);


        if ($language=='ar')
            $data=ExperienceResourceAR::make($experience);
        else
            $data=ExperienceResourceEN::make($experience);
        return response()->json([
            'data'=>$data,
            'message'=>'data created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        $data = $request->all();
        $language= getLanguage($request);

        $data['imageUrl'] = uploadFile($request, 'imageUrl', 'experience');
        $data['certificateUrl'] =uploadFile($request, 'certificateUrl', 'experience');
        $experience->update($data);

        if ($language=='ar')
            $data=ExperienceResourceAR::make($experience);
        else
            $data=ExperienceResourceEN::make($experience);

        return response()->json([
            'data'=>$data,
            'message'=>'data updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience,Request $request)
    {
        $language= getLanguage($request);

        if ($language=='ar')
            $data=ExperienceResourceAR::make($experience);
        else
            $data=ExperienceResourceEN::make($experience);
        $experience->delete();
        return response()->json([
            'data'=>$data,
            'message'=>'data deleted successfully'
        ]);
    }
}
