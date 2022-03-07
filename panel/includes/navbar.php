<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Account)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <div class="sidenav-menu-heading d-sm-none">Account</div>
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Core</div>
            <!-- Sidenav Accordion (Dashboard)-->
            <a class="nav-link active" href="index" id="navDashboard">
                <div class="nav-link-icon"><i class="fas fa-fw fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <!-- Sidenav Heading (Data Entry)-->
            <div class="sidenav-menu-heading">Data Management</div>
            <!-- Sidenav Accordion (daily report)-->
            <a class="nav-link active" href="goals" id="navGoals">
                <div class="nav-link-icon"><i class="fas fa-bullseye"></i></div>
                Goals
            </a>
            <!-- Sidenav Accordion (Layout)-->
            <a class="nav-link" href="activity_report_form" id="navActivityReportForm">
                <div class="nav-link-icon"><i class="fas fa-edit"></i></div>
                Activity Report Form
            </a>
            <!-- Sidenav Accordion (Layout)-->
            <a class="nav-link" href="activity_reports" id="navActivityReports">
                <div class="nav-link-icon"><i class="fas fa-table"></i></div>
                Activity Reports
            </a>
            <!-- Sidenav Accordion (Layout)-->
            <a class="nav-link" href="users" id="navReports" hidden>
                <div class="nav-link-icon"><i class="fas fa-file-excel"></i></div>
                Reports
            </a>
            <!-- Sidenav Heading (UI Toolkit)-->
            <div class="sidenav-menu-heading">Admin Privileges</div>
            <!-- Sidenav Accordion (Layout)-->
            <a class="nav-link" href="users" id="navUsers">
                <div class="nav-link-icon"><i class="fas fa-users"></i></div>
                Users
            </a>
            <!-- <a class="nav-link" href="#" id="navUserCat">
                <div class="nav-link-icon"><i class="fas fa-cog fa-spin"></i></div>
                User Categories
            </a> -->
            <a class="nav-link" href="#" id="navSignOut">
                <div class="nav-link-icon"><i class="fa fa-sign-out-alt"></i></div>
                Sign Out
            </a>
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title" id="usernameDisplay"><?php echo $user->name; ?></div>
        </div>
    </div>
</nav>

<script src="vendor/jquery/jquery.min.js" crossorigin="anonymous"></script>
<script>
    const navSignOut = document.getElementById("navSignOut");
    navSignOut.addEventListener("click", () => {
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

<script src="js/feather.min.js" crossorigin="anonymous"></script>