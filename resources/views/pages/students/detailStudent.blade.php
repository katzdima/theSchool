@extends('layouts.app')
    @section('content')
    @include('inc.schoolInc')
        <div class="well col-lg-7 col-sm-7">
                @if(isset($detailStudent))
                    <h3> 
                        Student
                        <a href="{{url ('/student/'.$detailStudent->id.'/edit')}}" class="btn pull-right editBtn">Edit</a>
                        {!!Form::open(['action'=>['studentController@destroy',$detailStudent->id], 'method' =>'POST','class'=>'pull-right','onsubmit' => 'return confirm("Are you sure you want to delete?")'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Delete',['class'=>'btn btn-danger pull-right'])}}
                        {!!Form::close()!!}
                    <h3>
                <hr>
                <div class="row">
                    <div class="col-lg-4 col-sm-4">
                        <img class="detailStudentProfilePic" src="{{url ('storage/student_images/'.$detailStudent->image)}}" alt="Student card image">
                    </div>                
                    <div class="col-lg-8 col-sm-8">
                        <h3>{{$detailStudent->name}}</h3>
                        <small>{{$detailStudent->email}} </small>
                        <br>
                        <small>{{$detailStudent->phone}} </small>
                    </div>
                </div>
                <hr>
                <h3>
                    Course list
                    <br>
                    <small>Total {{$detailStudent->courseCon->count()}}</small>
                </h3>
                <ul>
                    @foreach($detailStudent->courseCon as $listedCourse)
                        <li>
                            <a href="{{url ('/course/'.$listedCourse->id)}}">
                                <img class="courseListAtStudentDetailPic" src="{{url ('storage/course_images/'.$listedCourse->image)}}" alt="Course card image">
                                <small>{{$listedCourse->name}}</small>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    </div>
    @endsection