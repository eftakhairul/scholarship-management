<div class="block">
<?php if (!empty($errorMessage)) : ?>
   <div class="message errormsg">
       <?php echo $errorMessage ?>
   </div>
   <?php endif ?>

  <div class="block_head">
      <h2>New Applicant</h2>
  </div>

  <div class="block_content">

    <form enctype="multipart/form-data" action="" method="POST" >
        <fieldset>

            <legend>Student Information</legend>

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
               <label for="name">Student Name: <span style="color:red">*</span>
               </label>

               <input type="text" class="text small" name="name" value="<?php echo set_value('name'); ?>"/>
               <span class='note error'>
                  <?php echo form_error('name'); ?>
              </span>
           </p>

            <p>
               <label for="varsity_student_id">
                   Student Id: <span style="color:red">*</span>
               </label>

               <input type="text" class="text small" name="varsity_student_id" id = 'varsity_student_id' value="<?php echo set_value('varsity_student_id'); ?>"/>
               <span class='note error'>
                  <?php echo form_error('varsity_student_id'); ?>
              </span>
           </p>

            <p>
               <label for="contact_no">
                   Contact Number:
               </label>
               <input type="text" class="text small" name="contact_no" value="<?php echo set_value('contact_no'); ?>"/>
           </p>
         </fieldset>

          <fieldset>
              <legend>Academic Information</legend>

              <p>
                  <label for="last_semester_credit">
                      No. of Credits Taken in Last Semester: <span style="color:red">*</span>
                  </label>
                  <input type="text" class="text tiny" name="last_semester_credit" value="<?php echo set_value('last_semester_credit'); ?>" />
                  <span class='note error'>
                     <?php echo form_error('last_semester_credit'); ?>
                 </span>
              </p>

              <p>
                  <label for="current_semester_credit">
                      No. of Credits Taken in Current Semester: <span style="color:red">*</span>
                  </label>
                  <input type="text" class="text tiny" name="current_semester_credit" value="<?php echo set_value('current_semester_credit'); ?>" />
                  <span class='note error'>
                     <?php echo form_error('current_semester_credit'); ?>
                 </span>
              </p>

              <p>
                  <label for="credit_requirement">
                      Credits Requirement for Degree: <span style="color:red">*</span>
                  </label>
                  <input type="text" class="text tiny" name="credit_requirement" value="<?php echo set_value('credit_requirement'); ?>" />
                  <span class='note error'>
                     <?php echo form_error('credit_requirement'); ?>
                 </span>
              </p>

              <p>
                  <label for="credit_completed">
                      No. Credits Completed to date: <span style="color:red">*</span>
                  </label>
                  <input type="text" class="text tiny" name="last_semester_credit" value="<?php echo set_value('credit_completed'); ?>" />
                  <span class='note error'>
                     <?php echo form_error('credit_completed'); ?>
                 </span>
              </p>

              <p>
                  <label for="gpa">
                      GPA: <span style="color:red">*</span>
                  </label>
                  <input type="text" class="text tiny" name="gpa" value="<?php echo set_value('gpa'); ?>" />
                  <span class='note error'>
                     <?php echo form_error('gpa'); ?>
                 </span>
              </p>

              <p>
                  <label for="cgpa">
                      Current CGPA: <span style="color:red">*</span>
                  </label>
                  <input type="text" class="text tiny" name="cgpa" value="<?php echo set_value('cgpa'); ?>" />
                  <span class='note error'>
                     <?php echo form_error('cgpa'); ?>
                 </span>
              </p>

              <p>
                  <label for="retake">
                      Retake (If any):
                  </label>
                  <input type="text" class="text tiny" name="retake" value="<?php echo set_value('retake'); ?>" />
              </p>

              <p>
                  <label for="arch_lecture_credit">
                      Arch. Lecture Credits: <span style="color:red">*</span>
                  </label>
                  <input type="text" class="text tiny" name="arch_lecture_credit" value="<?php echo ((!empty($_POST['arch_lecture_credit']))? $_POST['arch_lecture_credit']: 0); ?>" />
                  <span class='note error'>
                     <?php echo form_error('arch_lecture_credit'); ?>
                 </span>
              </p>

              <p>
                  <label for="arch_studio_credit">
                      Current CGPA: <span style="color:red">*</span>
                  </label>
                  <input type="text" class="text tiny" name="arch_studio_credit" value="<?php echo ((!empty($_POST['arch_studio_credit']))? $_POST['arch_studio_credit']: 0); ?>" />
                  <span class='note error'>
                     <?php echo form_error('arch_studio_credit'); ?>
                 </span>
              </p>
          </fieldset>

      <p>
           <input type="submit" value="Submit" class="submit small" />
      </p>

    </form>

  </div>		<!-- .block_content ends -->
</div>		<!-- .block ends -->