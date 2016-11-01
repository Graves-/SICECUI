<?php
  require('Connection.php');

  //  ###############
  //  # Maestros.php #
  //  ###############

  $arregloMaestros = array();

  $db = new Connection();
  $con = $db->ConectarBD();
  $sql = 'SELECT * FROM maestros';
  $rs = $db->SelectQuery($sql,$con);

  $rs->data_seek(0);
  while($row = $rs->fetch_assoc()){
      array_push($arregloMaestros,
        array(
          'nombre_maestro' => $row['nombre_maestro'] . " " . $row['apepat_maestro'] . " " . $row['apemat_maestro'],
          'numero_control_maestro' => $row['numero_control_maestro'],
          'rfc_maestro' => $row['rfc_maestro'],
          'origen' => $row['municipio_maestro'] . ", " . $row['entidad_maestro'],
          'curp_maestro' => $row['curp_maestro'],
          'fecha_ingreso_maestro' => $row['fechaingreso_maestro']
        )
      );
  }

  echo json_encode($arregloMaestros);

?>
