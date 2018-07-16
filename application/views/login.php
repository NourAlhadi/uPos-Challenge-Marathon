<!DOCTYPE html>
<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
<style>
    html, body * { box-sizing: border-box; font-family: 'Open Sans', sans-serif;}

    body {
        background-size: cover;

        margin: 0;
        background-color: #ecdbff;
    }

    .container {
        width: 100%;
        padding-top: 60px;
        padding-bottom: 100px;
    }

    .frame {
        height: 625px;
        width: 430px;
        background:
                linear-gradient(
                        rgba(35,43,85,0.75),
                        rgba(35,43,85,0.95)),
                url(https://dl.dropboxusercontent.com/u/22006283/preview/codepen/clouds-cloudy-forest-mountain.jpg) no-repeat center center;
        background-size: cover;
        margin-left: auto;
        margin-right: auto;
        border-top: solid 1px rgba(255,255,255,.5);
        border-radius: 5px;
        box-shadow: 0px 2px 7px rgba(0,0,0,0.2);
        overflow: hidden;
        transition: all .5s ease;
    }

    .frame-long {
        height: 625px;
    }

    .frame-short {
        height: 400px;
        margin-top: 50px;
        box-shadow: 0px 2px 7px rgba(0,0,0,0.1);
    }

    .nav {
        width: 100%;
        height: 100px;
        padding-top: 40px;
        opacity: 1;
        transition: all .5s ease;
    }

    .nav-up {
        transform: translateY(-100px);
        opacity: 0;
    }

    li {
        padding-left: 10px;
        font-size: 18px;
        display: inline;
        text-align: left;
        text-transform: uppercase;
        padding-right: 10px;
        color: #ffffff;
    }



    .signin-active a {
        padding-bottom: 10px;
        color: #ffffff;
        text-decoration: none;
        border-bottom: solid 2px #1059FF;
        transition: all .25s ease;
        cursor: pointer;
    }
    .signin-inactive a {
        padding-bottom: 0;
        color: rgba(255,255,255,.3);
        text-decoration: none;
        border-bottom: none;
        cursor: pointer;
    }


    .signup-inactive a {
        cursor: pointer;
        color: rgba(255,255,255,.3);
        text-decoration: none;
        transition: all .25s ease;
    }

    .signup-active a {
        cursor: pointer;
        color: #ffffff;
        text-decoration: none;
        border-bottom: solid 2px #1059FF;
        padding-bottom: 10px;
    }


    .form-signin {
        width: 430px;
        height: 375px;
        font-size: 16px;
        font-weight: 300;
        padding-left: 37px;
        padding-right: 37px;
        padding-top: 55px;
        transition: opacity .5s ease, transform .5s ease;
    }

    .form-signin-left {
        transform: translateX(-400px);
        opacity: .0;
    }

    .form-signup {
        width: 430px;
        height: 375px;
        font-size: 16px;
        font-weight: 300;
        padding-left: 37px;
        padding-right: 37px;
        padding-top: 55px;
        position: relative;
        top: -400px;
        left: 400px;
        opacity: 0;
        transition: all .5s ease;
    }

    .form-signup-left {
        transform: translateX(-399px);
        opacity: 1;
    }

    .form-signup-down {
        top: 0px;
        opacity: 0;
    }

    #check path {
        stroke: #ffffff;
        stroke-linecap:round;
        stroke-linejoin:round;
        stroke-width: .85px;
        stroke-dasharray: 60px 300px;
        stroke-dashoffset: -166px;
        fill: rgba(255,255,255,.0);
        transition: stroke-dashoffset 2s ease .5s, fill 1.5s ease 1.0s;
    }

    #check.checked path {
        stroke-dashoffset: 33px;
        fill: rgba(255,255,255,.03);
    }

    .form-signin input, .form-signup input {
        color: #ffffff;
        font-size: 13px;
    }

    .form-styling {
        width: 100%;
        height: 35px;
        padding-left: 15px;
        border: none;
        border-radius: 20px;
        margin-bottom: 20px;
        background: rgba(255,255,255,.2);
    }

    label {
        font-weight: 400;
        text-transform: uppercase;
        font-size: 13px;
        padding-left: 15px;
        padding-bottom: 10px;
        color: rgba(255,255,255,.7);
        display: block;
    }

    :focus {outline: none;
    }

    .form-signin input:focus, textarea:focus, .form-signup input:focus, textarea:focus {
        background: rgba(255,255,255,.3);
        border: none;
        padding-right: 40px;
        transition: background .5s ease;
    }

    [type="checkbox"]:not(:checked),
    [type="checkbox"]:checked {
        position: absolute;
        display: none;
    }

    [type="checkbox"]:not(:checked) + label,
    [type="checkbox"]:checked + label {
        position: relative;
        padding-left: 85px;
        padding-top: 2px;
        cursor: pointer;
        margin-top: 8px;
    }

    [type="checkbox"]:not(:checked) + label:before,
    [type="checkbox"]:checked + label:before,
    [type="checkbox"]:not(:checked) + label:after,
    [type="checkbox"]:checked + label:after {
        content: '';
        position: absolute;
    }

    [type="checkbox"]:not(:checked) + label:before,
    [type="checkbox"]:checked + label:before {
        width: 65px;
        height: 30px;
        background: rgba(255,255,255,.2);
        border-radius: 15px;
        left: 0;
        top: -3px;
        transition: all .2s ease;
    }

    [type="checkbox"]:not(:checked) + label:after,
    [type="checkbox"]:checked + label:after {
        width: 10px;
        height: 10px;
        background: rgba(255,255,255,.7);
        border-radius: 50%;
        top: 7px;
        left: 10px;
        transition: all .2s ease;
    }

    /* on checked */
    [type="checkbox"]:checked + label:before {
        background: #0F4FE6;
    }

    [type="checkbox"]:checked + label:after {
        background: #ffffff;
        top: 7px;
        left: 45px;
    }

    [type="checkbox"]:checked + label .ui,
    [type="checkbox"]:not(:checked) + label .ui:before,
    [type="checkbox"]:checked + label .ui:after {
        position: absolute;
        left: 6px;
        width: 65px;
        border-radius: 15px;
        font-size: 14px;
        font-weight: bold;
        line-height: 22px;
        transition: all .2s ease;
    }

    [type="checkbox"]:not(:checked) + label .ui:before {
        content: "no";
        left: 32px;
        color: rgba(255,255,255,.7);
    }

    [type="checkbox"]:checked + label .ui:after {
        content: "yes";
        color: #ffffff;
    }

    [type="checkbox"]:focus + label:before {
        box-sizing: border-box;
        margin-top: -1px;
    }

    .btn-signup {
        float: left;
        width: 100%;
        height: 35px;
        border: none;
        border-radius: 20px;
        margin-top: 23px;
        margin-bottom: 40px!important;
        color: #ffffff;
        background-color: #1059FF;
    }

    .btn-signin {
        float: left;
        width: 100%;
        height: 35px;
        border: none;
        border-radius: 20px;
        margin-top: -8px;
        color: #fff;
        background-color: #1059FF;

    }

    .btn-animate {
        float: left;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
        text-align: center;
        color: rgba(255,255,255, 1);
        padding-top: 8px;
        width: 100%;
        height: 35px;
        border: none;
        border-radius: 20px;
        margin-top: 23px;
        background-color: rgba(16,89,255, 1);
        left: 0px;
        top: 0px;
        transition: all .5s ease, top .5s ease .5s, height .5s ease .5s, background-color .5s ease .75s;
    }


    button.btn-signup:hover, button.btn-signin:hover {
        cursor: pointer;
        background-color: #0F4FE6;
        transition: background-color .5s;
    }

    .forgot {
        height: 100px;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        padding-top: 24px;
        margin-top: -535px;
        border-top: solid 1px rgba(255,255,255,.3);
        transition: all 0.5s ease;
    }

    .forgot-left {
        transform: translateX(-400px);
        opacity: 0;
    }

    .forgot-fade {
        opacity: 0;
    }

    .forgot a {
        color: rgba(255,255,255,.3);
        font-weight: 400;
        font-size: 13px;
        text-decoration: none;
    }

    h1 {
        color: #ffffff;
        font-size: 35px;
        font-weight: 300;
        text-align: center;
    }

    .alert
    {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }


    .alert-danger
    {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }

    .alert-info
    {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1;
    }


</style>

</head>
<body>
<div class="container">
    <?php if ( isset($_SESSION['register_message']) ): ?>
        <div class="row">
            <?php if(strpos($_SESSION['register_message'],'Error') !== false): ?>
                <div class="col-sm-4 col-sm-offset-4 alert alert-danger"><?php echo $_SESSION['register_message'];?></div>
            <?php else: ?>
                <div class="col-sm-4 col-sm-offset-4 alert alert-info"><?php echo $_SESSION['register_message'];?></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="frame">
        <div class="nav">
            <ul class="links">
            <li class="signin-active"><a class="btn">Sign in</a></li>
            <li class="signup-inactive"><a class="btn">Sign up </a></li>
            </ul>
        </div>
        <div>
            <form class="form-signin" action="<?php echo base_url(); ?>/login" method="post" name="form" enctype="multipart/form-data">
                <label for="username">Username</label>
                <input class="form-styling" type="text" name="username" placeholder="Username" required/>
                <label for="password">Password</label>
                <input class="form-styling" type="password" name="password" placeholder="Password" required/>
                <input type="checkbox" name="remember" id="checkbox"/>
                <label for="checkbox" ><span class="ui"></span>Keep me signed in</label>
                <div class="btn-animate">
                    <button type="submit" name="signin" class="btn-signin">Sign In</button>
                </div>
            </form>

            <form class="form-signup" action="" method="post" name="form" enctype="multipart/form-data">
                <label for="fullname">Full name</label>
                <input class="form-styling" type="text" name="fullname" placeholder="Full Name" required/>
                <label for="fullname">Username</label>
                <input class="form-styling" type="text" name="username" placeholder="Username" required/>
                <label for="email">Email</label>
                <input class="form-styling" type="text" name="email" placeholder="Email" required/>
                <label for="password">Password</label>
                <input class="form-styling" type="password" name="password" placeholder="Password" required/>
                <label for="confirmpassword">Confirm password</label>
                <input class="form-styling" type="password" name="confirmpassword" placeholder="Confirm Password" required/>
                <button type="submit" name="signup" class="btn-signup">Sign Up</button>
            </form>
            <br /><br /><br />
            <br /><br /><br />
            <div class="forgot">
                <a href="#">Forgot your password?</a>
            </div>
        </div>

    </div>

</div>

<script src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
<script>
    $(function() {
        $(".btn").click(function() {
            $(".form-signin").toggleClass("form-signin-left");
            $(".form-signup").toggleClass("form-signup-left");
            $(".frame").toggleClass("frame-long");
            $(".signup-inactive").toggleClass("signup-active");
            $(".signin-active").toggleClass("signin-inactive");
            $(".forgot").toggleClass("forgot-left");
            $(this).removeClass("idle").addClass("active");
        });
    });


</script>

</body>
</html>