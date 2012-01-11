<div class="block">

    <?php if (!empty($errorMessage)) : ?>
    <div class="message errormsg">
        <?php echo $errorMessage ?>
    </div>
    <?php endif ?>

    <div class="block_head">
        <h2>Edit User</h2>
    </div>

    <div class="block_content">

        <form action="<?php echo site_url('user/editUser') ?>" method="POST">

            <p>
                <label for="name">
                    Name: <span class="required">*</span>
                </label>

                <input id="name" type="text" name="name" class="text small"
                       value= "<?php echo set_value('name', $user['name']) ?>" /><br />
                <span class='note error'>
                    <?php echo form_error('name') ?>
                </span>
            </p>

            <p>
                <label for="email_address">Email Address:</label>
                <input id="email_address" type="text" name="email_address" class="text small"
                       value= "<?php echo set_value('email_address', $user['email_address']) ?>" /><br />
                <span class='note error'>
                    <?php echo form_error('email_address') ?>
                </span>
            </p>

            <p>
                <label for="username"> Username:
                </label>

                <input id="username" type="text" name="username" class="text small"
                       value= "<?php echo $user['username'] ?>" readonly="readonly" /><br />
                <span class='note error'>
                    <?php echo form_error('username') ?>
                </span>
            </p>


            <?php if($this->session->userdata('userType') == SUPER_ADMIN ) :?>
            <p>
                <label for="user_type_id">
                    Type: <span class="required">*</span>
                </label>

                <select id="user_type_id" name="user_type_id" class="styled">
                    <option value=''>- Select Type -</option>

                    <?php foreach ($types as $type) : ?>
                        <option value="<?php echo $type['user_type_id'] ?>"
                            <?php echo ($user['user_type_id'] == $type['user_type_id']) ? 'selected="selected"' : '' ?>>
                            <?php echo ucwords($type['title']) ?></option>
                    <?php endforeach ?>

                </select>
                <span class='note error'>
                    <?php echo form_error('user_type_id') ?>
                </span>
            </p>
            
             <p>
                <label for="group_id">
                    Associated Group: <span class="required">*</span>
                </label>

                <select id="group_id" name="group_id" class="styled">
                    <option value=''>- Select Group -</option>

                    <?php foreach ($groups as $group) : ?>

                        <?php if($group['group_id'] != 1):?>
                        <option value="<?php echo $group['group_id'] ?>"
                            <?php echo ($user['group_id'] == $group['group_id']) ? 'selected="selected"' : '' ?>>
                            <?php echo $group['associated_name'] ?></option>
                        <?php endif; ?>
                    <?php endforeach ?>

                </select>
                <span class='note error'>
                    <?php echo form_error('group_id') ?>
                </span>
            </p>    
            <?php endif;?>

            <p>
                <input type="hidden" name='user_id' value="<?php echo $user['user_id'] ?>" />
                <input type="submit" value="Update" class="submit small" />
                <input type="button" value ="Exit" class="submit small"
                       onClick = "window.location='<?php echo (($this->session->userdata('userType') == SUPER_ADMIN) ? site_url('user/manageUser') : site_url('schedule'));  ?>'" />
            </p>

        </form>

    </div>		<!-- .block_content ends -->
</div>		<!-- .block ends -->