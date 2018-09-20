<?php

class birthday {
    var $date;
    public function __construct() {
    }
    public function get_date() {
        return $this->date;
    }
    public function set_date($new_date) {
        $this->date = $new_date;
    }
    public function calculateAge(){
        return date('Y')- date('Y', strtotime($this->get_date()));
    }
}

function retrieveBirthdays(){

    $todayMonthAndDay   = date("m-d");
    global $wpdb;
    $todayResults = $wpdb->get_results( "SELECT * FROM `wp_usermeta` WHERE `meta_key` LIKE 'birthdate' AND `meta_value` RLIKE '".$todayMonthAndDay."'" );
    $todayResultsCounter = 1;
    foreach($todayResults as $result){

        $userBirthday   = new birthday();
        $userBirthday->set_date($result->meta_value);
        $todayUsers = $todayUsers .'<br>'. $todayResultsCounter.') Id utente: ' .$result->user_id .' ( '.$userBirthday->calculateAge().' anni )';
        $todayResultsCounter = $todayResultsCounter + 1;

    }
    ?>
    <div class="wrap">
        <h2>Prossimi compleanni</h2>
    </div>
    <div class="" > <h3> Ci sono <?php echo $todayResultsCounter-1; ?> utenti che compiono gli anni oggi! </h3> </div>
    <div class="" > <p> <?php echo $todayUsers; ?> </p> </div>

    <?php

    $tomorrowMonthAndDay = date("m-d", strtotime("+1 day"));

    $tomorrowResults = $wpdb->get_results( "SELECT * FROM `wp_usermeta` WHERE `meta_key` LIKE 'birthdate' AND `meta_value` RLIKE '".$tomorrowMonthAndDay."'" );
    $tomorrowResultsCounter = 1;


    foreach($tomorrowResults as $result){
        
        $userBirthday   = new birthday();
        $userBirthday->set_date($result->meta_value);
        $tomorrowUsers = $tomorrowUsers .'<br>'. $tomorrowResultsCounter.') Id utente: ' .$result->user_id .' ( '.$userBirthday->calculateAge().' anni )';
        $tomorrowResultsCounter = $tomorrowResultsCounter + 1;
    }

    ?>
    <div class="wrap">
        <div class="" > <h3> Ci sono <?php echo $tomorrowResultsCounter-1; ?> utenti che compiono gli anni domani! </h3> </div>

    </div>
    <div class="" > <p> <?php echo $tomorrowUsers; ?> </p> </div>
    <?php

}
?>
