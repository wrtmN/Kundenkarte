<?php
class Kundenkarte_SQL
{
  private $db, $dbuser, $dbpass, $dbtable;

  public function setDatebase($db)
  {
    $this->db = $db;
  }
  public function setTable($dbtable)
  {
    $this->dbtable = $dbtable;
  }
  public function setUser($dbuser)
  {
    $this->dbuser = $dbuser;
  }
  public function setPass($dbpass)
  {
    $this->dbpass = $dbpass;
  }

  public function insert($vorname,$nachname)
  {
      $con = mysqli_connect("", $this->dbuser, $this->dbpass, $this->db);
      if (mysqli_connect_error() == 00)
  }
      $sql = "CREATE TABLE IF NOT EXISTS " . $this->dbtabel . "(kd_id INT AUTO-INCREMENT PRIMARY KEY, Vorname VARCHAR(30), Nachname VARCHAR(30))";
      mysqli_query($con, $sql);
      $sql = "INSERT INTO " . $this->dbtable . "(Vorname,Nachname) values('$vorname','$nachname')";
      mysqli_query($con, $sql);
      mysqli_close($con);
    }
  }

  public function select($param = "")
  {
    $res = array();
    $con = mysqli_connect("", $this->dbuser, this->dbpass, $this->db);
    $sql = "SELECT * FROM " . $this->dbtable . " $param";
    while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
     {
       array_push($res, implode(",",$row));
    }
    mysqli_close($con);
    return $res;
  }
}

 ?>
