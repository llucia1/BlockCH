<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
    
<head>
    @section('htmlheader')
        @include('layouts.partials.htmlheader')
    @show
</head>

<body>
    
    <div class="container-scroller">

        @if( Request::segment(1) == 'login' OR Request::segment(1) == 'register' 
        OR Request::segment(1) == 'new-account' OR Request::segment(1) == 'password'
        OR Request::segment(1) == 'new-buy' OR Request::segment(1) == 'register-end')

            <div class="container-fluid page-body-wrapper full-page-wrapper">

                <div class="content-wrapper d-flex align-items-center auth">

                    <div class="row w-100">
                    
                        @yield('main-content')
                    
                    </div>

                </div>

            </div>

        @else

        @include('layouts.partials.mainheader')
        
        <div class="container-fluid page-body-wrapper">

            @include('layouts.partials.sidebar')

            <div class="main-panel">

                <div class="content-wrapper">

                    @include('layouts.partials.contentheader')

                    @yield('main-content')

                </div>

                @include('layouts.partials.footer')

            </div>

        </div>

        @endif

    </div>

    @section('scripts')
        @include('layouts.partials.scripts')
    @show

</body>

</html>
