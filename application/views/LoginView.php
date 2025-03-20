<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="icon" href="<?= base_url() ?>assets/image/xtrackr-icon.png">
    <!-- MDBootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/mdb/css/mdb.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        .blur-overlay {
            position: fixed;
            top: 0lk;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="blur-overlay" id="blurOverlay">Loading...</div>
    <section class="vh-100">
        <div class="container-fluid h-custom" style="height: 88%;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <center>
                        <img src="<?= base_url() ?>assets/image/xtrackr-logo.png"
                            class="img-fluid" alt="Sample image">
                        <br>
                        <h4>
                            Tool Management System
                        </h4>
                    </center>
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="#" id="loginForm" method="POST" enctype="multipart/form-data">
                        <center>
                            <h3>Login User</h3>
                        </center>
                        <br>
                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" required />
                            <label class="form-label" for="form3Example3">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" required />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button id="loginBtn" type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!"
                                    class="link-danger">Register</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Copyright © 2020. All rights reserved.
            </div>
            <!-- Copyright -->

            <!-- Right -->
            <div>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#!" class="text-white">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            <!-- Right -->
        </div>
    </section>
    <!-- MDBootstrap JS -->
    <script type="text/javascript" src="<?= base_url() ?>assets/mdb/js/mdb.umd.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cdn_file/js/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        var base_url = "<?= base_url() ?>";
        $(document).ready(function() {
            $("#loginForm").submit(function(event) {
                event.preventDefault();
                $("#loginBtn").prop("disabled", true);
                $("#blurOverlay").show();
                $.ajax({
                    url: base_url + "auth-user",
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(r) {
                        $("#blurOverlay").hide();
                        console.log(r);
                        if (r.code == 200) {
                            toast_mssg(r.result, "linear-gradient(to right,rgb(83, 201, 89),rgb(49, 199, 56))");
                            setTimeout(() => {
                                toast_mssg("Redirecting...", "linear-gradient(to right,rgb(83, 201, 89),rgb(49, 199, 56))");
                                window.location.href = base_url + "main-view";
                            }, 1000);
                            
                            // window.location.href = base_url + "main-view";
                        } else {
                            $("#loginBtn").prop("disabled", false);
                            toast_mssg(r.result, "linear-gradient(to right,rgb(251, 141, 141),rgb(251, 99, 85))");
                        }
                    }
                });
            });

            function toast_mssg(mssg,color) {
                Toastify({
                    text: mssg,
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: color,
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
            }
        });
    </script>
</body>

</html>