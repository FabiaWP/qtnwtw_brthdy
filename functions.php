<?php

    //create notification

    $header =array(
        'authorization: Basic ' ,
        'content-type: application/json',
    );
    $curl = curl_init();



    // CREATE BODY
    $body = array(
        'app_id' => '' ,
        'headings' => array(
            'it' => 'Buon compleanno!'
        ),
        'contents' => array(
            'en' => 'Happy birthday.',
            'it' => 'Buon compleanno',
        ),
        'include_player_ids' => ['6bfba61e-7a22-440e-8916-99b23276aea5'],
        'send_after' => "Sept 20 2018 21:00:00 GMT+0200"
    );


    // SEND REQUEST TO ONESIGNAL
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://onesignal.com/api/v1/notifications",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => $header,
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);

    // CLOSE CONNECTION
    curl_close($curl);

    // CHECK FOR ERRORS
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    };

?>
