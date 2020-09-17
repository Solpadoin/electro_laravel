<div class="container">
    <h2>Account Data:</h2>
    <ul>
        <li><a class="btn-outline-info"><i class="fa fa-user">{{ " ".Auth::user()->name }}</i></a></li>
        <li><a class="btn-outline-info"><i class="fa fa-envelope">{{ " ".Auth::user()->email }}</i></a></li>
    </ul>
    <button class="btn btn-dark"><a class="btn-outline-info" href="{{ route("password.reset_password") }}"><i class="fa fa-key text-white"> Change Password</i></a></button>
</div>
