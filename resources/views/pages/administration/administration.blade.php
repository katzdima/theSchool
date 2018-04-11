@extends('layouts.app')
    @section('content')
    @include('inc.adminInc')
            <div class="well col-lg-8 col-sm-8 adminBG">
                @if(isset($detailadmin))
                    <h3 class="adminDetailHeader">
                        {{$detailadmin->roleText->name}}
                        @if((Auth::user()->role === 1) || ((Auth::user()->role === 2) && ($detailadmin->role !== 1)))
                            <a href="{{url ('/administration/'.$detailadmin->id.'/edit')}}" class="btn pull-right adminDetailEditBTN">Edit</a>
                        @endif
                        @if(Auth::user()->role === 1)
                            {!!Form::open(['action'=>['adminController@destroy',$detailadmin->id], 'method' =>'POST','class'=>'pull-right','onsubmit' => 'return confirm("Are you sure you want to delete?")'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete',['class'=>'btn btn-danger pull-right'])}}
                            {!!Form::close()!!}
                        @endif
                    </h3>
                    <hr class="adminDetailList">
                    <div class="row">
                        <div class="col-lg-4 col-sm-4">
                            <img class="detailStudentProfilePic" src="{{url ('storage/user_images/'.$detailadmin->image)}}" alt="Card image cap">
                        </div>                
                        <div class="col-lg-8 col-sm-8 adminDetailList">
                            <h3>{{$detailadmin->name}}</h3>
                            <small>{{$detailadmin->email}} </small>
                            <br>
                            <small>{{$detailadmin->phone}} </small>
                            </div>
                        </div>
                @else
                    <div class=""></div>
                @endif
            </div>
        </div>
    </div>
    @endsection