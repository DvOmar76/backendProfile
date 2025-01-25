<?php

namespace App\Http\Controllers;

use App\Http\Resources\AR\CourseResourceAR;
use App\Http\Resources\CourseResource;
use App\Http\Resources\EN\CourseResourceEN;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $language= getLanguage($request);
        $courses = Course::when($language == 'ar', function ($query) {
            $query->select('id','imageUrl','certificateUrl','titleAr as title', 'descriptionAr as description');
        }, function ($query) {
            $query->select('id','imageUrl','certificateUrl','titleEn as title', 'descriptionEn as description');
        })->get();
        $data=CourseResource::collection($courses);
        return response()->json([
           'data'=>$data,
           'message'=>'data returned successfully'
        ]);
    }


    public function store(Request $request)
    {
        $language= getLanguage($request);
        $data = $request->all();
        $data['imageUrl'] = uploadFile($request, 'imageUrl', 'courses');
        $data['certificateUrl'] =uploadFile($request, 'certificateUrl', 'courses');


        $courseDB=new Course;
        $newCourse= $courseDB->create($data);
        if ($language=='ar')
            $course=CourseResourceAR::make($newCourse);
        else
            $course=CourseResourceEN::make($newCourse);

        return response()->json([
            'data'=>$course,
            'message'=>'data created successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
//        dd($course);
        $data = $request->all();
        $language= getLanguage($request);
        if ($request->hasFile( 'imageUrl')) {
            $file = $request->file( 'imageUrl');
            $name = 'courses/' . uniqid() . '.'. $file->extension();
            $file->storePubliclyAs( 'public', $name);
            $data['imageUrl']= "storage/".$name;
        }
        $course->$this->update($data);
        if ($language=='ar')
            $course=CourseResourceAR::make($course);
        else
            $course=CourseResourceEN::make($course);

        return response()->json([
            'data'=>$course,
            'message'=>'data updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Course $course)
    {
        $language= getLanguage($request);
        if ($language=='ar')
            $data=CourseResourceAR::make($course);
        else
            $data=CourseResourceEN::make($course);

        $course->delete();
        return response()->json([
            'data'=>$data,
            'message'=>'data deleted successfully'
        ]);
    }
}
