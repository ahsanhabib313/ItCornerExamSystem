<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content=""><!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="icon" href="{{ asset(' assets/img/basic/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css">
    <title>IT Corner Exam System</title>

    <!-- CSS -->


    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }

    </style>
    <!-- Js -->
    <!--
    --- Head Part - Use Jquery anywhere at page.
    --- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
    -->
    <script>
        (function(w, d, u) {
            w.readyQ = [];
            w.bindReadyQ = [];

            function p(x, y) {
                if (x == "ready") {
                    w.bindReadyQ.push(y);
                } else {
                    w.readyQ.push(x);
                }
            };
            var a = {
                ready: p,
                bind: p
            };
            w.$ = w.jQuery = function(f) {
                if (f === d || f === u) {
                    return a
                } else {
                    p(f)
                }
            }
        })(window, document)
    </script>
</head>

<body class="light">
    <!-- Pre loader -->
    <div id="loader" class="loader">
        <div class="plane-container">
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        <main>
            <div id="primary" class="blue4 p-t-b-100 height-full responsive-phone">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="{{ asset('assets/img/icon/icon-plane.png') }}" alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="text-white">
                                <h1>Welcome To IT Corner</h1>
                                <p class="s-18 p-t-b-20 font-weight-lighter">Hey Soldier welcome, signup now there
                                    is lot of
                                    new stuff waiting
                                    for you</p>
                            </div>
                            <div class="jumbotron" style="background-color: #46747c !important;">
                                <div class="">
                                    <form action="{{route('user.register')}}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group has-icon">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <input type="text" class="form-control form-control-md no-b"
                                                           placeholder="First Name" name="first_name">
                                                    @error('first_name')
                                                    <p class="text-warning">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group has-icon"><i class="fa fa-user"
                                                                                    aria-hidden="true"></i>
                                                    <input type="text" class="form-control form-control-md no-b"
                                                           placeholder="Last Name" name="last_name">
                                                    @error('last_name')
                                                    <p class="text-warning">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group has-icon"><i class="fas fa-venus-mars" aria-hidden="false"></i>
                                                    <select class="form-control form-control-md no-b" name="gender" >
                                                        <option value="null" selected disabled>Gender</option>
                                                        <option value="male" >Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                    @error('gender')
                                                    <p class="text-warning">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group has-icon">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <input type="text" name="age" class="form-control form-control-md no-b"
                                                           placeholder="Age">
                                                    @error('age')
                                                    <p class="text-warning">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                                                    <input type="email" class="form-control form-control-md no-b"
                                                           placeholder="Email Address" name="email">
                                                    @error('email')
                                                    <p class="text-warning">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group has-icon"><i class="icon-user-secret"></i>
                                                    <input type="password" class="form-control form-control-md no-b"
                                                           placeholder="Password" name="password">
                                                    @error('password')
                                                    <p class="text-warning">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group has-icon"><i class="fas fa-mobile-alt"></i>
                                                    <input type="text" class="form-control form-control-md no-b"
                                                           placeholder="Mobile Number" name="mobile_number">
                                                    @error('mobile_number')
                                                    <p class="text-warning">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group has-icon"><i class="fas fa-camera"></i>
                                                    <input type="file" name="image"
                                                           class=" form-control form-control-md no-b" accept="image/*">
                                                    @error('image')
                                                    <p class="text-warning">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <select class="form-control form-control-md no-b" name="category">
                                                        <option value="" disabled selected>Application For</option>
                                                        @isset($categories)
                                                            @foreach ($categories as $category)
                                                                <option value="{{$category->id}}" >{{$category->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    @error('category')
                                                    <p class="text-warning">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12" style="padding: 0">
                                                <input type="submit" class="btn btn-success btn-lg btn-block" value="Sign Up">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #primary -->
        </main>
        <!-- Right Sidebar -->
        <aside class="control-sidebar fixed white ">
            <div class="slimScroll">
                <div class="sidebar-header">
                    <h4>Activity List</h4>
                    <a href="login-2.html#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
                </div>
                <div class="p-3">
                    <div>
                        <div class="my-3">
                            <small>25% Complete</small>
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%;"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="my-3">
                            <small>45% Complete</small>
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 45%;"
                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="my-3">
                            <small>60% Complete</small>
                            `
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="my-3">
                            <small>75% Complete</small>
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="my-3">
                            <small>100% Complete</small>
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 bg-primary text-white">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="font-weight-normal s-14">Sodium</h5>
                            <span class="font-weight-lighter text-primary">Spark Bar</span>
                            <div> Oxygen
                                <span class="text-primary">
                                    <i class="icon icon-arrow_downward"></i> 67%</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <canvas width="100" height="70" data-chart="spark" data-chart-type="bar"
                                data-dataset="[[28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100]]"
                                data-labels="['a','b','c','d','e','f','g','h','i','j','k','l','m','n','a','b','c','d','e','f','g','h','i','j','k','l','m','n']">
                            </canvas>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                        <tbody>
                            <tr>
                                <td>
                                    <a href="login-2.html#">INV-281281</a>
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                </td>
                                <td>$ 1228.28</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="login-2.html#">INV-01112</a>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Overdue</span>
                                </td>
                                <td>$ 5685.28</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="login-2.html#">INV-281012</a>
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                </td>
                                <td>$ 152.28</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="login-2.html#">INV-01112</a>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Overdue</span>
                                </td>
                                <td>$ 5685.28</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="login-2.html#">INV-281012</a>
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                </td>
                                <td>$ 152.28</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="sidebar-header">
                    <h4>Activity</h4>
                    <a href="login-2.html#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
                </div>
                <div class="p-4">
                    <div class="activity-item activity-primary">
                        <div class="activity-content">
                            <small class="text-muted">
                                <i class="icon icon-user position-left"></i> 5 mins ago
                            </small>
                            <p>Lorem ipsum dolor sit amet conse ctetur which ascing elit users.</p>
                        </div>
                    </div>
                    <div class="activity-item activity-danger">
                        <div class="activity-content">
                            <small class="text-muted">
                                <i class="icon icon-user position-left"></i> 8 mins ago
                            </small>
                            <p>Lorem ipsum dolor sit ametcon the sectetur that ascing elit users.</p>
                        </div>
                    </div>
                    <div class="activity-item activity-success">
                        <div class="activity-content">
                            <small class="text-muted">
                                <i class="icon icon-user position-left"></i> 10 mins ago
                            </small>
                            <p>Lorem ipsum dolor sit amet cons the ecte tur and adip ascing elit users.</p>
                        </div>
                    </div>
                    <div class="activity-item activity-warning">
                        <div class="activity-content">
                            <small class="text-muted">
                                <i class="icon icon-user position-left"></i> 12 mins ago
                            </small>
                            <p>Lorem ipsum dolor sit amet consec tetur adip ascing elit users.</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- /.right-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
        <div class="control-sidebar-bg shadow white fixed"></div>
    </div>
    <!--/#app -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/personalInfo.js') }}"></script>




    <!--
--- Footer Part - Use Jquery anywhere at page.
--- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
-->
    <script>
        (function($, d) {
            $.each(readyQ, function(i, f) {
                $(f)
            });
            $.each(bindReadyQ, function(i, f) {
                $(d).bind("ready", f)
            })
        })(jQuery, document)
    </script>
</body>

</html>
