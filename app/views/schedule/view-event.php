<div class="block">

    <div class="block_head">
        <h2>View Event - <?php echo $schedule['title'] ?></h2>
    </div>

    <div class="block_content event-details">

        <span class="title">Date </span>
        <span class="description"> <?php echo DateHelper::mysqlToHuman($schedule['date']) ?>&nbsp;(<?php echo
            ( $schedule['is_date_not_confirmed'] == 0 ) ? 'Confirmed':'Not Confirmed' ?>)</span><br /><br />

        <span class="title">Day </span>
        <span class="description"> <?php echo date('l', strtotime($schedule['date'])) ?></span><br /><br />

        <span class="title">Time </span>
        <span class="description"> <?php echo date("g:i a", STRTOTIME($schedule['time'])) ?>&nbsp;(<?php echo
            ( $schedule['is_time_not_confirmed'] == 0 ) ? 'Confirmed':'Not Confirmed' ?>)</span><br /><br />

        <span class="title">Venue </span>
        <span class="description"> <?php echo $schedule['venue'] ?></span><br /><br />

        <span class="title">To Grace As: </span>
        <span class="description"><?php echo $schedule['grace'] ?></span><br /><br />

        <span class="title">Event Name: </span>
        <span class="description"><?php echo $schedule['title'] ?></span><br /><br />

        <span class="title">Details: </span>
        <span class="description"><?php echo $schedule['description'] ?></span><br /><br />

        <div style="float: right">
            <a href="javascript:history.go(-1)" style="padding: 0 30px;">Click here to go back</a>
        </div>

    </div>		<!-- .block_content ends -->

</div>		<!-- .block ends -->