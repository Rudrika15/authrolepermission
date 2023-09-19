<!DOCTYPE html>
<html>

<head>
    <title>

        @yield('title')
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <!-- for yajra dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        body {
            padding-bottom: 30px;
            position: relative;
            min-height: 100%;
        }

        a {
            transition: background 0.2s, color 0.2s;
        }

        a:hover,
        a:focus {
            text-decoration: none;
        }

        #wrapper {
            padding-left: 0;
            transition: all 0.5s ease;
            position: relative;
        }

        #sidebar-wrapper {
            z-index: 1000;
            position: fixed;
            left: 250px;
            width: 0;
            height: 100%;
            margin-left: -250px;
            overflow-y: auto;
            overflow-x: hidden;
            background: #222;
            transition: all 0.5s ease;
        }

        #wrapper.toggled #sidebar-wrapper {
            width: 250px;
        }

        .sidebar-brand {
            position: absolute;
            top: 0;
            width: 250px;
            text-align: center;
            padding: 20px 0;
        }

        .sidebar-brand h2 {
            margin: 0;
            font-weight: 600;
            font-size: 24px;
            color: #fff;
        }

        .sidebar-nav {
            position: absolute;
            top: 75px;
            width: 250px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .sidebar-nav>li {
            text-indent: 10px;
            line-height: 42px;
        }

        .sidebar-nav>li a {
            display: block;
            text-decoration: none;
            color: #757575;
            font-weight: 600;
            font-size: 18px;
        }

        .sidebar-nav>li>a:hover,
        .sidebar-nav>li.active>a {
            text-decoration: none;
            color: #fff;
            background: #f8be12;
        }

        .sidebar-nav>li>a i.fa {
            font-size: 24px;
            width: 60px;
        }

        #navbar-wrapper {
            width: 100%;
            position: absolute;
            z-index: 2;
        }

        #wrapper.toggled #navbar-wrapper {
            position: absolute;
            margin-right: -250px;
        }

        #navbar-wrapper .navbar {
            border-width: 0 0 0 0;
            background-color: #eee;
            font-size: 24px;
            margin-bottom: 0;
            border-radius: 0;
        }

        #navbar-wrapper .navbar a {
            color: #757575;
        }

        #navbar-wrapper .navbar a:hover {
            color: #f8be12;
        }

        #content-wrapper {
            width: 100%;
            position: absolute;
            padding: 15px;
            top: 100px;
        }

        #wrapper.toggled #content-wrapper {
            position: absolute;
            margin-right: -250px;
        }

        @media (min-width: 992px) {
            #wrapper {
                padding-left: 250px;
            }

            #wrapper.toggled {
                padding-left: 60px;
            }

            #sidebar-wrapper {
                width: 250px;
            }

            #wrapper.toggled #sidebar-wrapper {
                width: 60px;
            }

            #wrapper.toggled #navbar-wrapper {
                position: absolute;
                margin-right: -190px;
            }

            #wrapper.toggled #content-wrapper {
                position: absolute;
                margin-right: -190px;
            }

            #navbar-wrapper {
                position: relative;
            }

            #wrapper.toggled {
                padding-left: 60px;
            }

            #content-wrapper {
                position: relative;
                top: 0;
            }

            #wrapper.toggled #navbar-wrapper,
            #wrapper.toggled #content-wrapper {
                position: relative;
                margin-right: 60px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #wrapper {
                padding-left: 60px;
            }

            #sidebar-wrapper {
                width: 60px;
            }

            #wrapper.toggled #navbar-wrapper {
                position: absolute;
                margin-right: -250px;
            }

            #wrapper.toggled #content-wrapper {
                position: absolute;
                margin-right: -250px;
            }

            #navbar-wrapper {
                position: relative;
            }

            #wrapper.toggled {
                padding-left: 250px;
            }

            #content-wrapper {
                position: relative;
                top: 0;
            }

            #wrapper.toggled #navbar-wrapper,
            #wrapper.toggled #content-wrapper {
                position: relative;
                margin-right: 250px;
            }
        }

        @media (max-width: 767px) {
            #wrapper {
                padding-left: 0;
            }

            #sidebar-wrapper {
                width: 0;
            }

            #wrapper.toggled #sidebar-wrapper {
                width: 250px;
            }

            #wrapper.toggled #navbar-wrapper {
                position: absolute;
                margin-right: -250px;
            }

            #wrapper.toggled #content-wrapper {
                position: absolute;
                margin-right: -250px;
            }

            #navbar-wrapper {
                position: relative;
            }

            #wrapper.toggled {
                padding-left: 250px;
            }

            #content-wrapper {
                position: relative;
                top: 0;
            }

            #wrapper.toggled #navbar-wrapper,
            #wrapper.toggled #content-wrapper {
                position: relative;
                margin-right: 250px;
            }
        }

        .dropbtn {
            background-color: #f8be12;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #2980b9;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>

<body style="background-color: #fafafa">
    <div id="wrapper">
        @include('partials.header')
        <div id="navbar-wrapper">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <div class="dropdown" style="padding-right: 50px">
                            <button onclick="myFunction()" class="dropbtn">
                                Dropdown
                            </button>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="#home">Home</a>
                                <a href="#about">About</a>
                                <a href="#contact">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <section id="content-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">@yield('content')</div>
                </div>
            </div>
        </section>
    </div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script>
    const $button = document.querySelector("#sidebar-toggle");
    const $wrapper = document.querySelector("#wrapper");

    $button.addEventListener("click", (e) => {
        e.preventDefault();
        $wrapper.classList.toggle("toggled");
    });
</script>
<script>
    /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches(".dropbtn")) {
            var dropdowns =
                document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains("show")) {
                    openDropdown.classList.remove("show");
                }
            }
        }
    };
</script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</html>