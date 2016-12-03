<?php
$requestedData = $_POST;
switch($requestedData["type"]){

    case 'getAssistanceLog':
        sendAssistanceData($requestedData);
        break;

    case 'getPaymentLog':
        sendPaymentData();
        break;

    case 'getInscriptionLog':
        sendInscriptionData();
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
            ['DateTime' => '11/2/2016', 'Name' => 'Homero'],
            ['DateTime' => '11/2/2016', 'Name' => 'Casi Homero'],

            ['DateTime' => '5/2/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/2/2016', 'Name' => 'Diana'],
            ['DateTime' => '7/2/2016', 'Name' => 'Mónica'],
            ['DateTime' => '7/2/2016', 'Name' => 'Pedro'],
            ['DateTime' => '7/2/2016', 'Name' => 'Diana'],
            ['DateTime' => '8/2/2016', 'Name' => 'Mónica'],
            ['DateTime' => '8/2/2016', 'Name' => 'Pedro'],
            ['DateTime' => '9/2/2016', 'Name' => 'Diana'],
            ['DateTime' => '10/2/2016', 'Name' => 'Mónica'],

            ['DateTime' => '6/2/2016', 'Name' => 'Rasph'],
            ['DateTime' => '6/2/2016', 'Name' => 'Homero'],
            ['DateTime' => '6/2/2016', 'Name' => 'Casi Homero']
        ]
    ];

    header('Content-Type: application/json');
    echo json_encode($data);

}

function sendInscriptionData(){

    $data = [
        'data' => [
            ['DateTime' => '2/2/2016', 'Name' => 'Pedro'],
            ['DateTime' => '2/2/2016', 'Name' => 'Diana'],


            ['DateTime' => '4/2/2016', 'Name' => 'Rasph'],
            ['DateTime' => '4/2/2016', 'Name' => 'Homero'],
            ['DateTime' => '4/2/2016', 'Name' => 'Casi Homero'],
            ['DateTime' => '4/2/2016', 'Name' => 'Rasph'],
            ['DateTime' => '11/2/2016', 'Name' => 'Homero'],
            ['DateTime' => '11/2/2016', 'Name' => 'Casi Homero'],

            ['DateTime' => '5/3/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/3/2016', 'Name' => 'Diana'],
            ['DateTime' => '7/3/2016', 'Name' => 'Mónica'],
            ['DateTime' => '7/3/2016', 'Name' => 'Pedro'],
            ['DateTime' => '7/3/2016', 'Name' => 'Diana'],
            ['DateTime' => '8/3/2016', 'Name' => 'Mónica'],
            ['DateTime' => '8/3/2016', 'Name' => 'Pedro'],
            ['DateTime' => '9/3/2016', 'Name' => 'Diana'],
            ['DateTime' => '10/3/2016', 'Name' => 'Mónica'],

            ['DateTime' => '5/4/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/4/2016', 'Name' => 'Diana'],
            ['DateTime' => '7/4/2016', 'Name' => 'Mónica'],
            ['DateTime' => '7/4/2016', 'Name' => 'Pedro'],
            ['DateTime' => '7/4/2016', 'Name' => 'Diana'],
            ['DateTime' => '8/4/2016', 'Name' => 'Mónica'],
            ['DateTime' => '8/4/2016', 'Name' => 'Pedro'],
            ['DateTime' => '9/4/2016', 'Name' => 'Diana'],
            ['DateTime' => '10/4/2016', 'Name' => 'Mónica'],

            ['DateTime' => '5/5/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/5/2016', 'Name' => 'Diana'],
            ['DateTime' => '7/5/2016', 'Name' => 'Mónica'],
            ['DateTime' => '7/5/2016', 'Name' => 'Pedro'],
            ['DateTime' => '7/5/2016', 'Name' => 'Diana'],
            ['DateTime' => '8/5/2016', 'Name' => 'Mónica'],
            ['DateTime' => '8/5/2016', 'Name' => 'Pedro'],
            ['DateTime' => '9/5/2016', 'Name' => 'Diana'],
            ['DateTime' => '10/5/2016', 'Name' => 'Mónica'],
            ['DateTime' => '5/5/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/5/2016', 'Name' => 'Diana'],
            ['DateTime' => '7/5/2016', 'Name' => 'Mónica'],
            ['DateTime' => '7/5/2016', 'Name' => 'Pedro'],
            ['DateTime' => '7/5/2016', 'Name' => 'Diana'],
            ['DateTime' => '8/5/2016', 'Name' => 'Mónica'],
            ['DateTime' => '8/5/2016', 'Name' => 'Pedro'],
            ['DateTime' => '9/5/2016', 'Name' => 'Diana'],
            ['DateTime' => '10/5/2016', 'Name' => 'Mónica'],

            ['DateTime' => '10/6/2016', 'Name' => 'Mónica'],
            ['DateTime' => '5/6/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/6/2016', 'Name' => 'Diana'],
            ['DateTime' => '7/6/2016', 'Name' => 'Mónica'],
            ['DateTime' => '7/6/2016', 'Name' => 'Pedro'],
            ['DateTime' => '7/6/2016', 'Name' => 'Diana'],
            ['DateTime' => '8/6/2016', 'Name' => 'Mónica'],
            ['DateTime' => '8/6/2016', 'Name' => 'Pedro'],
            ['DateTime' => '9/6/2016', 'Name' => 'Diana'],
            ['DateTime' => '10/6/2016', 'Name' => 'Mónica'],

            ['DateTime' => '10/7/2016', 'Name' => 'Mónica'],
            ['DateTime' => '5/7/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/7/2016', 'Name' => 'Diana'],
            ['DateTime' => '7/7/2016', 'Name' => 'Mónica'],
            ['DateTime' => '7/7/2016', 'Name' => 'Pedro'],
            ['DateTime' => '7/7/2016', 'Name' => 'Diana'],
            ['DateTime' => '8/7/2016', 'Name' => 'Mónica'],
            ['DateTime' => '8/7/2016', 'Name' => 'Pedro'],
            ['DateTime' => '9/7/2016', 'Name' => 'Diana'],
            ['DateTime' => '10/7/2016', 'Name' => 'Mónica'],

            ['DateTime' => '10/8/2016', 'Name' => 'Mónica'],
            ['DateTime' => '5/8/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/8/2016', 'Name' => 'Diana'],
            ['DateTime' => '7/8/2016', 'Name' => 'Mónica'],
            ['DateTime' => '7/8/2016', 'Name' => 'Pedro'],
            ['DateTime' => '7/8/2016', 'Name' => 'Diana'],
            ['DateTime' => '8/8/2016', 'Name' => 'Mónica'],
            ['DateTime' => '8/8/2016', 'Name' => 'Pedro'],
            ['DateTime' => '9/8/2016', 'Name' => 'Diana'],
            ['DateTime' => '10/8/2016', 'Name' => 'Mónica'],

            ['DateTime' => '10/10/2016', 'Name' => 'Mónica'],
            ['DateTime' => '5/10/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/10/2016', 'Name' => 'Diana'],
            ['DateTime' => '7/10/2016', 'Name' => 'Mónica'],
            ['DateTime' => '7/10/2016', 'Name' => 'Pedro'],
            ['DateTime' => '7/10/2016', 'Name' => 'Diana'],
            ['DateTime' => '8/10/2016', 'Name' => 'Mónica'],
            ['DateTime' => '8/10/2016', 'Name' => 'Pedro'],
            ['DateTime' => '9/10/2016', 'Name' => 'Diana'],
            ['DateTime' => '10/10/2016', 'Name' => 'Mónica'],

            ['DateTime' => '10/11/2016', 'Name' => 'Mónica'],
            ['DateTime' => '5/11/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/11/2016', 'Name' => 'Diana'],
            ['DateTime' => '7/11/2016', 'Name' => 'Mónica'],
            ['DateTime' => '7/11/2016', 'Name' => 'Pedro'],
            ['DateTime' => '7/11/2016', 'Name' => 'Diana'],
            ['DateTime' => '8/11/2016', 'Name' => 'Mónica'],
            ['DateTime' => '8/11/2016', 'Name' => 'Pedro'],
            ['DateTime' => '9/11/2016', 'Name' => 'Diana'],
            ['DateTime' => '10/11/2016', 'Name' => 'Mónica'],

            ['DateTime' => '10/12/2016', 'Name' => 'Mónica'],
            ['DateTime' => '5/12/2016', 'Name' => 'Pedro'],
            ['DateTime' => '5/12/2016', 'Name' => 'Diana'],
            ['DateTime' => '7/12/2016', 'Name' => 'Mónica'],
            ['DateTime' => '7/12/2016', 'Name' => 'Pedro'],
            ['DateTime' => '7/12/2016', 'Name' => 'Diana'],
            ['DateTime' => '8/12/2016', 'Name' => 'Mónica'],
            ['DateTime' => '8/12/2016', 'Name' => 'Pedro'],
            ['DateTime' => '9/12/2016', 'Name' => 'Diana'],
            ['DateTime' => '10/12/2016', 'Name' => 'Mónica'],


        ]
    ];

    header('Content-Type: application/json');
    echo json_encode($data);

}

function sendPaymentData(){

    $data = [
        'data' => [
            ['DateTime' => '2/2/2016', 'Name' => 'Pedro', 'Package' => 'Paquete de fuego'],
            ['DateTime' => '2/2/2016', 'Name' => 'Diana', 'Package' => 'Paquete de fuego'],


            ['DateTime' => '4/2/2016', 'Name' => 'Rasph', 'Package' => 'Paquete de agua'],
            ['DateTime' => '4/2/2016', 'Name' => 'Homero', 'Package' => 'Paquete de tierra'],
            ['DateTime' => '4/2/2016', 'Name' => 'Casi Homero', 'Package' => 'Paquete de tierra'],
            ['DateTime' => '4/2/2016', 'Name' => 'Rasph', 'Package' => 'Paquete de tierra'],
            ['DateTime' => '4/2/2016', 'Name' => 'Homero', 'Package' => 'Paquete de fuego'],
            ['DateTime' => '4/2/2016', 'Name' => 'Casi Homero', 'Package' => 'Paquete de fuego'],

            ['DateTime' => '5/2/2016', 'Name' => 'Pedro', 'Package' => 'Paquetebailen'],
            ['DateTime' => '5/2/2016', 'Name' => 'Diana', 'Package' => 'Paquetebailen'],
            ['DateTime' => '5/2/2016', 'Name' => 'Mónica', 'Package' => 'Paquetebailen'],
            ['DateTime' => '5/2/2016', 'Name' => 'Pedro', 'Package' => 'Paquete de fuego'],
            ['DateTime' => '5/2/2016', 'Name' => 'Diana', 'Package' => 'Paquete de metal'],
            ['DateTime' => '5/2/2016', 'Name' => 'Mónica', 'Package' => 'Paquete de metal'],
            ['DateTime' => '5/2/2016', 'Name' => 'Pedro', 'Package' => 'Paquete de metal'],
            ['DateTime' => '5/2/2016', 'Name' => 'Diana', 'Package' => 'Paquete de metal'],
            ['DateTime' => '5/2/2016', 'Name' => 'Mónica', 'Package' => 'Paquete de metal'],

            ['DateTime' => '6/2/2016', 'Name' => 'Rasph', 'Package' => 'Paquete de metal'],
            ['DateTime' => '6/2/2016', 'Name' => 'Homero', 'Package' => 'Paquete de metal'],
            ['DateTime' => '6/2/2016', 'Name' => 'Casi Homero', 'Package' => 'Paquete de metal']
        ]
    ];

    header('Content-Type: application/json');
    echo json_encode($data);

}