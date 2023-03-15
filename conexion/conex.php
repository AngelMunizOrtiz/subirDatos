<?php


$mysqli = new mysqli('localhost', 'root', '', 'crudlaravel');

if ($mysqli->connect_errno > 0) {
    die("Error en la conexión" . $mysqli->connect_error);
}
