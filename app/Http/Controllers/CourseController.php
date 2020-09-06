<?php

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseRequest;
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
        $data = $request->all();
        $extesion = $request->image_link->getClientOriginalExtension();
        $slug = str_slug($request->name);
        $nameFile = "{$slug}.{$extesion}";
        $request->image_link->storeAs('public/img',$nameFile);
        $data['image_link'] = 'img/'.$nameFile;
        $data['slug'] = $slug;
        Course::create($data);
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
            $video_link = Str::replaceArray('watch?v=', ['embed/'], $course->video);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
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
}
