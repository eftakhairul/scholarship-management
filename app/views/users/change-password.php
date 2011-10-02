<div class="block">

    <?php if (!empty($errorMessage)) : ?>
    <div class="message errormsg">
        <?php echo $errorMessage ?>
    </div>
    <?php endif ?>

    <div class="block_head">
        <h2>Change Password</h2>
        <ul>
            <a href="<?php echo site_url('user/editUser/id').'/'.$this->session->userdata('user_id')?>" >Edit Profile</a>
        </ul>
    </div>

    <div class="block_content">

        <form action="" method="POST">
            <p>
                <label for="password">
                    Password: <span class="required">*</span>
                </label>

                <input id="password" type="password" name="password" class="text small"
                       value= "<?php echo set_value('password') ?>" /><br />
                <span class='note error'>
                    <?php echo form_error('password') ?>
                </span>
            </p>

            <p>
                <label for="confirmedPassword">
                    Confirmed Password: <span class="required">*</span>
                </label>

                <input id="confirmedPassword" type="password" name="confirmedPassword"
                       class="text small" value= "<?php echo set_value('confirmedPassword') ?>" /><br />
                <span class='note error'>
                    <?php echo form_error('confirmedPassword') ?>
                </span>
            </p>

            <p>
                <input type="hidden" name='user_id' value="<?php echo $user['user_id'] ?>" />
                <input type="submit" value="Update" class="submit small" />
                <input type="button" value ="Exit" class="submit small"
                       onClick = "window.location='<?php echo site_url('schedule') ?>'" />
            </p>

        </form>

    </div>		<!-- .block_content ends -->
</div>		<!-- .block ends -->

