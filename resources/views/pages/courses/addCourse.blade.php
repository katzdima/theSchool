@extends('layouts.app')
    @section('content')
    @include('inc.schoolInc')
        <div class="well col-lg-7 col-sm-7">
            {!! Form::open(['action'=> 'courseController@store' ,'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
                <h3>
                    Add course
                    {{Form::submit('Submit', ['class'=>'btn btn-primary pull-right'])}} 
                </h3>
                <div class="form-group">
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('description', 'Description')}}
                    {{Form::textarea('description', '', ['id' => '', 'class' => 'form-control','placeholder' =>'Description'])}}
                </div>
                <div class="form-group">
                    {{Form::file('courseImage')}}
                </div>
                <div class="form-group">
                    {{Form::label('studentList', 'Student list')}}
                    <br>
                    @foreach($studentList as $studentCheck)
                            {{Form::checkbox('studentList[]', $studentCheck->id)}}
                            <small>{{$studentCheck->name}}</small>
                        <br>
                    @endforeach
                </div>
                
            {!! Form::close() !!}
        </div>
    </div>
    </div>
    @endsection
