<div class="block">

    <div class="block_head">
        <h2>Events</h2>

        <form id="reportForm" method="POST" action="">
            <?php if (!empty ($groups)): ?>

            <select name="group_id" id ="group_id" >
                <option value="">- Search By Group -</option>
                <?php foreach ($groups as $group): ?>
                <?php if($group['group_id'] !=1): ?>
                <option value="<?php echo $group['group_id'] ?>" <?php echo ($this->input->post('group_id') == $group['group_id']) ? "selected = 'selected'" : '' ?> >
                    <?php echo $group['associated_name'] ?>
                </option>
                 <?php endif; ?>

                <?php endforeach; ?>
            </select>

            <?php endif; ?>
        </form>

    </div> <!--.block_head ends -->
    
    <div class="block_content">

        <table cellpadding="0" cellspacing="0" width="100%">

            <thead>

                <tr>
                    <th class="centered" width="40%">Event Name</th>
                    <th class="centered" width="12%">Date</th>
                    <th class="centered" width="12%">Day</th>
                    <th class="centered" width="12%">Time</th>
                    <th class="centered" width="12%">Date & Time Confirmation</th>
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
                <td class="centered"><?php echo date("g:i a", STRTOTIME($schedule['time'])) ?></td>
                <td class="centered">
                    <input type="checkbox" disabled="disabled" <?php echo empty ($schedule['is_date_not_confirmed']) ? 'checked="checked"' : '' ?> />
                    <span style="min-width: 100px">&nbsp;&nbsp;&nbsp;</span>
                    <input type="checkbox" disabled="disabled" <?php echo empty ($schedule['is_time_not_confirmed']) ? 'checked="checked"' : '' ?> />
                </td>                                
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