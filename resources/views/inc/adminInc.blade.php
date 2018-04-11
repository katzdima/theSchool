<div class="container">
    <div class="row">
        <h1 class="text-center">The Administration page</h1>
        <div class="well col-lg-3 col-sm-3">
            <h3 class="text-center">
                Managers
                <a href="{{url ('/administration/create')}}">
                    <i class="fas fa-plus-circle" data-fa-transform="shrink-6 down-2"></i>
                </a>
            </h3>
            <hr>
            @if(count($adminall) > 0)
                <ul>
                    @foreach($adminall as $admin)
                        <li>
                            <a href="{{url ('/administration/'.$admin->id)}}">
                                <img class="" src="{{url ('storage/user_images/'.$admin->image)}}" alt="Admin user image">
                                <small>{{$admin->name}}</small>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>