<nav class="nav-menu">
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row">
                <div class="span-12">
                    <div class="pull-left">
                        <h1 class="brand">
                            <a href="{{ URL::site() }}">
                                <span class="logo"></span>
                                <span class="brand-logo">
                                    Bono </br>
                                    PHP Framework
                                </span>
                            </a>
                        </h1>
                    </div>
                    <div class="">
                        <div class="nav">
                            <ul class="menu">
                                <li>
                                    <a href="{{ URL::site('/user') }}"><i class="fa fa-user"></i>&nbsp;&nbsp;User</a>
                                </li>
                                <li class="collapsible login">
                                    <a href="#"><i class="fa fa-bars"></i>&nbsp;&nbsp;Menu</a>
                                    <ul>
                                        <li>
                                            <a href="{{ URL::site('/') }}">
                                                <i class="fa fa-home"></i>&nbsp;&nbsp;Home
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ URL::site('/disclaimer') }}">
                                                <i class="fa fa-info"></i>&nbsp;&nbsp;Disclaimer
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
