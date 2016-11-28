<?php
require_once '../Domain/DatabaseAccessor.php';

class ActivityLogger{

  protected static $tableName = activityLog;

  public function logReport ( $report ) {
    $this->accessDatabase();
    $isLogSuccessful = $this->database->insertRow( $report );
    //TODO//

  }


}
  ?>
