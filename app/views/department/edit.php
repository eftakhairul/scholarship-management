<div class="block">

    <?php if (!empty($errorMessage)) : ?>
        <div class="message errormsg">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif ?>

    <div class="block_head">
        <h2>Edit Department</h2>
    </div>

    <div class="block_content">
        
        <form action="" method="POST">

            <p>
                <label for="title">
                   Title: <span class="required">*</span>
                </label>

                <input id="title" type="text" name="department_name" class="text" value= "<?php echo $department['department_name'] ?>" />

                <br />
                <span class='note error'>
                    <?php echo form_error('department_name') ?>
                </span>
            </p>

            <p>
                <input type="submit" value="Update" id="submit-event" class="submit small" />
                <input type="button" value="Cancel" id="submit-cancel" class="submit small" />
            </p>

        </form>

    </div>		<!-- .block_content ends -->
</div>		<!-- .block ends -->



<script type="text/javascript">

    $(function(){

        $('#submit-cancel').click(function(){
            window.location = '/department';

        });
    });
</script>