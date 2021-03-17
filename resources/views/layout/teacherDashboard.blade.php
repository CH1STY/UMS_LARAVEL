<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/teacher/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  @yield('extraCss')
  <title>@yield('pageTitle')</title>
</head>
<body>
  <div class="container">
    @yield('container')
   </div>

  <!--Header Part -->
 <div class="headNav">

    <span class="title" ><a href="{{route('teacher')}}" style="color:white">University Management System </a> </span>
     <ul>
      <div class="dropdown">
        <li><button onclick="notibarShow()" class="notiButton"><i class="fas fa-bell"><span id="notiNumber" class="badge">2</span></i> </button></li>
        <div id="notiBox" class="dropdown-content">
          <button onclick="notibarHide()" class="closeButton"><i class="fas fa-times">Close</i></button>

          <a href="#" style="color:black">Link 2</a>
          <a href="#" style="color:black">Link 2</a>
          <a href="#" style="color:black">Link 2</a>
          <a href="#" style="color:black">Link 2</a>
          <a href="#" style="color:black">Link 2</a>
          <a href="#" style="color:black">Link 2</a>
          <a href="#" style="color:black">Link 3</a>
          <a align="center" style="text-align:center;color:rgb(83, 83, 201)" href="">Show All</a>
        </div>
      </div>
       <li><a href="{{route('teacher.profile')}}"" style="color:white"><i class="fas fa-user"></i> Profile</a></li>
       <li><a href="" style="color:white"><i class="fas fa-cog" ></i>Setting</a></li>
       <li><a href="{{route('logout')}}" style="color:white"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
    </ul>


 </div>
 <!--END OF HEADER---------------------------------->

 <!--Side Nav---------------------------------->
<nav>
  <div class="profileDiv" align="center" style="padding : 15%">
    <img class="profileImage" src=" @yield('profilePicSource') " alt="">
    <p class="username">@yield('username')</p>
  </div>

  <div>
  <ul>
    <li class="dropdownList"> <a href="">Students <span>&rsaquo;</span></a>
      <ul>
        <li><a href="{{route('teacher.viewStudent')}}">View Student List</a></li>
        <li><a href="">Add Student</a></li>
      </ul>
    </li>
    <li class="dropdownList"> <a href="">Courses<span>&rsaquo;</span></a>
        <ul>
          <li><a href="{{route('teacher.viewCourselist')}}">View Course List</a></li>
          <li><a href="{{route('teacher.viewMyCourselist')}}">My Courses</a></li>
        </ul>
      </li>
    <li> <a href="">Accounts</a></li>
    <li> <a href="">Notes</a></li>
    <li> <a href="">Notices</a></li>
    <li> <a href="">Application</a></li>
    <li> <a href="">Library</a></li>

  </ul>
</div>
</nav>

 <!--END OF Side Nav---------------------------------->



</body>
<script src="{{asset('js/admin/dashboard.js')}}"></script>
</html>
