<?php
/**
 * Created by PhpStorm.
 * User: isisramirez
 * Date: 12/2/16
 * Time: 3:05 PM
 */
require_once '../Domain/StudentsAdministrator.php';

    echo ('hey');
    $taskData = [
    'name' => 'Pancho'
    ];
    $admin = new StudentsAdministrator();
    $admin->doTask('add', $taskData );
    echo ('hey');

