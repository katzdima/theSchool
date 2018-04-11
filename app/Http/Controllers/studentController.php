<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\student;
use App\course;
use Illuminate\Support\Facades\DB;

class studentController extends Controller
{
    public function __construct()
    {
        // authenticat user access 
        $this->middleware('auth');
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
        $courseList=course::all();
        return view('pages.students.addStudent')->with('courseList',$courseList);
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
            'email' => 'required',
            'user_image' => 'image|nullable|max:1999'
        ]);
        //file upload
        if($request->hasFile('studentImage')){
            // Get filename with the extension
            $filenameWithExt = $request->file('studentImage')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('studentImage')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('studentImage')->storeAs('public/student_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noImage.jpg';
        }
        //Create the student user in db
        $student = new Student();

        $student->timestamps = false;

        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->phone = $request->input('phone');
        $student->image = $fileNameToStore;
        $student->save();

        // inserting a record in the intermediate table
        $studentCourse=$request->input('courseList');
        $student->courseCon()->sync($studentCourse,true);



        return redirect()->action(
            'studentController@show', ['id' => $student->id]
        )->with('success','Student Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailStudent = student::find($id);
        return view('pages.students.detailStudent')->with('detailStudent',$detailStudent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editStudent = student::find($id);
        $enrolledCourses=$editStudent->courseCon;
        $enrolledCoursesIds = array();
        foreach($enrolledCourses as $enrolledCourse){
            $enrolledCoursesIds[] = $enrolledCourse['id'];
        }

        return view('pages.students.editStudent')->with('editStudent',$editStudent)->with('enrolledCoursesIds',$enrolledCoursesIds);
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
            'email' => 'required',
            'user_image' => 'image|nullable|max:1999'
        ]);
        //file upload
        if($request->hasFile('studentImage')){
            // Get filename with the extension
            $filenameWithExt = $request->file('studentImage')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('studentImage')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('studentImage')->storeAs('public/student_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noImage.jpg';
        }
        //Find the student user in DB
        $student = Student::find($id);

        $student->timestamps = false;

        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->phone = $request->input('phone');
        $student->image = $fileNameToStore;
        $student->save();

        // inserting a record in the intermediate table
        $studentCourse=$request->input('courseList');
        $student->courseCon()->sync($studentCourse,true);

        return redirect()->action('studentController@show', ['id' => $student->id])->with('success','Student updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentUser=student::find($id);
        $studentUser->courseCon()->detach();
        $studentUser->delete();
        return redirect('student')->with('success','Student deleted.');
    }
}
