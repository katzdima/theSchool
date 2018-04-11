@extends('layouts.app')
    @section('content')
    @include('inc.schoolInc')
        <div class="well col-lg-7 col-sm-7">
                {!! Form::open(['action'=> ['studentController@update' , $editStudent->id] ,'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
                    <h3>
                        Edit Student
                        {{Form::submit('Submit', ['class'=>'btn btn-primary pull-right'])}}
                    </h3>
                    <div class="form-group">
                        {{Form::label('name', 'Name')}}
                        {{Form::text('name', $editStudent->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('phone', 'Phone Number')}}
                        {{Form::tel('phone', $editStudent->phone, ['id' => '', 'class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('email', 'E-Mail')}}
                        {{Form::email('email', $editStudent->email, ['id' => '', 'class' => 'form-control', 'placeholder' => 'E-Mail'])}}
                    </div>
                    <div class="form-group">
                        {{Form::file('studentImage')}}
                    </div>
                    <div class="form-group">
                        {{Form::label('courseList', 'Course list')}}
                        <br>
                        @foreach($courseAll as $courseCheck)
                            @if(in_array($courseCheck->id, $enrolledCoursesIds))
                                {{Form::checkbox('courseList[]', $courseCheck->id,true)}}
                                <small>{{$courseCheck->name}}</small>
                            @else
                                {{Form::checkbox('courseList[]', $courseCheck->id)}}
                                <small>{{$courseCheck->name}}</small>
                            @endif
                            <br>
                        @endforeach
                    </div>
                    {{Form::hidden('_method', 'PUT')}}
                {!! Form::close() !!}
        </div>
    </div>
    </div>
    @endsection