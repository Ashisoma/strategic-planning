
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>CHS Strategy | Register</title>
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
                            <div class="col-lg-7">
                                <!-- Basic registration form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-10">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Reset your Password</h3></div>
                                    <div class="card-body">
                                        <!-- Registration form-->
                                        <form onsubmit="event.preventDefault();">
                                            <!-- Form Group (email address)            -->
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required/>
                                            </div>
                                            <!-- Form Row    -->
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <!-- Form Group (password)-->
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Password</label>
                                                        <input class="form-control" id="inputPassword" type="password" placeholder="Enter password" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- Form Group (confirm password)-->
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                        <input class="form-control" id="inputConfirmPassword" type="password" placeholder="Confirm password" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Form Group (create account submit)-->
                                            <div class="form-group mt-4 mb-0">
                                                <button class="btn btn-primary btn-block" id='btnRegister'>Password Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login">Back to login</a></div>
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
                            <div class="col-md-6 small">Copyright &#xA9; Centre for Health Solutions-Kenya 2021</div>
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
            const inputEmailAddress = document.getElementById('inputEmailAddress');
            const inputPassword = document.getElementById('inputPassword');
            const inputConfirmPassword = document.getElementById('inputConfirmPassword');

            document.getElementById('btnRegister').addEventListener('click', () => {
                let error = false;
                let email = inputEmailAddress.value;
                let password  = inputPassword.value;
                let confirmpassword  = inputConfirmPassword.value;

                if (confirmpassword !== password) {
                    error = true;
                    window.alert("Passwords do not match.");
                }

                if (error) {
                    console.log('error');
                } else {
                    $.ajax({
                        type:"POST",
                        url:"register_request",
                        data:{
                            email: email,
                            password: password
                        },
                        success: (response)=>{
                            let mResponse = JSON.parse(response);
                            if (mResponse.code == 200) {
                                
                                window.location.replace("login");
                            } else {
                                window.alert(mResponse.message);
                            }
                        },
                        error: error =>{
                            window.alert("Something went wrong. Please try again");
                        }
                    });
                }
            })

        </script>
    </body>
</html>
