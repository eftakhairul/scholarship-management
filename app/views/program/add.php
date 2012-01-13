<div class="block">

    <?php if (!empty($errorMessage)) : ?>
        <div class="message errormsg">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif ?>

    <div class="block_head">
        <h2>Add New Tuition Fees</h2>
    </div>

    <div class="block_content">
        
        <form action="" method="POST">

            <p>
               <label for="department_name">
                   Department: <span class="required">*</span>
               </label>

               <select id="department_name" name="department_name" class="styled">
                   <option value=''>- Select Department -</option>

                   <?php foreach ($departments AS $row) : ?>
                       <option value="<?php echo $row['department_name'] ?>"
                           <?php echo set_select('department_name', $row['department_name']) ?> >
                           <?php echo $row['department_name'] ?></option>
                   <?php endforeach ?>

               </select>
               <span class='note error'>
                   <?php echo form_error('department_name') ?>
               </span>
           </p>

            <p>
                <label for="title">
                   Program Name: <span class="required">*</span>
                </label>

                <input id="title" type="text mini" name="name" class="text" value= "<?php echo set_value('name')?>" />

                <br />
                <span class='note error'>
                    <?php echo form_error('name'); ?>
                </span>
            </p>

            <p>
                <label for="lowest_credits">
                   Lowest Credits: <span class="required">*</span>
                </label>

                <input id="lowest_credits" type="text mini" name="lowest_credits" class="text" value= "<?php echo set_value('lowest_credits')?>" />

                <br />
                <span class='note error'>
                    <?php echo form_error('lowest_credits'); ?>
                </span>
            </p>

            <p>
                <label for="code">
                   Program Code: <span class="required">*</span>
                </label>

                <input id="code" type="text mini" name="code" class="text" value= "<?php echo set_value('code')?>" />

                <br />
                <span class='note error'>
                    <?php echo form_error('code'); ?>
                </span>
            </p>

            <p>
                <input type="submit" value="Save" id="submit-event" class="submit small" />
                <input type="button" value="Cancel" id="submit-cancel" class="submit small" />
            </p>

        </form>

    </div>              <!-- .block_content ends -->
</div>          <!-- .block ends -->



<script type="text/javascript">

    $(function(){

        $('#submit-cancel').click(function(){
            window.location = '/program';
        });
    });

</script>