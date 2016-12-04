<?php

/**
* TicketGenerator
* Generates the payment ticket
*/
class TicketGenerator{

    public static function generateTicket( $ticketData ){

        $packageName = $ticketData[ 'packageName' ];
        $packageClasses = $ticketData[ 'classesIncluded' ];
        $packagePrice = $ticketData[ 'price' ];
        $studentName = $ticketData[ 'studentName' ];
        $today = date( "d/m/y" );

        $ticket =  "<div align='center'>".
                    "<h2><b>Astro Salsa</b></h2>".
                    "<p>Nombre del alumno: </p>".$studentName.
                    "<p>Fecha: </p>".$today.
                    "<p>Nombre del paquete: </p>".$packageName.
                    "<p>Clases adquiridas: </p>".$packageClasses.
                    "<p>Monto pagado: </p>".$packagePrice.
                    "</div>";

        return $ticket;

    }

}