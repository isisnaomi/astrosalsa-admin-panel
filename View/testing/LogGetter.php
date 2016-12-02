<?php
$requestedData = $_POST;
switch($requestedData["type"]){

    case 'getAssistanceLog':
        sendAssistanceData($requestedData);
        break;

    case 'packages':
        sendPackagesData();
        break;

    case 'assistance':
        sendAssistanceData();
        break;

}

function sendAssistanceData($requestedData){

    $data = [
        'data' => [
            ['DateTime' => '2/2/2016', 'Name' => 'Pedro'],
            ['DateTime' => '2/2/2016', 'Name' => 'Diana'],


            ['DateTime' => '4/2/2016', 'Name' => 'Rasph'],
            ['DateTime' => '4/2/2016', 'Name' => 'Homero'],
            ['DateTime' => '4/2/2016', 'Name' => 'Casi Homero'],
            ['DateTime' => '4/2/2016', 'Name' => 'Rasph'],
            ['DateTime' => '4/2/2016', 'Name' => 'Homero'],
            ['DateTime' => '4/2/2016', 'Name' => 'Casi Homero'],

            ['DateTime' => '5/2/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/2/2016', 'Name' => 'Diana'],
            ['DateTime' => '5/2/2016', 'Name' => 'Mónica'],
            ['DateTime' => '5/2/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/2/2016', 'Name' => 'Diana'],
            ['DateTime' => '5/2/2016', 'Name' => 'Mónica'],
            ['DateTime' => '5/2/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/2/2016', 'Name' => 'Diana'],
            ['DateTime' => '5/2/2016', 'Name' => 'Mónica'],

            ['DateTime' => '6/2/2016', 'Name' => 'Rasph'],
            ['DateTime' => '6/2/2016', 'Name' => 'Homero'],
            ['DateTime' => '6/2/2016', 'Name' => 'Casi Homero']
        ]
    ];

    header('Content-Type: application/json');
    echo json_encode($data);

}