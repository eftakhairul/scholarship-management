<div class="block">

    <?php if (!empty($errorMessage)) : ?>
        <div class="message errormsg">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif ?>

    <div class="block_head">
        <h2>Create New Program</h2>
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
                <label for="year">
                    Year: <span class="required">*</span>
                </label>

                <select id="year" name="year" class="styled">
                    <option value=''>- Select Year -</option>
                    <?php foreach ($this->config->item('years') as $row) : ?>
                        <option value="<?php echo $row ?>"
                            <?php echo set_select('year', $row) ?> >
                            <?php echo $row ?></option>
                    <?php endforeach ?>
                </select>

                <span class='note error'>
                    <?php echo form_error('year'); ?>
                </span>
            </p>


           <p>
                <label for="semester_id">
                    Semester: <span class="required">*</span>
                </label>

                <select id="semester_id" name="semester_id" class="styled">
                    <option value=''>- Select Semester -</option>
                    <?php foreach ($this->config->item('semesters') as $key => $row) : ?>
                        <option value="<?php echo $key ?>"
                            <?php echo set_select('semester_id', $key) ?> >
                            <?php echo $row ?></option>
                    <?php endforeach ?>
                </select>

                <span class='note error'>
                    <?php echo form_error('semester_id') ?>
                </span>
            </p>

            <p>
                <label for="sex">
                    Sex: <span class="required">*</span>
                </label>

                <select id="sex" name="sex" class="styled">
                        <option value="1" > Male</option>
                        <option value="2" > Female</option>
                </select>
            </p>

            <p>
                <label for="credit_fees">
                   Credit Fees: <span class="required">*</span>
                </label>

                <input id="title" type="text mini" name="credit_fees" class="text" value= "<?php echo set_value('credit_fees')?>" />

                <br />
                <span class='note error'>
                    <?php echo form_error('credit_fees'); ?>
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
            window.location = '/tuition';
        });
    });

</script>