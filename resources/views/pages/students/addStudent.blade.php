@extends('layouts.app')
    @section('content')
    @include('inc.schoolInc')
        <div class="well col-lg-7 col-sm-7">
            {!! Form::open(['action'=> 'studentController@store' ,'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
                <h3>
                    Add student
                    {{Form::submit('Submit', ['class'=>'btn btn-primary pull-right'])}}
                </h3>
                <div class="form-group">
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
                </div>
                <div class="form-group">
                        {{Form::label('phone', 'Phone Number')}}
                        {{Form::tel('phone', '', ['id' => '', 'class' => 'form-control', 'placeholder' => 'Phone number'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('email', 'E-Mail')}}
                        {{Form::email('email', '', ['id' => '', 'class' => 'form-control', 'placeholder' => 'E-Mail'])}}
                    </div>
                <div class="form-group">
                    {{Form::file('studentImage')}}
                </div>
                <div class="form-group">
                        {{Form::label('courseList', 'Listed courses')}}
                        <br>
                        @foreach($courseList as $courseCheck)
                                {{Form::checkbox('courseList[]', $courseCheck->id)}}
                                <small>{{$courseCheck->name}}</small>
                            <br>
                        @endforeach
                    </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
    @endsection