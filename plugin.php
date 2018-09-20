<?php

/*
Plugin Name: Twr User Info Checker (USINCK)
Description: Checks Birthdate and more.
Author: Touchware
*/


define('TWR_USINCK', dirname(__FILE__));
define('TWR_USINCK_BASENAME', basename(TWR_USINCK));
define('TWR_USINCK_URL', plugins_url() . '/' . TWR_USINCK);

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
    add_users_page('User Info Checker', 'User Info Checker', 'manage_options', 'checker','birthday_user_checker');
}

function birthday_user_checker()
{
    $currentMonthAndDay   = date("m-d");
    global $wpdb;
    $results = $wpdb->get_results( "SELECT * FROM `wp_usermeta` WHERE `meta_key` LIKE 'birthdate' AND `meta_value` RLIKE '".$currentMonthAndDay."'" );
    $counter = 1;
    foreach($results as $result){
        $content = $content .'<br>'. $counter.') Id utente: '.$result->user_id;
        $counter = $counter + 1;
    }
    ?>
    <div class="wrap">
        <h2>Prossimi compleanni</h2>
    </div>
    <div class="" > <h3> Ci sono <?php echo $counter-1; ?> utenti che compiono gli anni oggi! </h3> </div>
    <div class="" > <p> <?php echo $content; ?> </p> </div>

    <div class="wrap">
        <h2>Nel corso della prossima settimana i seguenti utenti compieranno gli anni.</h2>
    </div>
    <?php

}
