<?php
  require('Connection.php');

  //  ###############
  //  # Materias.php #
  //  ###############

  $arregloMaterias = array();

  $db = new Connection();
  $con = $db->ConectarBD();
  $sql = 'SELECT * FROM materias';
  $rs = $db->SelectQuery($sql,$con);

  $rs->data_seek(0);
  while($row = $rs->fetch_assoc()){
      array_push($arregloMaterias,
        array(
          'matricula_materia' => $row['matricula_materia'],
          'carrera' => $row['cvecarrera'],
          'nombre_materia' => $row['nombre_materia'],
          'turno' => $row['turno'],
          'creditos' => $row['creditos'],
          'instalaciones' => $row['instalaciones'],
          'horas_docente' => $row['horas_docente'],
          'horas_independientes' => $row['horas_independientes'],
          'seriacion' => $row['seriacion'],
          'cuatrimestre' => $row['cuatrimestre']
        )
      );
  }

  echo json_encode($arregloMaterias);

?>
