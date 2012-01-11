<div class="block">

    <?php if (!empty($errorMessage)) : ?>
    <div class="message errormsg">
        <?php echo $errorMessage ?>
    </div>
    <?php endif ?>

    <div class="block_head">
        <h2>Change Password</h2>
    </div>

    <div class="block_content">

        <form action="" method="POST">

            <p>
                <label for="previous_password">
                    Previous Password: <span class="required">*</span>
                </label>

                <input id="previous_password" type="text" name="previous_password" class="text small"
                       value= "<?php echo set_value('previous_password') ?>" /><br />
                <span class='note error'>
                    <?php echo form_error('previous_password') ?>
                </span>
            </p>

            <p>
                <label for="password">
                    Password: <span class="required">*</span>
                </label>

                <input id="password" type="text" name="password" class="text small"
                       value= "<?php echo set_value('password') ?>" /><br />
                <span class='note error'>
                    <?php echo form_error('password') ?>
                </span>
            </p>

            <p>
                <label for="confirmedPassword">
                    Confirmed Password: <span class="required">*</span>
                </label>

                <input id="confirmedPassword" type="text" name="confirmedPassword"
                       class="text small" value= "<?php echo set_value('confirmedPassword') ?>" /><br />
                <span class='note error'>
                    <?php echo form_error('confirmedPassword') ?>
                </span>
            </p>

            <p>
                <input type="submit" value="Update" class="submit small" />
                <input type="button" value ="Exit" class="submit small"
                       onClick = "window.location='<?php echo site_url('home') ?>'" />
            </p>

        </form>

    </div>		<!-- .block_content ends -->
</div>		<!-- .block ends -->
