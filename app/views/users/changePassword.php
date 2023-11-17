<?php require APPROOT . '/views/inc/header.php';?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Change your password</h2>
                <p>Please fill out this form to change your password.</p>
                <form action="<?php echo URLROOT; ?>/users/changePassword" method="post">
                <div class="form-group">
                        <label for="curr_pass"> Current Password: <sup>*</sup></label>
                        <input type="password" name="curr_pass" class="form-control formcontrol-lg <?php echo (!empty($data['curr_pass_err'])) ? 'is-invalid' : '';?>" value="">
                        <span class="invalid-feedback"><?php echo $data['curr_pass_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="new_pass"> New Password: <sup>*</sup></label>
                        <input type="password" name="new_pass" class="form-control formcontrol-lg <?php echo (!empty($data['new_pass_err'])) ? 'is-invalid' : '';?>" value="">
                        <span class="invalid-feedback"><?php echo $data['new_pass_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="confirm_new_pass"> Confirm New Password: <sup>*</sup></label>
                        <input type="password" name="confirm_new_pass" class="form-control formcontrol-lg <?php echo (!empty($data['confirm_new_pass_err'])) ? 'is-invalid' : '';?>" value="">
                        <span class="invalid-feedback"><?php echo $data['confirm_new_pass_err']; ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Submit" class="btn btn-success btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php';?>