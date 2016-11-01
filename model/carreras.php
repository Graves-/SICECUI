<?php
  require('Connection.php');

  //  ###############
  //  # Carreras.php #
  //  ###############

  $arregloCarreras = array();

  $db = new Connection();
  $con = $db->ConectarBD();
  $sql = 'SELECT * FROM carreras';
  $rs = $db->SelectQuery($sql,$con);

  $rs->data_seek(0);
  while($row = $rs->fetch_assoc()){
      array_push($arregloCarreras,
        array(
          'clave_carrera' => $row['clave_carrera'],
          'nombre_carrera' => $row['nombre_carrera']
        )
      );
  }

  echo json_encode($arregloCarreras);

?>
