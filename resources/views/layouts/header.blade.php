<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>NextFi</b>Company</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="https://i.pinimg.com/originals/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{auth()->user()->name }} </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="https://i.pinimg.com/originals/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg" class="img-circle"
                                alt="User Image">

                            <p>
                                {{auth()->user()->name }} 
                                {{-- <small>Member since Nov. 2012</small> --}}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            
                            <div class="pull-right">
                                {{-- <a href="{{route('logout')}} " class="btn btn-default btn-flat">Sign out</a> --}}
                                <form class="d-flex px-5" action="/logout" method="POST">
                                  @csrf
                                  <button class="btn btn-primary" type="submit">Log out</button>
                                </form>
                            </div>
                            
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
