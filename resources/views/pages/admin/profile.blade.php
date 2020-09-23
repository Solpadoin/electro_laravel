<div class="container">
    <h2>Account Data:</h2>
    <ul>
        <li><a class="btn-outline-info"><i class="fa fa-id-card">{{ " ".Auth::user()->id }}</i></a></li>
        <li><a class="btn-outline-info"><i class="fa fa-user">{{ " ".Auth::user()->name }}</i></a></li>
        <li><a class="btn-outline-info"><i class="fa fa-envelope">{{ " ".Auth::user()->email }}</i></a></li>
        <li><a class="btn-outline-info"><i class="fa fa-user-tag">{{ " ".Auth::user()->role }}</i></a></li>
    </ul>
    <!-- <button class="btn btn-dark"><a class="btn-outline-info" href="{{ route("password.request") }}"><i class="fa fa-key text-white"> Change Password</i></a></button> -->
</div>
