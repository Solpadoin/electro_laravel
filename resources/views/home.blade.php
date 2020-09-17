{{-- @extends('layouts.app') --}}

@extends('blank.blank')

@guest
    @section('title', 'My account')
    @section('page', 'My account')
@else
     <!-- Upper User Panel -->
     <!-- <li><a href="{{ route('home') }}"><i class="fa fa-user-o"></i>  {{ Auth::user()->name }}</a></li> -->

    @section('title')
        {{ Auth::user()->name." - Profile" }}
    @endsection

    @section('page', 'My account')
@endguest

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name.__(', hello!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
