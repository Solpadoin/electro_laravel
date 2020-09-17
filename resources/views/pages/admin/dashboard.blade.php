<!-- ONLY FOR TESTING AND PRACTICE PURPOSES! I KNOW THAT THIS IS WRONG CODING -->

<div class="container-md">
    <div class="container">
        <h2 class="text-center">Main Information</h2>
        <ul class="pull-right">
            <li class="nav-item dropdown">
                <strong>{{ $_SERVER['SERVER_NAME'] }}</strong>
            </li>
            <li class="nav-item dropdown">
                <strong>{{ $_SERVER['SERVER_ADDR'] }}</strong>
            </li>
            <li class="nav-item dropdown">
                <strong>{{ $_SERVER['SERVER_PROTOCOL'] }}</strong>
            </li>
            <li class="nav-item dropdown">
                <strong>{{ $_SERVER['REMOTE_ADDR'] }}</strong>
            </li>
        </ul>
        <strong class="pull-left"> Server Name:</strong>
        <br>
        <strong class="pull-left"> Server Address:</strong>
        <br>
        <strong class="pull-left"> Server Protocol:</strong>
        <br>
        <strong class="pull-left"> Remote Address:</strong>
    </div>
    <div class="container">
        <h2 class="text-center">Resources</h2>

        <strong class="pull-right">
            <?php
                // Get memory size
                $memory_size = memory_get_usage();

                // Specify memory unit
                $memory_unit = array('Bytes','KB','MB','GB','TB','PB');

                // Display memory size into kb, mb etc.
                echo 'Environment: '.round($memory_size/pow(1024,($x=floor(log($memory_size,1024)))),2).' '.$memory_unit[$x]."\n";
            ?>
        </strong>

        <strong class="pull-left"> Used Memory:</strong>
        <br>
        <strong class="pull-left"> Disk Usage:</strong>

        <strong class="pull-right">
            <?php
            function shapeSpace_disk_usage() {

                $disktotal = disk_total_space ('/');
                $diskfree  = disk_free_space  ('/');
                $diskuse   = round (100 - (($diskfree / $disktotal) * 100)) .'% '.' ['.$diskfree.' / '.$disktotal.'] bytes';

                return $diskuse;

            }
            echo ''.shapeSpace_disk_usage();
            ?>
        </strong>

        <br>
        <br>
        <br>

        <h2 class="text-center">Environment Info</h2>
            <a href="" class="text-dark"><strong class="pull-left"> Project Name: </strong>
            <strong class="pull-right"> {{ env('APP_NAME') }}</strong></a>
        <br>
            <a href="" class="text-dark"><strong class="pull-left"> App Environment: </strong>
            <strong class="pull-right"> {{ env('APP_ENV') }}</strong></a>
        <br>
            <a href="" class="text-dark"><strong class="pull-left"> App Key: </strong>
            <strong class="pull-right"> {{ env('APP_KEY') }}</strong></a>
        <br>
            <a href="" class="text-dark"><strong class="pull-left"> App Locale: </strong>
            <strong class="pull-right"> {{ App::getLocale() }}</strong></a>
        <br>
            <a href="" class="text-dark"><strong class="pull-left"> Data Base Type: </strong>
            <strong class="pull-right"> {{ env('DB_CONNECTION') }}</strong></a>
        <br>
            <a href="" class="text-dark"><strong class="pull-left"> Data Base Name: </strong>
            <strong class="pull-right"> {{ env('DB_DATABASE') }}</strong></a>
        <br>
    </div>
</div>
