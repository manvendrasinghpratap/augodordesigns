@yield('css')
@php($cssRefresh = Config::get('app.css_refresh'))

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font Awesome -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
  integrity="sha512-DTOQO9RWCH3ppGqcWaEA1B4+Jb8I+f5gx6yjFjz+M/7p+4V+M0I1Q8IWt4zvWw9T1iJ+V6x1nN6Gp4FfKx0xwA=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>

<!-- preloader css -->
{{-- <link rel="stylesheet" href="{{ URL::asset('assets/backend/css/preloader.min.css') }}" type="text/css" /> --}}
{{-- <link rel="stylesheet" href="{{ asset('assets/backend/css/preloader.min.css') }}" type="text/css"> --}}
<link rel="stylesheet" href="{{ asset('public/assets/backend/css/preloader.min.css') }}" type="text/css">


<!-- Bootstrap Css -->
<link href="{{ URL::asset('public/assets/backend/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('public/assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css -->
<link href="{{ URL::asset('public/assets/backend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('public/assets/backend/css/custom.css?id='.$cssRefresh) }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('public/assets/backend/libs/alertifyjs/alertifyjs.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/assets/backend/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/assets/backend/css/select2.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />