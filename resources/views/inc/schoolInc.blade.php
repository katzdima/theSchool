<div class="container">
        <div class="row">
            <h1 class="text-center">The School page</h1>
            <div class="well col-lg-2 col-sm-2 ">
                <h3 class="text-center">
                    Courses
                    @if(!(Auth::user()->role === 3))
                        <a href="{{url ('/course/create')}}">
                        <i class="fas fa-plus-circle" data-fa-transform="shrink-6 down-2"></i>
                        </a>
                    @endif
                </h3>
                <hr>
                @if(count($courseAll) > 0)
                    <ul>
                        @foreach($courseAll as $courseOne)
                        <li>
                            <a href="{{url ('/course/'.$courseOne->id)}}">
                            <img class="" src="{{url ('storage/course_images/'.$courseOne->image)}}" alt="course card image">
                            <small>{{$courseOne->name}}</small>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="well col-lg-2 col-sm-2 " >
                <h3 class="text-center">
                    Students
                    <a href="{{url ('/student/create')}}">
                    <i class="fas fa-plus-circle" data-fa-transform="shrink-6 down-2"></i>
                </h3>
                <hr>
                @if(count($studentAll) > 0)
                    <ul>
                        @foreach($studentAll as $studentOne)
                        <li>
                            <a href="{{url ('/student/'.$studentOne->id)}}">
                            <img class="" src="{{url ('storage/student_images/'.$studentOne->image)}}" alt="Student card image">
                            <small>{{$studentOne->name}}</small>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @endif
                </div>