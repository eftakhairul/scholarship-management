<div class="block">

    <?php if (!empty($errorMessage)) : ?>
        <div class="message errormsg">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif ?>

    <div class="block_head">
        <h2>Create New Event</h2>
    </div>

    <div class="block_content">
        
        <form action="" method="POST">

            <p>
                <label for="date">
                    Date: <span class="required">*</span>
                </label>

                <input id="date" type="text" name="date" class="text date_picker" value= "<?php echo set_value('date')?>" />
                <input id='is_date_not_confirmed' type="checkbox" name='is_date_not_confirmed' <?php echo ($this->input->post('is_date_not_confirmed')) ? 'checked="checked"' : '' ?> > Not Confirmed<br />
                <span class='note error'>
                    <?php echo form_error('date') ?>
                </span>
            </p>

             <p>
                <label for="time">
                   Time: <span class="required">*</span>
                </label>

                <input id="time" type="text" name="time" class="text small" value= "<?php echo set_value('time')?>" />
                <input id ='is_time_not_confirmed' type="checkbox" name='is_time_not_confirmed' <?php echo ($this->input->post('is_time_not_confirmed')) ? 'checked="checked"' : '' ?> > Not Confirmed<br/>
                <span class='note error'>
                    <?php echo form_error('time') ?>
                </span>
            </p>

            <p>
                <label for="venue">
                   Venue: <span class="required">*</span>
                </label>

                <input id="venue" type="text" name="venue" class="text" value= "<?php echo set_value('venue')?>" />

                <br />
                <span class='note error'>
                    <?php echo form_error('venue') ?>
                </span>
            </p>

            <p>
                <label for="title">
                    Event Name: <span class="required">*</span>
                </label>

                <input id="title" type="text" name="title" class="text"
                       value= "<?php echo set_value('title') ?>" /><br />
                <span class='note error'>
                    <?php echo form_error('title') ?>
                </span>
            </p>

            <p>
                <label for="grace_status_id">
                    To Grace As: <span class="required">*</span>
                </label>

                <select id="grace_status_id" name="grace_status_id" class="styled">
                    <option value=''>- Select -</option>

                    <?php foreach ($this->config->item('grace') as $key => $row) : ?>
                        <option value="<?php echo $key ?>"
                            <?php echo set_select('grace_status_id', $key) ?> >
                            <?php echo $row ?></option>
                    <?php endforeach ?>

                </select>
                <span class='note error'>
                    <?php echo form_error('grace_status_id') ?>
                </span>
            </p>

            <p>
                <label for="description">
                    Other Details: 
                </label>

                <textarea id="description" rows="5" cols="50" name="description"
                          class="wysiwyg"><?php echo set_value('description') ?></textarea> <br/>
                <span class='note error'>
                    <?php echo form_error('description') ?>
                </span>
            </p>

<!--            <p>-->
<!--                <label for="status_id">-->
<!--                    Status:-->
<!---->
<!--                </label>-->
<!---->
<!--                <select id="status_id" name="status_id" class="styled">-->
<!---->
<!--                    --><?php //foreach ($statuses AS $row) : ?>
                        <option value="<?php //echo $row['status_id'] ?>"
                            <?php //echo set_select('status', $row['status_id']) ?>>
                            <?php //echo ucfirst($row['title']) ?></option>
                    <?php //endforeach ?>
<!---->
<!--                </select>-->
<!--                <span class='note error'>-->
<!--                    --><?php //echo form_error('status_id') ?>
<!--                </span>-->
<!--            </p>-->

            <p>
                <input type="submit" value="Save" id="submit-event" class="submit small" />
                <input type="button" value="Cancel" id="submit-cancel" class="submit small" />
            </p>

        </form>

    </div>		<!-- .block_content ends -->
</div>		<!-- .block ends -->


<link type="text/css" rel="stylesheet" href="<?php echo site_url('assets/time/css/jquery-ui-1.8.14.custom.css') ?>"  />
<link type="text/css" rel="stylesheet" href="<?php echo site_url('assets/time/css/jquery-ui-timepicker.css') ?>"/>

<script type="text/javascript" src="<?php echo site_url('assets/time/js/jquery.ui.core.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/time/js/jquery.ui.timepicker.js') ?>"></script>

<script type="text/javascript">

    $(function(){

       $('#time').timepicker({
            showPeriod: true,
            showLeadingZero: true
        });

        $('#submit-cancel').click(function(){
            window.location = '/schedule/';

        });

       $('#is_time_not_confirmed').click(function(){
           $('#time').val('00:00');

       });



    });

</script>