<?php
$datos = array();
$data = array();
$queryString = parse_str($_SERVER['QUERY_STRING'], $datos);

foreach($datos['data'] as $dato){
  array_push($data, $dataInGet);
}
$request = [
  'target'  =>   $_GET[ 'target' ],
  'type'    =>   $_GET[ 'type' ],
  'data'    =>   $data
];

echo var_dump($data);
