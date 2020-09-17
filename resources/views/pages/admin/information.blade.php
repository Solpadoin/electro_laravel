<div class="container-md">
    <ul class="pull-left">
        <li class="nav-item dropdown">
            {{ phpinfo(INFO_GENERAL) }}
        </li>
        <br>
        <li class="nav-item dropdown">
            {{ phpinfo(INFO_ENVIRONMENT) }}
        </li>
    </ul>
</div>
