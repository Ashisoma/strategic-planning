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
    <title>CHS Strategy | Home</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
    <link href="css/dashboard.css" rel="stylesheet" />
    <!-- Custom styles for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="css/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="images/favicon.png" />

    <!-- <script src="vendor/jquery/jquery.js"></script> -->
    <script data-search-pseudo-elements defer src="vendor/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="js/feather.min.js" crossorigin="anonymous"></script>


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
            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-expanded="false" data-tooltip="tooltip" data-placement="bottom" title="Overdue activities. (Not Started)">

                    <img height="24px" width="24px" src="images/timer_green.png" />

                    <!-- Counter - Alerts -->
                    <span id="spanNotStarted" class="badge badge-danger badge-counter" style="margin-top: -10px; margin-left: -5px;">0</span>
                </a>
                <!-- Dropdown - Alerts -->
                <div id="divNotStarted" class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Late Activities(Not Started)
                    </h6>
                    <ul id="ulNotStarted" style="max-height: 250px; overflow:auto">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Update the existing HR policy to be in tandem with the existing and future trends.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Update the existing HR policy to be in tandem with the existing and future trends.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-tooltip="tooltip" data-placement="bottom" title="Overdue activities. (Pending completion)">

                    <img class="dropdown-user-img" height="24px" width="24px" src="images/overdue.png" />
                    <!-- Counter - Messages -->
                    <span id="spanDelayed" class="badge badge-danger badge-counter" style="margin-top: -10px; margin-left: -5px;">0</span>
                </a>
                <!-- Dropdown - Messages -->
                <div id="divDelayedCompletion" class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" style="overflow: auto;" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        Delayed Completion
                    </h6>
                    <ul id="ulDelayedCompletion" style="max-height: 250px; overflow:auto">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Update the existing HR policy to be in tandem with the existing and future trends.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Update the existing HR policy to be in tandem with the existing and future trends.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
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
                    <a class="dropdown-item" href="#" id="myNavsignOut">
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
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-3">
                    <div class="container">
                        <div class="page-header-content pt-0 pb-6">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                                        Dashboard
                                    </h1>
                                    <div class="page-header-subtitle">Dashboard overview and content summary</div>
                                </div>

                                <div class="col-12 col-xl-auto mt-4">
                                    <input id='selectYear' class="date-own form-control" style="width: 300px;" type="text" placeholder="Select year">

                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main page content-->
                <div class="container mt-nun">

                    <div class="row" style="display: none;">
                        <div class="col-xxl-3 col-md-3">
                            <div class="card bg-light text-primary mb-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-primary-75 small" style="text-transform: uppercase">Active
                                                Goals
                                            </div>
                                            <div class="text-lg font-weight-bold">6</div>
                                        </div>
                                        <i class="fas fa-bullseye text-primary-30 feather-xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3">
                            <div class="card bg-light text-success mb-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-success-75 small" style="text-transform: uppercase">Completed
                                                Goals
                                            </div>
                                            <div class="text-lg font-weight-bold">2</div>
                                        </div>
                                        <i class="feather-xl text-success-30" data-feather="check-square"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3">
                            <div class="card bg-light text-warning mb-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-warning-75 small" style="text-transform: uppercase">Completed objectives
                                            </div>
                                            <div class="text-lg font-weight-bold">15</div>
                                        </div>
                                        <i class="fa fa-exclamation-triangle feather-xl text-warning-30"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3">
                            <div class="card bg-light text-info mb-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-info-75 small" style="text-transform: uppercase">Completed Activities
                                            </div>
                                            <div class="text-lg font-weight-bold">15</div>
                                        </div>
                                        <i class="fa fa-hourglass-start feather-xl text-info-30"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs bordered mt-10" id="ulGoals">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Goals</a>
                        </li>
                    </ul>
                    <div class="row mb-3 mt-0" style="height: 500px; border-width:0em;">
                        <div class="col-xl-12">
                            <div class="card" style="height:100%;">
                                <div class="card-header">
                                    <div class="row">
                                        <p class="col-lg-4 col-md-4 col-sm-12">Objectives and activities Progress</p>

                                        <div class="col-lg-8 col-md-8 col-sm-12 transparent" style=" color: black;">
                                            <!-- <h6 style="text-align: center; margin-top: 2px;">Legend</h6> -->
                                            <div class="row">
                                                <div class="col-1 mt-1" style="border-bottom-width: thin; background: yellow; width: 4px; height: 10px;"></div>
                                                <div class="col-2">
                                                    <p style="font-size: 10px">Ongoing</p>
                                                </div>
                                                <div class="col-1 mt-1" style="border-bottom-width: thin; background: greenyellow; width: 4px; height: 10px;"></div>
                                                <div class="col-2">
                                                    <label style="font-size: 10px">Completed</label>
                                                </div>
                                                <div class="col-1 mt-1" style="border-bottom-width: thin; background: grey; width: 4px; height: 10px;"></div>
                                                <div class="col-2">
                                                    <p style="font-size: 10px">Not Started</p>
                                                </div>
                                                <div class="col-1 mt-1" style="border-bottom-width: thin; background: #FA8072; width: 4px; height: 10px;"></div>
                                                <div class="col-2">
                                                    <p style="font-size: 10px">Overdue</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <div class="card-body">
                                    <div class="btn-group float-right d-none" role="group" aria-label="Basic example">
                                        <a class="btn btn-teal" style="width: 10px;" data-tooltip="tooltip" data-placement="bottom" title="Zoom out"><i class="fas fa-minus"></i></a>
                                        <a class="btn btn-dark" style="width: 10px;" data-tooltip="tooltip" data-placement="bottom" title="Zoom In"><i class="fas fa-plus"></i></a>
                                    </div>
                                    <div id="ganttContainer" class="chart-area">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Example Colored Cards for Dashboard Demo-->
<!-- 
                    <div class="tab-content   mb-4" id="">
                        <div class="">
                             <div class="row"> 
                                <div class="col-xl-8">
                                    <div class="card h-100">
                                        <div class="card-header">
                                        </div>
                                        <div class="">

                                            <div class="">
                                                <canvas id="chartObjectives" width="100%" height="35" display="none"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 


                        </div>

                    </div> -->

            </main>
            <?php
            include_once("includes/footer.php");
            ?>
        </div>
    </div>

    <!-- Popup highlight activities -->
    <div class="modal fade" id="divPopupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupHeader">Objective Activities</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="popupTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Person Responsible</th>
                                <th>Expected Timeline</th>
                                <th>Weight</th>
                                <th>Status</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Activity</th>
                                <th>Person Responsible</th>
                                <th>Expected Timeline</th>
                                <th>Weight</th>
                                <th>Status</th>
                                <th>Notes</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Update the existing HR policy to be in tandem with the existing and future trends..</td>
                                <td>Create flexible staff contracting arrangements to include: part-time, secondment, flexi hours, job sharing among others, and its applicable reward system.</td>
                                <td>2021-05-05 - 2021-07-30</td>
                                <td>2</td>
                                <td>
                                    <div class="badge badge-primary badge-pill p-2">Ongoing</div>
                                </td>
                                <td>Create flexible staff contracting arrangements to include: part-time, secondment, flexi hours, job sharing among others, and its applicable reward system.</td>
                            </tr>
                            <tr>
                                <td>Enhance existing ICT infrastructure to enable remote access..</td>
                                <td>Create flexible staff contracting arrangements to include: part-time, secondment, flexi hours, job sharing among others, and its applicable reward system.</td>
                                <td>2021-05-05 - 2021-07-30</td>
                                <td>2</td>
                                <td>
                                    <div class="badge badge-warning badge-pill p-2">Not Started</div>
                                </td>
                                <td>Create flexible staff contracting arrangements to include: part-time, secondment, flexi hours, job sharing among others, and its applicable reward system.</td>
                            </tr>
                            <tr>
                                <td>Develop and implement an engaging online on-boarding module.</td>
                                <td>Deepen adoption of technology solutions as an enabler of flexibility in the workplace.</td>
                                <td>2021-05-05 - 2021-07-30</td>
                                <td>2</td>
                                <td>
                                    <div class="badge badge-warning badge-pill p-2">Not Started</div>
                                </td>
                                <td>Create flexible staff contracting arrangements to include: part-time, secondment, flexi hours, job sharing among others, and its applicable reward system.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


    <!-- Anychart internet dependencies -->
    <script src="https://cdn.anychart.com/releases/8.10.0/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.10.0/js/anychart-gantt.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-gantt.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-data-adapter.min.js"></script>
    <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">

    <!-- Anychart local dependencies -->
    <!-- <script src="js/anychart_8.10.0/anychart-core.min.js"></script>
    <script src="js/anychart_8.10.0/anychart-gantt.min.js"></script>
    <script src="js/anychart_v8/anychart-base.min.js"></script>
    <script src="js/anychart_v8/anychart-ui.min.js"></script>
    <script src="js/anychart_v8/anychart-exports.min.js"></script>
    <script src="js/anychart_v8/anychart-gantt.min.js"></script>
    <script src="js/anychart_v8/anychart-data-adapter.min.js"></script>
    <link rel="stylesheet" href="css/anychart_v8/anychart-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/anychart_v8/anychart-font.min.css" type="text/css"> -->

    <script src="vendor/jquery/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="vendor/chart.js/Chart.min.js" crossorigin="anonymous"></script>
    <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script> -->
    <script src="vendor/datatables/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/moment.min.js" crossorigin="anonymous"></script>
    <script src="js/daterangepicker.min.js" crossorigin="anonymous"></script>
    <script src="js/demo/date-range-picker-demo.js"></script>

    <script src="js/index.js"></script>
    <script src="js/sb-customizer.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        $(document).ready(function() {
            // executes when HTML-Document is loaded and DOM is ready


            if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
            return $('a[data-toggle="tab"]').on('shown', function(e) {
                return location.hash = $(e.target).attr('href').substr(1);
            });


            // document ready

        });
        let navDashboard = document.getElementById("navDashboard");
        let accordionSidenav = document.getElementById("accordionSidenav")
        let links = accordionSidenav.getElementsByTagName("a")
        for (let i = 0; i < links.length; i++) {
            let link = links[i]
            if (link.classList.contains("active")) {
                link.classList.remove("active")
            }
        }
        navDashboard.classList.add("active");
    </script>
    <script>
    const myNavsignOut = document.getElementById("myNavsignOut").addEventListener("click", () => {
        $.ajax({
            type: "GET",
            url: "./../logout",
            success: response => {
                window.location.replace("login");
            },
            error: error => {

            }
        })
    });
</script>
</body>

</html>