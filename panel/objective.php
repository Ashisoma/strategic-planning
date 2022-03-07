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
    <link rel="stylesheet" href="css/choices.min.css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="css/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="images/ravelry-logo.png" />
    <script data-search-pseudo-elements defer src="vendor/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="js/feather.min.js" crossorigin="anonymous"></script>

    <script src="vendor/jquery/jquery.js"></script>
    <!-- <script>
        $(function () {
            $("#layoutSidenav_nav").load("includes/navbar.html");
        });
    </script> -->
</head>


<body class="nav-fixed sidenav-toggled">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px--><a class="navbar-brand" href="index.php">CHS STRATEGIC PLAN<br>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  2021-2025</a>
        <!-- Sidenav Toggle Button-->
        <!-- <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><i
                data-feather="menu"></i></button> -->
      <button class="btn btn-icon btn-transparent-dark" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
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
        <div id="layoutSidenav_nav"></div>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container">
                        <div class="page-header-content pt-4 pb-4">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title" style="font-size:1.5rem" id="objectiveHeading">
                                        This is the objective header.....~~~~#~
                                    </h1>
                                    <!--  <p class="page-header-subtitle" id="pLead">Led By: </p>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main page content-->
                <div class="container mt-n10">
                    <!-- Example Colored Cards for Dashboard Demo-->
                    <div class="card mb-4">
                        <div class="card-header">
                            Strategies
                            <div class="float-right form-row">
                                <button class="btn btn-info ml-auto" id="btnAddStrategy" data-toggle="modal" data-target="#divStrategyModal">
                                    <span class="icon text-white-70 mr-2">
                                        <i class="far fa-lightbulb"></i>
                                    </span>
                                    <span class="text"> Add a strategy</span>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div id="accordion" class="accordion">
                                <div class="card mb-0" id="strategiesCard">

                                    <div id="collapseObjOne" class="card-body" data-parent="#accordion">
                                        <div class="datatable">
                                            <table id="tableStrategies" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Strategy</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Strategy</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            Activities
                            <div class="float-right form-row">
                                <button class="btn btn-info ml-auto" id="btnAddActivity" data-toggle="modal" data-target="#divActivityModal">
                                    <span class="icon text-white-70 mr-2">
                                        <i class="far fa-lightbulb"></i>
                                    </span>
                                    <span class="text"> Add an activity</span>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">

                            <header class="page-header page-header-dark pb-0">
                                <div class="tab" id="divActivities">
                                    <button type="button" class="button"># 1</button>
                                    <button type="button" class="button active"># 2</button>
                                    <button type="button" class="button"># 3</button>
                                </div>
                            </header>
                            <div id="accordion" class="">
                                <div class="card mb-0" id="objectivesCard">
                                    <div class="card-header">
                                        <a class="card-title mr-2">
                                            <h3 class=" font-weight-bold text-dark" id="headerActivity">
                                                #1: No activity
                                            </h3>
                                            <div class="float-right mb-4" id="divActivityStatus">Active</div>

                                            </br>
                                            <h6 class=" font-weight-bold text-dark" id="headerActivityStategy">Strategy
                                            </h6>
                                        </a>

                                        <div class="btn-toolbar justify-content-between float-right" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group" role="group">
                                            <button class="btn btn-info ml-auto mr-4 d-none" id="btnViewActivity" onclick="viewedActivityProgress()">
                                                <span class="icon text-white-70 mr-2">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                                <span class="text"> View Progress</span>
                                            </button>
                                            <button class="btn btn-info ml-auto float-right" id="btnAddActivity" data-toggle="modal" data-target="#divActivityModal" onclick="editViewedActivity()">
                                                <span class="icon text-white-70 mr-2">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span class="text"> Edit activity</span>
                                            </button>
                                            </div>
                                            
                                        </div>

                                    </div>
                                    <div id="collapseObjOne" class="card-body" data-parent="#accordion">
                                        <div class="datatable">
                                            <table id="tablePis" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Performance Indicator</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Performance Indicator</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-outline-primary btn-floating float-right" data-tooltip="tooltip" title="Add  a performance indicator" style="border-radius: 45px;" data-toggle="modal" data-target="#divPiModal">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <?php include_once("includes/footer.php") ?>
        </div>
    </div>


    <?php
    include_once("includes/dialogs/pi_dialog.php");
    include_once("includes/dialogs/activity_dialog.php");
    include_once("includes/dialogs/strategy_dialog.php");
    ?>



    <script src="vendor/jquery/jquery.min.js" crossorigin="anonymous"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/choices.min.js"></script>
    <script src="js/scripts.js"></script>
    <!-- <script src="vendor/chart.js/Chart.min.js" crossorigin="anonymous"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script> -->
    <script src="vendor/datatables/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/moment.min.js" crossorigin="anonymous"></script>
    <script src="js/daterangepicker.min.js" crossorigin="anonymous"></script>
    <script src="js/demo/date-range-picker-demo.js"></script>

    <!--        <script src="js/index.js"></script>-->
    <script src="js/sb-customizer.js"></script>
    <script src="js/objective.js"></script>
</body>

</html>