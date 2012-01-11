<div class="block">

    <div class="block_head">
        <h2>Events</h2>

        <?php if ($userType == ADMIN OR $userType == SUPER_ADMIN ): ?>

        <ul>
            <li><a href="<?php echo site_url('schedule/createSchedule') ?>">Create Event</a></li>
            <?php if (!empty ($flagForPrint)): ?>
            | <li><a href='<?php echo site_url('schedule/printSchedule') ?>'>Print Events</a></li>
            <?php endif ?>
        </ul>

        <?php endif ?>

        <?php if ($userType == SUPER_ADMIN): ?>

            <form id="reportForm" method="POST" action="<?php echo site_url('schedule/searchByGroup')?>">
            <?php if (!empty ($groups)): ?>

            <select name="group_id" id = 'group_id'>
                <option value="">- Search By Group -</option>
                <?php foreach ($groups as $group): ?>

                <?php if($group['group_id'] != 1): ?>
                <option value="<?php echo $group['group_id'] ?>" <?php echo ($this->input->post('group_id') == $group['group_id']) ? "selected = 'selected'" : '' ?> >
                    <?php echo $group['associated_name'] ?>
                </option>
                <?php endif; ?>

                <?php endforeach; ?>
            </select>

            <?php endif; ?>
            </form>

        <?php endif ?>


    </div> <!--.block_head ends -->
    
    <div class="block_content">

        <table cellpadding="0" cellspacing="0" width="100%">

            <thead>

                <tr>
                    <th class="centered" width="12%">Date</th>
                    <th class="centered" width="10%">Day</th>
                    <th class="centered" width="8%">Time</th>
                    <th class="centered" width="30%">Event</th>
                    <th class="centered" width="16%">Venue</th>
                    <th class="centered" width="12%">Date & Time Confirmation</th>
                     <?php if ($userType == ADMIN): ?>
                        <th class="centered" width="20%">Action</th>
                     <?php endif ?>
                </tr>

            </thead>
            
            <tbody>

            <?php if (empty ($schedules)) : ?>
                
            <tr>
                <td colspan="6" class="nodatamsg">No event is available.</td>
            </tr>

            <?php else : foreach($schedules AS $schedule) : ?>
                
            <tr>
                <td class="centered"><?php echo DateHelper::mysqlToHuman($schedule['date']) ?></td>
                <td class="centered"><?php echo date('l', strtotime($schedule['date'])) ?></td>
                <td class="centered"><?php echo date("g:i a", STRTOTIME($schedule['time']))  ?></td>
                <td><a href="<?php echo site_url("schedule/viewEvent/{$schedule['schedule_id']}") ?>" > <?php echo $schedule['title']."." ?>
                    &nbsp;<span style="color:#a52a2a;" ><?php echo $schedule['description'] ?></span></a></td>
                <td ><?php echo $schedule['venue'] ?></td>
                <td class="centered">
                    <input type="checkbox" disabled="disabled" <?php echo empty ($schedule['is_date_not_confirmed']) ? 'checked="checked"' : '' ?> />
                    <span style="min-width: 100px">&nbsp;&nbsp;&nbsp;</span>
                    <input type="checkbox" disabled="disabled" <?php echo empty ($schedule['is_time_not_confirmed']) ? 'checked="checked"' : '' ?> />
                </td>

                <?php if ($userType == ADMIN): ?>
                <td class="action">
                    <a href="<?php echo site_url("schedule/edit/{$schedule['schedule_id']}") ?>">Edit</a>
                    <?php if (!empty ($flagForPrint)): ?>
                    | <a href="<?php echo site_url("schedule/deleteEvent/id/{$schedule['schedule_id']}") ?>" id='delete'>Delete</a>
                    <?php endif ?>
                </td>
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

<script type="text/javascript">
    $(function(){
        $('#group_id').live('change', function(){
            $('#reportForm').submit();
        });
    });
</script>