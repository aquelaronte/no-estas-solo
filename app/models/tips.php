<?php
class TipsModel {
  private $con;
  private $table_name = "tips";

  private function getConnection()
  {
    $host = "localhost";
    $pwd = "";
    $dbname = "no_estas_solo";
    $user = "root";
    $this->con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
  }

  public function getTips(){
    $this->getConnection();
    $sql = "SELECT tips.title, tips.description, tips.id, users.name FROM $this->table_name LEFT JOIN users ON tips.id = users.id";

    $query = $this->con->query($sql);
    $this->con = null;

    $tips = $query->fetchAll(PDO::FETCH_ASSOC);

    return $tips;
  }

  public function deleteTip($id){
    $this->getConnection();
    $sql = "DELETE FROM $this->table_name WHERE id = $id";

    $this->con->query($sql);
    $this->con = null;
  }

  public function createTip($title, $description, $id_psychologist){
    $this->getConnection();
    $sql = "INSERT INTO $this->table_name(title, description, id_psychologist) VALUES('$title', '$description', $id_psychologist);";

    $this->con->query($sql);
    $this->con = null;    
  }
}
?>