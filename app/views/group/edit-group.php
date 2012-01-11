<div class="block">

    <?php if (!empty($errorMessage)) : ?>
    <div class="message errormsg">
        <?php echo $errorMessage ?>
    </div>
    <?php endif ?>

    <div class="block_head">
        <h2>Edit Group</h2>
    </div>

    <div class="block_content">

        <form action="" method="POST">

            <p>
                <label for="associated_name">
                    Group Name: <span class="required">*</span>
                </label>

                <input id="associated_name" type="text" name="associated_name" class="text small"
                       value= "<?php echo set_value('associated_name', $groups['associated_name']) ?>" /><br />
                <span class='note error'>
                    <?php echo form_error('associated_name') ?>
                </span>
            </p>

            <p>
                <label for="print_title">
                    Printing Title: <span class="required">*</span>
                </label>

                <input id="print_title" type="text" name="print_title" class="text small"
                       value= "<?php echo set_value('print_title', $groups['print_title']) ?>" /><br />
                <span class='note error'>
                    <?php echo form_error('print_title') ?>
                </span>
            </p>


            <p>
                <input type="submit" value="Update" class="submit small" />
                <input type="button" value ="Exit" class="submit small"
                       onClick = "window.location='<?php echo site_url('group') ?>'" />
            </p>

        </form>

    </div>		<!-- .block_content ends -->
</div>		<!-- .block ends -->