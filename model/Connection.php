<?php

class Connection
{

  public function ConectarBD()
  {
    $DBServer = 'localhost';
    $DBUser   = 'root';
    $DBPass   = 'root';
    $DBName   = 'sicecui';
    $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
    // check connection
    if ($conn->connect_error) {
      trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
    }
    return $conn;
  }

  public function SelectQuery($sql, $con)
  {
    $rs=$con->query($sql);

    if($rs === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
    } else {
      $rows_returned = $rs->num_rows;
    }

    $rs->data_seek(0);
    return $rs;
  }

  public function InsertQuery($sql, $con)
  {
    if($con->query($sql) === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
      return false;
    } else {
    return true;
    }
  }

}


?>
