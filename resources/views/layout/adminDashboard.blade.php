<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/admin/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  @yield('extraCss')
  <title>@yield('pageTitle')</title>
</head>
<body>
  <div class="container">
    @yield('container')
   </div>
  
  <!--Header Part -->
 <div class="headNav">

    <span class="title"> <a href="{{route('admin')}}">University Management System </a> </span>
     <ul>
      <div class="dropdown">
        <li><button onclick="notibarShow()" class="notiButton"><i class="fas fa-bell"><span id="notiNumber" class="badge">2</span></i> </button></li>
        <div id="notiBox" class="dropdown-content">
          <button onclick="notibarHide()" class="closeButton"><i class="fas fa-times">Close</i></button>
          
          <a href="#">Link 2</a>
          <a href="#">Link 2</a>
          <a href="#">Link 2</a>
          <a href="#">Link 2</a>
          <a href="#">Link 2</a>
          <a href="#">Link 2</a>
          <a href="#">Link 3</a>
          <a align="center" style="text-align:center;color:rgb(83, 83, 201)" href="">Show All</a>
        </div>
      </div>
       <li><a href="{{route('admin.profile')}}"><i class="fas fa-user"></i> Profile</a></li>
       <!--<li><a href=""><i class="fas fa-cog"></i>Setting</a></li>-->
       <li><a href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
    </ul>

   
 </div>
 <!--END OF HEADER---------------------------------->
 
 <!--Side Nav---------------------------------->
<nav>
  <div class="profileDiv" align="center">
    <img class="profileImage" src=" @yield('profilePicSource') " alt="">
    <p class="username">@yield('username')</p>
  </div>
  <ul>
    <li class="dropdownList"> <a href="">Add User <span>&rsaquo;</span></a>
      <ul>
        <li><a href="{{route('create.admin')}}">Add Admin</a></li>
        <li><a href="{{route('create.account')}}">Add Account</a></li>
        <li><a href="{{route('create.teacher')}}">Add Teacher</a></li>
        <li><a href="{{route('create.student')}}">Add Student</a></li>
      </ul>
    </li>
    <li class="dropdownList"> <a href="">Course Management <span>&rsaquo;</span></a>
      <ul>
        <li><a href="{{route('admin.subject.add')}}">Add Subject</a></li>
        <li><a href="{{route('admin.course.add')}}">Add Course</a></li>
        <li><a href="{{route('admin.course.view')}}">View Courses</a></li>
        <li><a href="{{route('admin.subject.view')}}">View Subjects</a></li>
      </ul>
    </li>
    <li class="dropdownList"> <a href="">Student Management <span>&rsaquo;</span></a>
      <ul>
        <li><a href="{{route('admin.student.course.add')}}">Add To Course</a></li>
        <li><a href="{{route('admin.student.course.remove')}}">Drop From Course</a></li>
      </ul>
    </li>
    <li class="dropdownList"> <a href="">Notice <span>&rsaquo;</span></a>
      <ul>
        <li><a href="{{route('admin.notice.add')}}">Add Notice</a></li>
        <li><a href="{{route('admin.notice.view')}}">View All Notices</a></li>
      </ul>
    </li>
    <li> <a href="{{route('admin.registration')}}">Registration Controller</a></li>
    <li class="dropdownList"> <a href="">Generate Report <span>&rsaquo;</span></a>
      <ul>
        <li><a href="{{route('admin.report.university')}}">University Wise</a></li>
      </ul>
    </li>
    <li> <a href="{{route('admin.resign')}}">Resign Application</a></li>
  

    
  </ul>
</nav>

 <!--END OF Side Nav---------------------------------->



</body>

<script src="{{asset('js/admin/dashboard.js')}}"></script>

</html>