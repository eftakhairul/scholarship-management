<div class="block">

    <div class="block_head">
        <h2>Events</h2>

        <form  method="POST" action="<?php echo site_url('schedule/pastschedule')?>" >

                Starting Date <input type="text" name="starting_date" class="text date_picker"
                       value="<?php  echo  ((!empty($_POST['starting_date']))? $_POST['starting_date']:'') ?>" />

                Ending Date <input type="text" name="ending_date" class="text date_picker"
                       value = "<?php echo  ((!empty($_POST['ending_date']))? $_POST['ending_date']:'')  ?>" />
            <input type ="submit" value ="Submit" />
        </form>

    </div> <!--.block_head ends -->
    
    <div class="block_content">

        <table cellpadding="0" cellspacing="0" width="100%">

            <thead>

                <tr>
                    <th class="centered" width="25%">Event Name</th>
                    <th class="centered" width="12%">Date</th>
                    <th class="centered" width="12%">Day</th>
                    <th class="centered" width="12%">Time</th>
                    <th class="centered" width="12%">Date & Time Confirmation</th>
                    <th class="centered" width="15%">Venue</th>
<!--                     --><?php //if ($userType == ADMIN): ?>
<!--                        <th class="centered" width="20%">Action</th>-->
<!--                     --><?php //endif ?>
                </tr>

            </thead>
            
            <tbody>

            <?php if (empty ($schedules)) : ?>
                
            <tr>
                <td colspan="6" class="nodatamsg">No event is available.</td>
            </tr>

            <?php else : foreach($schedules AS $schedule) : ?>
                
            <tr>
                <td><a href="<?php echo site_url("schedule/viewEvent/{$schedule['schedule_id']}") ?>" > <?php echo $schedule['title'] ?></a></td>
                <td class="centered"><?php echo DateHelper::mysqlToHuman($schedule['date']) ?></td>
                <td class="centered"><?php echo date('l', strtotime($schedule['date'])) ?></td>
                <td class="centered"><?php echo date("g:i a", STRTOTIME($schedule['time']))  ?></td>
                <td class="centered">
                    <input type="checkbox" disabled="disabled" <?php echo empty ($schedule['is_date_not_confirmed']) ? 'checked="checked"' : '' ?> />
                    <span style="min-width: 100px">&nbsp;&nbsp;&nbsp;</span>
                    <input type="checkbox" disabled="disabled" <?php echo empty ($schedule['is_time_not_confirmed']) ? 'checked="checked"' : '' ?> />
                </td>
                <td class="centered"><?php echo $schedule['venue'] ?></td>
                <?php if ($userType == ADMIN): ?>
<!--                <td class="action">-->
<!--                    <a href="--><?php //echo site_url("schedule/edit/{$schedule['schedule_id']}") ?><!--">Edit</a>-->
<!--                    --><?php //if (!empty ($flagForPrint)): ?>
<!--                    | <a href="--><?php //echo site_url("schedule/deleteEvent/id/{$schedule['schedule_id']}") ?><!--" id='delete'>Delete</a>-->
<!--                    --><?php //endif ?>
<!--                </td>-->
                <?php endif ?>
                
            </tr>

            <?php endforeach; endif ?>
                
            </tbody>
            
        </table>

        <div class="pagination right">
            <?php echo $this->pagination->create_links() ?>
        </div> <!--.pagination ends-->

    </div> <!--.block_content ends-->

</div> <!--.block ends-->