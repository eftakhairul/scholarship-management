<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/print.css'); ?>" media="print" />
    <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.js') ?>"></script>
</head>

<body>

    <div class="block">

        <div id = 'logo'><img src="<?php echo site_url('assets/images/ministry.gif') ?>" alt=""/> </div>
        <div id ='health'>
            <span class="title">Government of the People's Republic of Bangladesh</span>
            <span class="description">Ministry of Health and Family Welfare, Bangladesh</span>
            <span class="heading">Daily Schedule of <?php echo $title; ?></span>
        </div>

        <div class="block_content">

            <table id='print-table' cellpadding="3" cellspacing="0" width="100%" border="1px">

                <thead>

                    <tr>
                        <th class="centered" width="14%">Date & Time</th>
                        <th class="centered" width="5%">Day</th>
                        <th class="centered" width="85%">Details</th>
                    </tr>

                </thead>

                <tbody>

                <?php if (empty ($schedules)) : ?>

                <tr>
                    <td colspan="2" class="nodatamsg">No event is available.</td>
                </tr>

                <?php else : foreach($schedules AS $schedule) : ?>

                <tr>
                    <td class="centered" align="center"> <?php echo DateHelper::mysqlToHuman($schedule['date']) ?> <br/> <?php echo date("g:i a", STRTOTIME($schedule['time'])) ?></td>
                     <td class="centered" align="center"><?php echo date('l', strtotime($schedule['date'])) ?> </td>
                    <td >
                        Venue: <?php echo $schedule['venue'] ?>. Event: <?php echo $schedule['title'] ?>. To grace as:
                        <?php echo $schedule['grace'] ?>. <?php echo empty ($schedule['description']) ? '' : ($schedule['description'] . '.') ?>
			<span style = "font-weight:bold">
                        <?php if($schedule['is_date_not_confirmed'] == 1) {
                                if ($schedule['is_time_not_confirmed'] == 1) {
                                    echo "(Date and Time are not confirmed)";
                                } else {
                                    echo "(Date is not confirmed)";
                                }
                              } else if ($schedule['is_time_not_confirmed'] == 1){
                                echo "(Time is not confirmed)";
                              } ?>
			</span>
                    </td>
                </tr>

                <?php endforeach; endif ?>

                </tbody>

            </table>

            <div id = 'go-back' style="float: right; padding-top: 30px">
                <a href="javascript:history.go(-1)" style="padding: 0 30px;">Click here to go back</a>
            </div>

        </div> <!--.block_content ends-->

    </div> <!--.block ends-->

</body>
</html>

<style type="text/css">

    #logo {
        float: left;
        width: 100px;
    }

    #logo img {
        height: 75px;
        width: 75px;
    }

    #health {
        text-align:center;
    }

    #health h2 {
        line-height: 0.10em;
        font-size: 18px;
    }

    #health span.title, span.description {
        line-height: 0.5em;
        display: block;
        padding-top: 12px;
    }

    #health span.title {
        font-size: 18px;
    }

    #health span.description {
        font-size: 16px;
    }

    #health span.heading {
        display: block;
        font-size: 22px;
        font-weight: bold;
        padding-top: 12px;
    }

    /*body {*/
        /*margin: 0 auto;*/
        /*width:960px;*/
    /*}*/

    .block_content {
        clear: both;
    }

    #print-table {
        margin-top: 10px;
    }

</style>

<script language="JavaScript" type="text/javascript">

    $(document).ready(function(){
        window.print();
    });

</script>

