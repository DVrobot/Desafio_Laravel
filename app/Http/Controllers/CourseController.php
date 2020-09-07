<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course();
        $categories = Category::all();
        return view('admin.courses.create', compact('course','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        Course::create($this->makeImage($request));
        return redirect()->route('courses.index')->with('success',true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $video_link = $course->video;
        if(Str::contains($course->video, ['https://www.youtube.com/watch?v='])){
            $videoID = Str::between($course->video, 'watch?v=', '&list');
            $video_link = 'https://www.youtube.com/embed/' . $videoID;
        }
        
        $categories = Category::all();
        return view('admin.courses.show', compact('course','categories' ,'video_link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', compact('course','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        Storage::delete('public/' . $course->image_link);
        Course::create($this->makeImage($request));
        return redirect()->route('courses.index')->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        Storage::delete('public/' . $course->image_link);
        $course->delete();
        return redirect()->route('courses.index')->with('success', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscription(Request $request, Course $course){
        $user = User::findOrFail($request->user);
        $user->courses()->syncWithoutDetaching($course);   
        if( !($request->subscribe) ){
            $user->courses()->detach($course);  
        }
        return redirect()->route('courses.index')->with('success',true);
    }

  /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Response
     * @return array $data
     */
    public function makeImage(Request $request)
    {
        $data = $request->all();
        $extesion = $request->image_link->getClientOriginalExtension();
        $data['slug'] = str_slug($request->name);
        $data['image_link'] = "{$data['slug']}.{$extesion}";
        $request->image_link->storeAs('public/img', $data['image_link']);
        return $data;
    }
}
