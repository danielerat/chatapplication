<?php

require_once("private/initialize.php");
require_once("header.php");

//If user is logged in , redirect him to the home page 
if (is_logged_in()) {
    redirect_to('chat.php');
}

$username = '';
$password = '';

?>
<pre>
<?php


echo  display_session_authErrors();

echo display_errors($errors);

echo display_session_message();

?>
</pre>
<style>
    .avoidclicks {
        pointer-events: none;
    }
</style>
<div class="main">
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container animate__animated">
            <div class="signin-content">
                <div class="signin-image animate__animated ">
                    <figure><img src="assets/images/login-image.svg" alt="sing up image"></figure>
                    <a href="register.php" class="signup-image-link">Create an account</a>
                </div>
                <div class="signin-form animate__animated ">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" id="login-form" action="aut_log.php">
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" class="inputauth" name="username" value="<?php echo $username; ?>" id="your_name" placeholder="Your Name" />
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" class="inputauth" name="password" value="<?php echo $password; ?>" id="your_pass" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" checked />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit " value="Log in" />
                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    var button = document.querySelector("#signin");

    function disableSubmitButton() {
        button.disabled = true;
        button.style.backgroundColor = "grey";

        button.value = 'Authenticationg...';
    }

    function enableSubmitButton() {
        button.disabled = false;
        button.style.backgroundColor = "rgb(250, 50, 50 )";
        button.value = 'Login in';
        button.classList.remove("avoidclicks");
    }

    function displayErrors(errors) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showCloseButton: true,
            showConfirmButton: false,

            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'error',
            title: 'Unknown Username Or Password'
        })
    }

    function successlogin() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: 'Signed in successfully'
        }).then(function() {
            window.location = "chat.php";
        });
        // Disappearing Effect 
        $toremove1 = document.querySelector(".signin-content .signin-image");
        $toremove2 = document.querySelector(".signin-content .signin-form");
        $toremove3 = document.querySelector(".container");
        $toremove1.classList.add("animate__fadeOutLeft");
        $toremove2.classList.add("animate__fadeOutRight");
        $toremove3.classList.add("animate__fadeOut");
    }




    function calculateMeasurements() {
        disableSubmitButton();
        var form = document.querySelector("#login-form");
        var action = form.getAttribute("action");
        // gather form data
        var form_data = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText;
                console.log('Result: ' + result);
                var json = JSON.parse(result);
                if (json.hasOwnProperty('Errors') && json.Errors.length > 0) {
                    displayErrors(json.Errors);
                    enableSubmitButton();

                } else {
                    enableSubmitButton();
                    successlogin();
                }
            }
        };
        xhr.send(form_data);
    }

    button.addEventListener("click", function(event) {
        event.preventDefault();
        calculateMeasurements();
    });
</script>



<script src="assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
</body>

</html>