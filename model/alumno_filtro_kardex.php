<?php
  require('Connection.php');

  //  ###############
  //  # alumno_filtro_kardex.php #
  //  ###############

  if (isset($_GET['id_carrera'])) {
    $arregloAlumnos = array();

    $db = new Connection();
    $con = $db->ConectarBD();
    $sql = "SELECT * FROM alumnos WHERE carrera='".$_GET['id_carrera']."'";
    $rs = $db->SelectQuery($sql,$con);

    $rs->data_seek(0);
    while($row = $rs->fetch_assoc()){
        array_push($arregloAlumnos,
          array(
            'nombre_alumno' => $row['nombre_alumno'] . " " . $row['apepat_alumno'] . " " . $row['apemat_alumno'],
            'numero_control' => $row['numero_control_alumno']
          )
        );
    }

    echo json_encode($arregloAlumnos);
  }else{
    echo "No se pudo obtener alumnos.";
  }


?>
