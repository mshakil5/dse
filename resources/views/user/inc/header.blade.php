<section>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg   navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{route('user.dashboard')}}">
                        
                        <div class="brand">
                            {{-- <img src="{{ asset('nhs.png')}}" width="150px" alt=""> --}}
                            <img src="{{ asset('hsc.png')}}" width="120px">
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center text-danger" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <iconify-icon class="me-1 fs-3 " icon="ph:users-light"></iconify-icon>  Users
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li> --}}

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link  d-flex align-items-center text-info" href="{{route('user.determinigQn')}}" >
                                    <iconify-icon class="me-1 fs-3 " icon="iconoir:reports"></iconify-icon> Learning
                                </a>
                            </li> --}}

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle  d-flex align-items-center text-warning" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <iconify-icon class="me-1 fs-3 "  icon="majesticons:note-text"></iconify-icon>  Assesments
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li> --}}
                            <!-- <li class="nav-item">
                                <a class="nav-link  " aria-current="page" href="#">Insights</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  " aria-current="page" href="#">Course Library</a>
                            </li> -->
                        </ul>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @if (Auth::user()->role_type == "Manager")
                            <li class="nav-item">
                                <a href="{{route('user.switchmanager')}}" class="nav-link d-flex align-items-center"> <iconify-icon  class="me-1 fs-3"  icon="ph:gear-light"></iconify-icon> Manager Dashboard
                                </a>
                            </li>
                            @endif

                            
                            @if (Auth::user()->role_type == "Health")
                            <li class="nav-item">
                                <a href="{{route('user.switchmanager')}}" class="nav-link d-flex align-items-center"> <iconify-icon  class="me-1 fs-3"  icon="ph:gear-light"></iconify-icon> My Dashboard
                                </a>
                            </li>
                            @endif
                            

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <iconify-icon icon="ph:user" class="me-1 fs-3" ></iconify-icon> {{Auth::user()->name}}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                    
                                    <a class="dropdown-item" href="{{ route('user.profile') }}" >
                                        Profile
                                    </a>


                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </ul>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-6 pt-2 bg-light">
                <h3>Display Screen Equipment Assessment</h3>
            </div>
            <div class="col-lg-6 pt-2 bg-light text-end">
                <h3>User Portal</h3>
            </div>

        </div>
        {{-- <div class="row">
            <div class="col-lg-12 py-2 bg-light">
                <div class="alert alert-dark" role="alert">
                    Please sent feedback to support at <em class="text-dark fw-bold">admin@admin.com</em>
                </div>
            </div>
        </div> --}}

    </div>
</section>


