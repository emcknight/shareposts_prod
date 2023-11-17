<?php require APPROOT . '/views/inc/header.php';?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Create An Account</h2>
                <p>Please fill out this form to register with us.</p>
                <form action="<?php echo URLROOT; ?>/users/register" method="post">
                    <div class="form-group">
                        <label for="name"> Name: <sup>*</sup></label>
                        <input type="text" name="name" class="form-control formcontrol-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email"> Email: <sup>*</sup></label>
                        <input type="text" name="email" class="form-control formcontrol-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="pass"> Password: <sup>*</sup></label>
                        <input type="password" name="pass" class="form-control formcontrol-lg <?php echo (!empty($data['pass_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['pass']; ?>">
                        <span class="invalid-feedback"><?php echo $data['pass_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_pass"> Confirm Password: <sup>*</sup></label>
                        <input type="password" name="confirm_pass" class="form-control formcontrol-lg <?php echo (!empty($data['confirm_pass_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['confirm_pass']; ?>">
                        <span class="invalid-feedback"><?php echo $data['confirm_pass_err']; ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Register" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account already?<br>Click Here</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php';?>