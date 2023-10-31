<?php
class NotesModel
{
  private $con;
  private $table_name = "notes";

  private function getConnection()
  {
    $host = "localhost";
    $pwd = "";
    $dbname = "no_estas_solo";
    $user = "root";
    $this->con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
  }

  public function createNote($id_user, $title, $description)
  {
    $this->getConnection();
    $sql = "
    INSERT INTO
    $this->table_name (
      id_user,
      title,
      description
    ) VALUES (
      $id_user,
      \"$title\",
      \"$description\"
    );
    ";

    try {
      $this->con->query($sql);
    } catch (PDOException $e) {
      die("error sql: " . $e);
    } finally {
      $this->con = null;
    }
  }

  public function checkNotes($id_user)
  {
    $this->getConnection();

    $sql = "SELECT * FROM $this->table_name WHERE id_user = $id_user;";
    $resultados = $this->con->query($sql);

    $notas = $resultados->fetchAll(PDO::FETCH_ASSOC);
    $this->con = null;

    return $notas;
  }

  public function deleteNote($id)
  {
    $this->getConnection();

    $sql = "DELETE FROM $this->table_name WHERE id = $id;";
    try {
      $this->con->query($sql);
    } catch (PDOException $e) {
      die("error sql: " . $e);
    } finally {
      $this->con = null;
    }
  }
}

$noteModel = new NotesModel();
$notas = $noteModel->checkNotes(22);