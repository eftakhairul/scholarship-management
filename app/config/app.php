<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['site_title']   = 'Health Minister Schedule'; //Site Title Goes Here
$config['site_main']    = ''; //Site Main Url Goes Here

$config['adminEmail']   = 'eftakhairul@rightbrainsolution.com'; //Admin Email Address
$config['infoEmail']    = ''; // Info Email Address
$config['infoName']     = ''; // Info Name
$config['rowsPerPage'] = 20;
$config['schedule_statuses'] = array(
    'completed' => 'Completed Schedules',
    'cancelled' => 'Cancelled Schedules',
    'postponed' => 'Postponed Schedules',
);

$config['grace'] = array(
    1 => 'Chief Guest',
    2 => 'Special Guest',
    3 => 'Guest of Honor',
    4 => 'Chair',
    5 => 'Participant',
    6 => 'Not Applicable'
);