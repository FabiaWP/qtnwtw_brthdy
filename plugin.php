<?php

/*
Plugin Name: Twr User Info Checker (USINCK)
Description: Checks Birthdate and more.
Author: Touchware
*/


define('TWR_USINCK', dirname(__FILE__));
define('TWR_USINCK_BASENAME', basename(TWR_USINCK));
define('TWR_USINCK_URL', plugins_url() . '/' . TWR_USINCK);

//include "functions.php";
include("userBirthdayRetriever.php");

class TWR_USINCK
{
    /**
    *  constructor.
    */
    public function __construct()
    {

        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 999, 1);

    }
    function enqueue_scripts()
    {
    }
}

new TWR_USINCK();


add_action('admin_menu', 'global_user_info_checker');

function global_user_info_checker()
{
    add_users_page('User Info Checker', 'User Info Checker', 'manage_options', 'checker','generate_page');
}

function generate_page(){
    return retrieveBirthdays();
}
