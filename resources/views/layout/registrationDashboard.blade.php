<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/admin/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  @yield('extraCss')
  <title>@yield('pageTitle')</title>
</head>
<body>
  <div class="container">
    @yield('container')
   </div>
  
 
</body>

<script src="{{asset('js/admin/dashboard.js')}}"></script>

</html>