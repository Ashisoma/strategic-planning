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
    <title>CHS Strategy | Users</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="css/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="images/favicon.png" />
    <script data-search-pseudo-elements defer src="vendor/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="js/feather.min.js" crossorigin="anonymous"></script>

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
</head>

<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <a class="navbar-brand" href="index.php">
            <img src="images/favicon3.png" alt="icon">CHS STRATEGIC PLAN<br>
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
                                        <div class="page-header-icon"><i class="fas fa-users"></i></div>
                                        Reports
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main page content-->
                <div class="container mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="float-right form-row">
                                <button class="btn btn-primary ml-auto" id="btnReportExcel">
                                    <span class="icon text-white-70 mr-2">
                                        <i class="fas fa-file-excel"></i>
                                    </span>
                                    <span class="text"> Generate Report </span>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="datatable">
                                <table class="table table-bordered table-hover" id="reportsDataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Activity</th>
                                            <th>Dates</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>User</th>
                                            <th>Activity</th>
                                            <th>Dates</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Joseph Kimani</td>
                                            <td>Update the existing HR policy to be in tandem with the existing and future trends.</td>
                                            <td>2021-05-20 to 2021-06-02 </td>
                                            <td>
                                                <div class="badge badge-primary badge-pill">Reviewed</div>
                                            </td>
                                            <td>
                                                <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2" data-tooltip="tooltip" title="View this report"><i data-feather="eye"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/app.js"></script>
    <script src="js/activity_reports.js"></script>
    <script src="js/sb-customizer.js"></script>
    <script>
        let navActivityReports = document.getElementById("navActivityReports");
        let accordionSidenav = document.getElementById("accordionSidenav")
        let links = accordionSidenav.getElementsByTagName("a")
        for (let i = 0; i < links.length; i++) {
            let link = links[i]
            if (link.classList.contains("active")) {
                link.classList.remove("active")
            }
        }
        navActivityReports.classList.add("active");
    </script>
</body>

</html>