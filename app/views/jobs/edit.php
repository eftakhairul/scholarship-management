<div class="block">

    <?php if (!empty($errorMessage)) : ?>
        <div class="message errormsg">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif ?>

    <div class="block_head">
        <h2>Create New Message</h2>
    </div>

    <div class="block_content">
        
        <form action="" method="POST">
            <p>
               <label for="types">
                   Job Types: <span class="required">*</span>
               </label>


               <select id="types" name="types" class="styled">
                   <option value=''>- Select -</option>
                   <optgroup label="ADMIN">
                       <?php foreach ($jobTypes AS $row) : ?>
                       <?php if( in_array($row['types'], array('parients care','accounts')) ):  ?>
                           <option value="<?php echo $row['types'] ?>"
                               <?php echo ((!empty($jobs['types']))? "selected = 'selected'":'' ) ?> >
                               <?php echo strtoupper($row['types']) ?>
                           </option>
                        <?php endif; ?>
                        <?php endforeach ?>
                   </optgroup>
                   <?php foreach ($jobTypes AS $row) : ?>
                   <?php if( !in_array($row['types'], array('parients care','accounts')) ):  ?>
                       <option value="<?php echo $row['types'] ?>"
                           <?php echo ((!empty($jobs['types']))? "selected = 'selected'":'' ) ?> >
                           <?php echo strtoupper($row['types']) ?></option>
                   <?php endif; ?>
                   <?php endforeach ?>
               </select>

               <span class='note error'>
                   <?php echo form_error('types') ?>
               </span>
           </p>

            <p>
                <label for="title">
                   Job Title: <span class="required">*</span>
                </label>

                <input id="title" type="text" name="title" class="text small" value= "<?php echo $jobs['title'] ?>" />

                <br />
                <span class='note error'>
                    <?php echo form_error('title') ?>
                </span>
            </p>

            <p>
                <label for="description">
                    Description: <span class="required">*</span>
                </label>

                <textarea id="description" name="description" rows="5" cols="50" class="wysiwyg" >
                    <?php echo $jobs['description'] ?>
                </textarea>
                <span class='note error'>
                    <?php echo form_error('description') ?>
                </span>
            </p>

            <p>
                <input type="submit" value="Save" id="submit-event" class="submit small" />
                <input type="button" value="Cancel" id="submit-cancel" class="submit small" />
            </p>

        </form>

    </div>		<!-- .block_content ends -->
</div>		<!-- .block ends -->


