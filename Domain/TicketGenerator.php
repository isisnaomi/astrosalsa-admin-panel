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

        $ticket =  "<div>".
                      "<h1>AstroSalsa</h1>" .
                      "<p>Nombre del alumno: $studentName </p>" .
                      "<p>Fecha: $today</p>" .
                      "<p>Nombre del paquete: $packageName</p>" .
                      "<p>Clases adquiridas: $packageClasses</p>" .
                      "<p>Monto pagado: $packagePrice</p>" .
                    "</div>";

        return $ticket;

    }

}