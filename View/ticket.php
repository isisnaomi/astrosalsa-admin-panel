<style>

  body {
    font-family: 'Myriad Pro', Arial, sans-serif;
    font-size: 24px;
    text-align: center;
  }

  small {
    font-size: 0.5em;
  }

</style>
<?php

  $folio = substr( md5( microtime() ), rand(0, 26), 9);
  $get = isset( $_GET['content'] ) ? $_GET['content'] : false;

  if ( $get )
    echo $get;
    echo "<p>Folio: $folio</p>";
    echo "<p><small>Calle 50 x 47 Locales 6 y 7 Plaza Caribe,</p>";
    echo "Francisco de Montejo, Mérida, Yucatán</small></p>";
?>
