<div class="row page-header">

    <h3 class="page-title"> @yield('contentheadertitle'){{ trans('app.dashboard') }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            {{--<li class="breadcrumb-item active" aria-current="page">Icons</li>--}}
            @yield('breadcrumb')
        </ol>
    </nav>
</div>