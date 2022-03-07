<?php
require_once("webauth.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>CHS Strategy | Goals</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="css/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="images/favicon.png" />
    <script data-search-pseudo-elements defer src="vendor/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="js/feather.min.js" crossorigin="anonymous"></script>

    <script src="vendor/jquery/jquery.js"></script>
</head>

<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px--> 
        <a class="navbar-brand" href="index.php">
           <img src="images/favicon3.png" alt="icon" >CHS STRATEGIC PLAN<br>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2021-2025</a>
        <!-- Sidenav Toggle Button-->
      <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><i data-feather="menu"></i></button>
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ml-auto">
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="images/profile-1.png" /></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="images/profile-1.png" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name">Admin</div>
                            <div class="dropdown-user-details-email"><a href="#" class="__cf_email__" data-cfemail="43352f362d2203222c2f6d202c2e">[email&#160;protected]</a>
                            </div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#!">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Account
                    </a>
                    <a class="dropdown-item" href="login.html">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
</nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php
            include_once("includes/navbar.php");
            ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container">
                        <div class="page-header-content pt-4">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title" style="font-size:1.5rem">
                                        <div class="page-header-icon"><i class="fas fa-bullseye"></i></div>
                                        Goals
                                    </h1>
                                </div>
                            </div>
                            <button class="btn btn-success ml-auto float-right" data-toggle="modal" data-target="#divGoalModal">
                                <span class="icon text-white-70 mr-2">
                                    <i class="fas fa-plus"></i>
                                </span>
                                Add Goal</button>
                        </div>
                    </div>
                </header>
                <!--             Main page content-->
                <div class="container mt-n10">


                    <div class="card mb-4">
                        <div class="card-body">
                            <ul class="nav goal-nav-tabs" id="divGoals" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#goal1" role="tab" aria-controls="home" aria-expanded="true">Goal 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="profile">Goal
                                        2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-controls="profile">Goal
                                        3</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php
            include_once("includes/footer.php");
            ?>
        </div>
    </div>

    <?php #include dialogs
    include_once("includes/dialogs/goal_dialog.php");
    include_once("includes/dialogs/objective_dialog.php");
    include_once("includes/dialogs/pi_dialog.php");
    // include_once("includes/loader.html");
    ?>

    <script src="vendor/jquery/jquery.min.js" crossorigin="anonymous"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/goals.js"></script>

    <!--        <script src="js/index.js"></script>-->
    <script src="js/sb-customizer.js"></script>

    <script>
        $(document).ready(function() {
            // executes when HTML-Document is loaded and DOM is ready


            if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
            return $('a[data-toggle="tab"]').on('shown', function(e) {
                return location.hash = $(e.target).attr('href').substr(1);
            });


            // document ready
        });
        let navGoals = document.getElementById("navGoals");
        let accordionSidenav = document.getElementById("accordionSidenav")
        let links = accordionSidenav.getElementsByTagName("a")
        for (let i = 0; i < links.length; i++) {
            let link = links[i]
            if (link.classList.contains("active")) {
                link.classList.remove("active")
            }
        }
        navGoals.classList.add("active");
    </script>
</body>

</html>