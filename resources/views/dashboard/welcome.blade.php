<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
@include('dashboard.head')
<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">
                @include('dashboard.sidebar')
                <div class="section-content-right">
                    {{-- @include('dashboard.topbar') --}}
                <x-topbar/>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@include('dashboard.scripts')
</body>
</html>
