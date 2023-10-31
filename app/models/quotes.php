<?php
class QuotesModel
{
  private $con;
  private $table_name = "quotes";

  private function getConnection()
  {
    $host = "localhost";
    $pwd = "";
    $dbname = "no_estas_solo";
    $user = "root";
    $this->con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
  }

  public function createQuote($id_student, $title, $description, $creation_date)
  {
    $this->getConnection();
    $sql = "
    INSERT INTO
    $this->table_name(
      id_student,
      title,
      description,
      creation_date
    ) VALUES (
      $id_student,
      \"$title\",
      \"$description\",
      \"$creation_date\"
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

  public function enroll_psichologyst($id_quote, $id_psychologist, $appointment_date)
  {
    $this->getConnection();
    $sql = "
    UPDATE $this->table_name 
    SET id_psychologist = $id_psychologist, 
    state = \"pendiente\", 
    appointment_date = \"$appointment_date\" 
    WHERE id = $id_quote;
    ";

    try {
      $this->con->query($sql);
    } catch (PDOException $e) {
      die("error sql: " . $e);
    } finally {
      $this->con = null;
    }
  }

  public function getQuotes_student($id_user)
  {
    $this->getConnection();

    $sql = "
    SELECT 
    quotes.id, quotes.id_student, quotes.id_psychologist, quotes.title, 
    quotes.description, quotes.creation_date, quotes.appointment_date, 
    quotes.finished, quotes.state, users.name as name_psychologist, 
    users.id as id_psychologist
    FROM quotes 
    LEFT JOIN users ON users.id = quotes.id_psychologist
    WHERE quotes.id_student = $id_user && finished = FALSE;
    ";

    $resultados = $this->con->query($sql);

    $quotes = $resultados->fetchAll(PDO::FETCH_ASSOC);
    $this->con = null;

    return $quotes;
  }

  public function getQuotes_psychologist()
  {
    $this->getConnection();

    $sql = "
    SELECT 
    quotes.id, quotes.id_student, quotes.id_psychologist, quotes.title, 
    quotes.description, quotes.creation_date, quotes.appointment_date, 
    quotes.finished, quotes.state, users.name as name_psychologist, 
    users.id as id_psychologist
    FROM quotes 
    LEFT JOIN users ON users.id = quotes.id_psychologist
    WHERE finished = FALSE && state = 'en espera';
    ";
    $resultados = $this->con->query($sql);

    $quotes = $resultados->fetchAll(PDO::FETCH_ASSOC);
    $this->con = null;

    return $quotes;
  }

  public function finishQuote($id_quote)
  {
    $this->getConnection();

    $sql = "UPDATE quotes SET finished = TRUE, state = \"finalizado\" WHERE id = $id_quote;";

    try {
      $this->con->query($sql);
    } catch (PDOException $e) {
      die("error sql: " . $e);
    } finally {
      $this->con = null;
    }
  }

  public function cancelQuote($id_quote)
  {
    $this->getConnection();

    $sql = "UPDATE quotes SET finished = TRUE, state = \"cancelado\" WHERE id = $id_quote";

    try {
      $this->con->query($sql);
    } catch (PDOException $e) {
      die("error sql: " . $e);
    } finally {
      $this->con = null;
    }
  }

  public function getQuotes_aware($id_psychologist)
  {
    $this->getConnection();

    $sql = "
    SELECT 
    quotes.id, quotes.id_student, quotes.id_psychologist, quotes.title, 
    quotes.description, quotes.creation_date, quotes.appointment_date, 
    quotes.finished, quotes.state, users.name as name_psychologist, 
    users.id as id_psychologist
    FROM quotes 
    LEFT JOIN users ON users.id = quotes.id_psychologist
    WHERE finished = FALSE && state = 'pendiente' && quotes.id_psychologist = '$id_psychologist'
    ORDER BY quotes.id ASC;
    ";

    $sql2 = "
    SELECT
    quotes.id, users.name, users.email, users.phone, users.address, users.grade, users.age
    FROM quotes
    LEFT JOIN users ON users.id = quotes.id_student
    WHERE finished = FALSE && state = 'pendiente' && quotes.id_psychologist = '$id_psychologist'
    ORDER BY quotes.id ASC;
    ";
    $resultados = $this->con->query($sql);
    $resultados2 = $this->con->query($sql2);

    $quotes = $resultados->fetchAll(PDO::FETCH_ASSOC);
    $quotes2 = $resultados2->fetchAll(PDO::FETCH_ASSOC);
    $this->con = null;

    $response = array();
    for ($i=0; $i < count($quotes); $i++) { 
      $quote = $quotes[$i];
      $user_info = $quotes2[$i];

      $info = [
        "quote_info" => $quote,
        "user_info" => $user_info
      ];

      $response[] = $info;
    }

    return $response;
  }
}
