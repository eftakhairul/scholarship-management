<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>BRACU Scholarship Management Software</title>

    <!--    @import url("<?php echo site_url('css/style.css') ?>");-->
    <style type="text/css" media="all">
        @import url("<?php echo site_url('assets/css/style.css') ?>");
        @import url("<?php echo site_url('assets/css/jquery.wysiwyg.css') ?>");
        @import url("<?php echo site_url('assets/css/facebox.css') ?>");
        @import url("<?php echo site_url('assets/css/visualize.css') ?>");
        @import url("<?php echo site_url('assets/css/date_input.css') ?>");
    </style>

    <!--[if lt IE 8]><style type="text/css" media="all">@import url("<?php echo site_url('assets/css/ie.css') ?>");</style>--><![endif]-->

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

        <div class="wrapper">        <!-- wrapper begins -->

            <?php if (!empty($notification['message'])) : ?>

                <div class="block message-block">

                    <div class="message <?php echo $notification['messageType'] ?>" style="display: block;">
                        <p><?php echo $notification['message'] ?></p>
                    </div>

                </div>

                <?php endif ?>

            <div class="block small center login">

                <div class="block_head">
                    <h3 style="text-align: center">Welcome to BRACU Scholarship Management System</h3>
                </div>
                <!-- .block_head ends -->

                <div class="block_content">

                    <?php if (empty ($error)): ?>

                    <div class="message info" style="display: block;">
                        <p>Enter username and password.</p>
                    </div>

                    <?php else : ?>

                    <div class="message errormsg" style="display: block;">
                        <p><?php echo $error ?></p>
                    </div>

                    <?php endif ?>

                    <form action="<?php echo site_url('auth/login') ?>" method="post">
                        <p>
                            <label>Username: <span class="required">*</span></label>
                            <input type="text" class="text" name="username"
                                   value="" /><br />
                            <span class='note error'>
                                <?php echo form_error('username') ?>
                            </span>
                        </p>

                        <p>
                            <label>Password: <span class="required">*</span></label>
                            <input type="password" class="text" name="password" value="" /><br />
                                <span class='note error'>
                                    <?php echo form_error('password') ?>
                                </span>
                        </p>

                        <p>
                            <input type="submit" class="submit" value="Login" name="submit" />
                        </p>
                    </form>

                </div>
                <!-- .block_content ends -->

            </div>
            <!-- .login ends -->

        </div>
        <!-- wrapper ends -->

    </div>
    <!-- #hld ends -->

</body>
</html>

