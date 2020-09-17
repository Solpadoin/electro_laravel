@extends('pages.admin.layouts.layout')

@section('content')
    <div class="container">
        <ul class="pull-left">
            @foreach($userModel as $user)
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if ($user == Auth::user())
                                <i class="fa fa-user-secret"></i> {{ $user->name }} <button class="btn btn-outline-info">You</button>
                            @elseif ($user->is_admin)
                                <i class="fa fa-male"></i> {{ $user->name }} <button class="btn btn-outline-info">{{ $user->getUserRolesRaw() }}</button>
                            @else
                                <i class="fa fa-user"></i> {{ $user->name }} <button class="btn btn-outline-info">{{ $user->getUserRolesRaw() }}</button>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" style="background-color: #808080;">
                            <a class="dropdown-item" href=""
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                userId: {{ $user->id }}
                            </a>

                            <a class="dropdown-item" href=""
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                email: {{ $user->email }}
                            </a>

                            <a class="dropdown-item" href=""
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                admin: @if ($user->is_admin) Yes @else No @endif
                            </a>

                            <a class="dropdown-item" href=""
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                role: {{ $user->role }}
                            </a>

                            @if (! ($user == Auth::user()))
                                <br>
                                <a class="btn btn-default" href="{{ route('admin.set_admin', $user->id) }}"> @if (! $user->is_admin) Make an admin @else Remove from admins @endif</a>
                                <a class="btn btn-default" href="{{ route('admin.set_manager', $user->id) }}"> @if (! $user->hasRole('manager')) Make an manager @else Remove from managers @endif</a>
                            @endif

                        </div>

                    <!-- <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" style="background-color: #808080;">
                            <a class="dropdown-item" href=""
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                userId: {{ $user->id }}
                                <br>
                                email: {{ $user->email }}
                                <br>
                                admin: @if ($user->is_admin) Yes @else No @endif
                                <br>
                            </a>
                        </div> -->

            @endforeach
        </ul>
    </div>
@endsection
