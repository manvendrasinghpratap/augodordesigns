<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@lang('translation.webname') | @lang('translation.adminpanel') | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Multipurpose Admin & Dashboard Template">
    <meta name="author" content="Manvendra Pratap Singh | 8707643218">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">
    @include('backend.layouts.head-css')
</head>

@section('body')
    @include('backend.layouts.body')
@show

<div id="layout-wrapper">
    @includeWhen(View::exists('backend.layouts.topbar'),'backend.layouts.topbar')
    <div class="topnav">
        <div class="container-fluid">
            @includeWhen(View::exists('backend.layouts.menubar'),'backend.layouts.menubar')
        </div>
    </div>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        @includeWhen(View::exists('backend.layouts.footer'),'backend.layouts.footer')
        @includeWhen(View::exists('backend.modal.modalpopup'),'backend.modal.modalpopup')
    </div>
</div>
@includeWhen(View::exists('backend.layouts.vendor-scripts'),'backend.layouts.vendor-scripts')

<script>
@if(session('success')) alertify.success("{{ session('success') }}"); @endif
@if(session('error')) alertify.error("{{ session('error') }}"); @endif
@if(session('warning')) alertify.error("{{ session('warning') }}"); @endif
@if(session('info')) alertify.error("{{ session('info') }}"); @endif
</script>

</body>
</html>
