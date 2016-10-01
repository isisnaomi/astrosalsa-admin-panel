<?php

  class DataBase {

    private $nombre;
    private $conexion;

    private $configuracion = [
      "servidor" => "localhost",
      "usuario" => "root",
      "contrasena" => null
    ];

    public function __construct( $nombre ) {
      $this->nombre = $nombre;
    }

    public function conectar() {

      $mensajeError = 'No se ha podido realizar la conexión.';

      if (! is_null ( $this->configuracion['contrasena'] ) ) {
        $this->conexion = mysql_connect( $this->configuracion['servidor'], $this->configuracion['usuario'], $this->configuracion['contrasena'] );
        mysql_select_db( $this->nombre, $this->conexion ) or die( $mensajeError );
        return $this->conexion;
      }

      else {
        $this->conexion = mysql_connect( $this->configuracion['servidor'], $this->configuracion['usuario'] );
        mysql_select_db( $this->nombre, $this->conexion ) or die( $mensajeError );
        return $this->conexion;
      }

    }

    public function desconectar() {
      mysql_close( $this->conexion );
    }

    public function eliminar( $tabla, $criterios ) {

      $query = "DELETE FROM $tabla WHERE ";
      $indexCriterios = 0;

      foreach ( $criterios as $criterio => $valor ) {

        if ( $indexCriterios != 0 ) $query .= ' AND ';

        $query .= "$criterio=$valor";
        $indexCriterios++;

      }

      $respuesta = mysql_query( $query, $this->conexion );

      if (! $respuesta )
        return 'No se ha podido eliminar los datos: ' . mysql_error( $this->conexion );

      else
        return 'Los datos se han eliminado correctamente.';

    }

    public function insertar( $tabla, $columnas, $valores ) {

      $query = "INSERT INTO " . $tabla . " (";
      $indexColumnas = 0;

      foreach ( $columnas as $columna ) {
        if ( $indexColumnas != 0 ) $query .= ", ";

        $query .= $columna;

        $indexColumnas++;
      }

      $query .= ") VALUES (";
      $indexValores = 0;

      foreach ( $valores as $valor ) {
        if ( $indexValores != 0 ) $query .= ", ";

        $query .= "'$valor'";

        $indexValores++;
      }

      $query .= ")";

      $respuesta = mysql_query( $query, $this->conexion );

      if (! $respuesta )
        return 'No se ha podido insertar los datos: ' . mysql_error( $this->conexion );

      else
        return 'Los datos se han insertado con éxito.';

    }

    public function seleccionar( $tabla, $columnas, $criterios ) {

      $query = "SELECT ";
      $indexColumnas = 0;

      foreach ($columnas as $columna) {

        if ( $indexColumnas != 0 ) $query .= ", ";

        $query .= $columna;

        $indexColumnas++;

      }

      $query .= " FROM " . $tabla . " WHERE ";

      foreach ( $criterios as $criterio => $valor ) $query .= $criterio . "=" . $valor;

      $respuesta = mysql_query( $query, $this->conexion );
      $return = '';

      if (! $respuesta )
        return 'No se ha podido obtener los datos: ' . mysql_error( $this->conexion );

      else
        while ( $fila = mysql_fetch_assoc( $respuesta ) )
          foreach ( $fila as $valor ) $return .= ' <span>' . $valor . '</span>,';

      return $return;

    }

  }
