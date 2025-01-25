<?php

namespace App\Http\Controllers;

use App\Http\Resources\EN\CourseResourceEN;
use App\Http\Resources\EN\ExperienceResourceEN;
use App\Http\Resources\SkillResource;
use App\Models\Course;
use App\Models\Experience;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills=SkillResource::collection(Skill::all());
        return response()->json([
           'data'=>$skills,
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
        $data = $request->all();
        $data['iconUrl'] = uploadFile($request, 'iconUrl', 'skills');
        $skillsDB=new Skill;
        $newSkill= $skillsDB->create($data);
        return response()->json([
            'data'=>SkillResource::make($newSkill),
            'message'=>'data created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $data = $request->all();
        $data['iconUrl'] = uploadFile($request, 'iconUrl', 'skills');
        dd($data);
        $skill->update($data);
        return response()->json([
            'data'=>SkillResource::make($skill),
            'message'=>'data updated successfully'
        ]);
    }
    public function linkSkillsToCourse(Course $course,Request $request)
    {
        $skillIds = $request->input('skill_ids', []); // Provide an empty array as default
        $course->skills()->sync($skillIds);
        $course->load('skills');
        return response()->json([
            'data'=>CourseResourceEN::make($course),
            'message'=>'linked skills with course successfully'
        ]);
    }
    public function linkSkillsToExperience(Experience $experience,Request $request)
    {
        $skillIds = $request->input('skill_ids', []); // Provide an empty array as default
        $experience->skills()->sync($skillIds);
        $experience->load('skills');
        return response()->json([
            'data'=>ExperienceResourceEN::make($experience),
            'message'=>'linked skills with course successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $oldData=$skill;
        $skill->delete();
        return response()->json([
            'data'=>SkillResource::make($oldData),
            'message'=>'data created successfully'
        ]);
    }
}
