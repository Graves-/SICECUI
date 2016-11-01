<?php
  require('Connection.php');

  //  ###############
  //  # Alumnos.php #
  //  ###############

  $arregloAlumnos = array();

  $db = new Connection();
  $con = $db->ConectarBD();
  $sql = 'SELECT * FROM alumnos';
  $rs = $db->SelectQuery($sql,$con);

  $rs->data_seek(0);
  while($row = $rs->fetch_assoc()){
      array_push($arregloAlumnos,
        array(
          'nombre_alumno' => $row['nombre_alumno'] . " " . $row['apepat_alumno'] . " " . $row['apemat_alumno'],
          'numero_control' => $row['numero_control_alumno'],
          'curp_alumno' => $row['curp_alumno'],
          'origen' => $row['municipio_alumno'] . ", " . $row['entidad_alumno'],
          'carrera' => $row['carrera'],
          'cuatrimestre' => $row['cuatrimestre'],
          'fechainscripcion_alumno' => $row['fechainscripcion_alumno']
        )
      );
  }

  echo json_encode($arregloAlumnos);

?>
