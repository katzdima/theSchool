@extends('layouts.app')
    @section('content')
    @include('inc.schoolInc')
        <div class="well col-lg-7 col-sm-7">
            @if(isset($detailCourse))
            
            <h3 class="page-header">
                    {{$detailCourse->name}}
                    @if(!(Auth::user()->role === 3))
                        <a href="{{url ('/course/'.$detailCourse->id.'/edit')}}" class="btn btn-outline-primary pull-right editBtn">Edit</a>
                        {!!Form::open(['action'=>['courseController@destroy',$detailCourse->id], 'method' =>'POST','class'=>'delete pull-right','onsubmit' => 'return confirm("Are you sure you want to delete?")'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Delete',['class'=>'btn btn-danger pull-right'])}}
                        {!!Form::close()!!}
                    @endif
            </h3> 
                <div class="row detailCourseContent">
                    <div class="col-lg-4 col-sm-4">
                        <img class="courseDetaiPic" src="{{url ('storage/course_images/'.$detailCourse->image)}}" alt="Course image">
                    </div>
                    <div class="col-lg-8 col-sm-8">               
                        <small>{{$detailCourse->description}}</small>
                    </div>
                </div>
                <hr>
                <h3>
                        Student list
                        <br>
                        <small>Total {{$detailCourse->studentCon->count()}}</small>
                    </h3>
                <ul>
                    @foreach($detailCourse->studentCon as $student)
                        <li>
                            <a href="{{url ('/student/'.$student->id)}}">
                                <img class="courseStudentListPic" src="{{url ('storage/student_images/'.$student->image)}}" alt="Student card image">
                                <small>{{$student->name}}</small>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    </div>
    @endsection    
