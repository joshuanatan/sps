<form class="login100-form validate-form" action = "<?php echo base_url();?>login/signin" method="post">
    <span class="login100-form-title">
        Member Login
    </span>

    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
        <input class="input100" type="text" name="id" placeholder="ID">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-male" aria-hidden="true"></i>
        </span>
    </div>

    <div class="wrap-input100 validate-input" data-validate = "Password is required">
        <input class="input100" type="password" name="pass" placeholder="Password">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
    </div>

    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
            Login
        </button>
    </div>
    <div class="container-login100-form-btn">
        <button type = "button" onclick = 'window.location.href="<?php echo base_url();?>login/orangtua"' class="login100-form-btn">
            ORANG TUA
        </button>
    </div>

    <div class="text-center p-t-12">
        <span class="txt1">
        </span>
        <a class="txt2" href="#">
        </a>
    </div>

    <div class="text-center p-t-136">
        <a class="txt2" href="#">

        </a>
    </div>
</form>