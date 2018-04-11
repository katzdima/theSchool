<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\course;
use App\student;

class courseController extends Controller
{
    public function __construct()
    {
        // authenticat user access 
        $this->middleware('auth');
        $this->middleware('roles', ['only' => ['edit','create','destroy']]);
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.school');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studentList=student::all();
        return view('pages.courses.addCourse')->with('studentList',$studentList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate ($request,[
            'name' => 'required',
            'description' => 'required',
            'user_image' => 'image|nullable|max:1999'
        ]);
        //file upload
        if($request->hasFile('courseImage')){
            // Get filename with the extension
            $filenameWithExt = $request->file('courseImage')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('courseImage')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('courseImage')->storeAs('public/course_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }

        //Create new course and save in DB
        $course = new Course();

        $course->timestamps = false;

        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->image = $fileNameToStore;
        $course->save();

        // inserting a record in the intermediate table
        $courseStudents=$request->input('studentList');
        $course->studentCon()->attach($courseStudents);



        return redirect()->action(
            'courseController@show', ['id' => $course->id]
        )->with('success','Course Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailCourse = course::find($id);
        return view('pages.courses.detailCourse')->with('detailCourse',$detailCourse);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editCourse = course::find($id);
        $enrolledStudents=$editCourse->studentCon;
        $enrolledStudentsIds = array();
        foreach($enrolledStudents as $enrolledStudent){
            $enrolledStudentsIds[] = $enrolledStudent['id'];
        }
        return view('pages.courses.editCourse')->with('editCourse',$editCourse)->with('enrolledStudentsIds',$enrolledStudentsIds);
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
        $this->validate ($request,[
            'name' => 'required',
            'description' => 'required',
            'user_image' => 'image|nullable|max:1999'
        ]);
        //file upload
        if($request->hasFile('courseImage')){
            // Get filename with the extension
            $filenameWithExt = $request->file('courseImage')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('courseImage')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('courseImage')->storeAs('public/course_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }

        //Find course and save update in DB
        $course = Course::find($id);

        $course->timestamps = false;

        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->image = $fileNameToStore;
        $course->save();

        // inserting a record in the intermediate table
        $courseStudents=$request->input('studentList');
        $course->studentCon()->sync($courseStudents,true);
        
        return redirect()->action(
            'courseController@show', ['id' => $course->id]
        )->with('success','Course updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courseUser=course::find($id);
        $courseUser->studentCon()->detach();
        $courseUser->delete();
        return redirect('course')->with('success','Course deleted.');
    }
}
