<?php
$id_user = $_SESSION["user"]["id"];

require_once "../app/models/notes.php";

$notesModel = new NotesModel();

$response = $notesModel->checkNotes($id_user);
$_SESSION["notes"] = $response;
