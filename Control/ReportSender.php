<?php

  class ReportSender {

    private $report;

    public function __construct( $report ) {

      $this->report = $report;

    }

    public function sendReport() {

      $reportInArray = $this->convertReportToArray();

      print ( json_encode( $reportInArray ) );

    }

    private function convertReportToArray() {

      $array = [
        'type' => $this->report->getType(),
        'content' => $this->report->getContent()
      ];

      return $array;

    }

  }
