@extends('layouts.app')
    @section('content')
    @include('inc.adminInc')
            <div class="well col-lg-8 col-sm-8">
                <h3>Add administration user</h3>
                {!! Form::open(['action'=> 'adminController@store' ,'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
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
                        {{Form::label('password', 'Password')}}
                        {{Form::password('password', ['id' => '', 'class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('password_confirmation', 'Confirm Password')}}
                        {{Form::password('password_confirmation', ['id' => '', 'class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('role', 'Role')}}
                        <br>
                        @if(Auth::user()->role !== 1)
                            @foreach($role as $roleName)
                                @if($roleName->id !== 1)
                                    {{Form::radio('role', $roleName->id)}}
                                    {{Form::label('role', $roleName->name)}}
                                    <br>
                                @endif
                            @endforeach
                        @else
                            @foreach($role as $roleName)
                                    {{Form::radio('role', $roleName->id)}}
                                    {{Form::label('role', $roleName->name)}}
                                    <br>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::file('user_image')}}
                    </div>
                    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endsection