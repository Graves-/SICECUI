<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  require('Connection.php');
  require('Generador.php');

  // ##########################
  // # inscripcion_alumno.php #
  // ##########################

  $db = new Connection();
  $con = $db->ConectarBD();

  $nombre = $_POST['nombreA'];
  $apepatA = $_POST['apepatA'];
  $apematA = $_POST['apematA'];
  $curpA = $_POST['curpA'];
  $dirA = $_POST['dirA'];
  $telA = $_POST['telA'];
  $munA = $_POST['munA'];
  $entA = $_POST['entA'];
  $trabajaA = $_POST['trabajaA'];
  $carrera = $_POST['inputCarrera'];
  $correo = $_POST['correoA'];
  $last_id = 0;
  $cve_alumno = 0;
  $cve_maestro = 0;

  $qry = "select MAX(clave_alumno) AS max_id from alumnos";
  $rs = $db->SelectQuery($qry,$con);
  $rs->data_seek(0);
  if($row = $rs->fetch_assoc()){
    $last_id = $row['max_id'];
    $newNumCtrl = str_pad($row['max_id'],8,'0',STR_PAD_LEFT);
  }

  //INSERTAR EN LA TABLA alumnos
  $sql = "INSERT INTO alumnos (numero_control_alumno,nombre_alumno,apepat_alumno,apemat_alumno,curp_alumno,direccion_alumno,telefono_alumno,municipio_alumno,entidad_alumno,fechainscripcion_alumno,carrera) VALUES('".$newNumCtrl."','".$nombre."','".$apepatA."','".$apematA."','".$curpA."','".$dirA."','".$telA."','".$munA."','".$entA."',CURDATE(),'".$carrera."')";
  $response_alumno = $db->InsertQuery($sql,$con);

  //Instancia de la clase Generador para crear una contraseña aleatoria para este usuario.
  $Generador = new Generador();
  $cadena = $Generador->generateRandomString();

  //INSERTAR ALUMNO EN LA TABLA usuarios_alumnos
  $sql = "INSERT INTO usuarios_alumnos(numerocontrol_usuario,password_alumno,correo_alumno) VALUES('".$newNumCtrl."','".$cadena."','".$correo."')";
  $response_usuario = $db->InsertQuery($sql,$con);

  /*
  //OBTENER LA CLAVE DE ALUMNO
  $sql = "SELECT cvealumno from alumnos WHERE numero_control_alumno = " . $newNumCtrl;
  $rs = $db->SelectQuery($qry,$con);
  $rs->data_seek(0);
  if($row = $rs->fetch_assoc()){
    $cve_alumno = $row['cvealumno'];
  }
  //OBTENER LA CLAVE DEL MAESTRO

  //INSCRIBIR ALUMNO A MATERIAS
  $sql = "INSERT INTO grupos (cvealumno,cvemateria,cvemaestro) VALUES('".$cve_alumno."','',)";
  */

  if($response_alumno && $response_usuario){
    header('Location: ../index.html');
  }
?>
