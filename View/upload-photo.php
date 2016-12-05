<?php

  $student_id = $_POST['studentId'];
  $encoded_data = $_POST['image'];
  $binary_data = base64_decode( $encoded_data );

  $result = file_put_contents( "photos/$student_id.jpg", $binary_data );

  if ( ! $result )
  	die("Could not save image!  Check file permissions.");

?>
<span style='font-family: Arial; font-size: 22px;'>Foto guardada correctamente.</span>
<script>
  setTimeout(function() {

    window.location.href = 'dashboard-students.php';

  }, 1000);
</script>
