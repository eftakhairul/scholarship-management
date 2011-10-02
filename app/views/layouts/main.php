<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Ministry of Health and Family Welfare</title>

        <style type="text/css" media="all">
            @import url("<?php echo site_url('assets/css/style.css'); ?>");
            @import url("<?php echo site_url('assets/css/jquery.wysiwyg.css'); ?>");
            @import url("<?php echo site_url('assets/css/facebox.css'); ?>");
            @import url("<?php echo site_url('assets/css/visualize.css'); ?>");
            @import url("<?php echo site_url('assets/css/date_input.css'); ?>");
        </style>

        <link rel="stylesheet" href="<?php echo site_url('assets/css/print.css'); ?>" media="print" />

        <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.img.preload.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.filestyle.mini.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.wysiwyg.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.date_input.pack.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('assets/js/facebox.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('assets/js/excanvas.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.visualize.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.select_skin.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.pngfix.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('assets/js/custom.js') ?>"></script>
    </head>

    <body>

        <div id="hld">

            <div class="wrapper">		<!-- wrapper begins -->

                <div id="header">

                    <h1><a href="http://mohfw.gov.bd">MOHFW</a></h1>
                    <ul id="nav">
                        <li ><a href=<?php echo site_url('schedule') ?>>Schedules</a>
                            <ul>
                                <li><a href=<?php echo site_url('schedule') ?>>View Schedule</a></li>

                                <?php if($this->session->userdata('userType') == ADMIN OR $this->session->userdata('userType') == SUPER_ADMIN): ?>
                                <li><a href=<?php echo site_url('schedule/createSchedule') ?>>Create Event</a></li>
                                <?php endif;?>

                                <?php if ($userType == SUPER_ADMIN): ?>
                                 <li><a href='<?php echo site_url('schedule/searchByGroup') ?>'>Search By Group</a></li>
                                <?php endif; ?>
                                
                            </ul>
                        </li>

                        <?php if ($this->session->userdata('userType') == SUPER_ADMIN) : ?>
                        <li ><a href=<?php echo site_url('user/manageUser') ?>>Users</a>
                            <ul>
                                <li><a href=<?php echo site_url('user/manageUser') ?>>Manage Users</a></li>
                                <li><a href=<?php echo site_url('user/addUser') ?>>Add User</a></li>
                            </ul>
                        </li>
                        <li><a href=<?php echo site_url('group') ?>>Groups</a>
                            <ul>
                                <li><a href=<?php echo site_url('group') ?>>Manage Groups</a></li>
                                <li><a href=<?php echo site_url('group/addGroup') ?>>Add Group</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        
                        <li><a href='<?php echo site_url('schedule/pastschedule') ?>'>Past Schedules</a>
                            <?php if ($this->session->userdata('userType') == SUPER_ADMIN) : ?>
                            <ul>
                                <?php $scheduleStatuses = $this->config->item('schedule_statuses'); foreach($scheduleStatuses AS $status => $title) : ?>
                                <li><a href='<?php echo site_url('schedule/viewSchedules/status/' . $status) ?>'><?php echo $title ?></a></li>

                                <?php endforeach ?>
                            </ul>
                            <?php endif; ?>
                        </li>


                        <li><a href=<?php echo site_url('user/changePassword/id').'/'.$this->session->userdata('user_id') ?>>Change Password</a> </li>

                    </ul>

                    <p class="user">
                        Hello, <a href="<?php echo site_url('user/editUser/id').'/'.$this->session->userdata('user_id')?>"><?php echo $this->session->userdata('username') ?></a> |
                        <a href="<?php echo site_url('user/logout') ?>">Logout</a>
                    </p>

                </div>		<!-- #header ends -->

                <?php if (!empty($notification['message'])) : ?>

                <div class="block message-block">

                    <div class="message <?php echo $notification['messageType'] ?>" style="display: block;">
                        <p><?php echo $notification['message'] ?></p>
                    </div>

                </div>

                <?php endif ?>

                <?php echo $content_for_layout ?>

                <div id="footer">
                    
                    <p class="left">Powered by <a href="http://www.dghs.gov.bd/">MIS Dept, DGHS</a></p>
                    <p class="right">Developed by <a href="http://www.rightbrainsolution.com/">Right Brain Solution Ltd.</a></p>

                </div>

            </div>						<!-- wrapper ends -->

        </div>		<!-- #hld ends -->

    </body>
</html>
