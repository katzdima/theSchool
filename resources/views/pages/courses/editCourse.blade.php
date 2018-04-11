@extends('layouts.app')
    @section('content')
    @include('inc.schoolInc')
        <div class="well col-lg-7 col-sm-7">
                {!! Form::open(['action'=> ['courseController@update' , $editCourse->id] ,'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
                    <h3>
                        Edit Course
                        {{Form::submit('Submit', ['class'=>'btn btn-primary pull-right'])}}
                    </h3>
                    <div class="form-group">
                        {{Form::label('name', 'Name')}}
                        {{Form::text('name', $editCourse->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('description', 'Description')}}
                        {{Form::textarea('description', $editCourse->description, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::file('course_image')}}
                    </div>
                    <div class="form-group">
                        {{Form::label('studentList', 'Student list')}}
                        <br>
                        @foreach($studentAll as $studentCheck)
                            @if(in_array($studentCheck->id, $enrolledStudentsIds))
                                {{Form::checkbox('studentList[]', $studentCheck->id,true)}}
                                <small>{{$studentCheck->name}}</small>
                            @else
                                {{Form::checkbox('studentList[]', $studentCheck->id)}}
                                <small>{{$studentCheck->name}}</small>
                            @endif
                            <br>
                        @endforeach
                    </div>
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
        </div>
    </div>
    </div>
    @endsection