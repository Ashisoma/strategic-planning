
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>CHS Strategy | Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="images/ravelry-logo.png" />
        <script data-search-pseudo-elements defer src="vendor/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
        <script src="js/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <!-- Basic login form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <!-- Login form-->
                                        <form>
                                            <!-- Form Group (email address)-->
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter email address" required/>
                                            </div>
                                            <!-- Form Group (password)-->
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Enter password" required/>
                                            </div>
                                            <!-- Form Group (remember password checkbox)-->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <!-- Form Group (login box)-->
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="#" id="forgotPasswordBtn">Forgot Password?</a>
                                                <a class="btn btn-primary" id="btnLogin">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register">Haven't Activated your Account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="footer mt-auto footer-dark">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &#xA9; Centre for Health Solutions-Kenya 2022</div>
                            <div class="col-md-6 text-md-right small">
                                <a href="#!">Privacy Policy</a>
                                &#xB7;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js" crossorigin="anonymous"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

        <script src="js/sb-customizer.js"></script>
        <script>
            const inputEmailAddress = document.getElementById("inputEmailAddress");
            const inputPassword = document.getElementById("inputPassword");
            document.getElementById("btnLogin").addEventListener("click", ()=>{
                let email = inputEmailAddress.value.trim();
                let password  = inputPassword.value;
                $.ajax({
                    type:"POST",
                    url:"login_request",
                    data:{
                        email : email,
                        password : password
                    },
                    success: (response)=>{
                        let mResponse = JSON.parse(response);
                        console.log(mResponse);
                        if (mResponse.code == 200) {
                            sessionStorage.setItem("user", JSON.stringify(mResponse.data));
                            window.location.replace("index");
                        } else {
                            window.alert("Check your credentials and try again.");
                        }
                    },
                    error: error =>{
                        window.alert("Unable to login.");
                    }
                });
            });

            document.getElementById("forgotPasswordBtn").addEventListener("click", ()=>{
                let email = inputEmailAddress.value.trim();
                // let password  = inputPassword.value;
                if (email == "") {
                    window.alert("Check your credentials and try again.");
                }
                else{
                    $.ajax({
                        type: "POST",
                        url:"password_reset",
                        data:{
                            email:email,        
                        },
                        success: (response) => {
                            // let mResponse = JSON.parse(response);
                            // console.log(mResponse);
                            if(response.code = 200){
                                // console.log(mResponse.data);
                                window.location.replace("forgot_password.php");
                             }else {
                            window.alert("Something went wrong. Please try again.");
                        }
                        
                        },
                    
                    })
                }
            })
        </script>
    </body>
</html>
