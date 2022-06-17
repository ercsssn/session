<?php 
  require_once 'login.php';

  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (\PDOException $e)
  {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }

  $query = "CREATE TABLE users (
    forename VARCHAR(32) NOT NULL,
    surname  VARCHAR(32) NOT NULL,
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
  )";

  $result = $pdo->query($query);

  $forename = 'John';
  $surname  = 'Ericsson';
  $username = 'ercsssn';
  $password = 'mysecret';
  $hash     = password_hash($password, PASSWORD_DEFAULT);
  
  add_user($pdo, $forename, $surname, $username, $hash);

  $forename = 'Jhe';
  $surname  = 'Dadap';
  $username = 'ucoin';
  $password = 'ucoin@2022';
  $hash     = password_hash($password, PASSWORD_DEFAULT);
  
  add_user($pdo, $forename, $surname, $username, $hash);

  function add_user($pdo, $fn, $sn, $un, $pw)
  {
    $stmt = $pdo->prepare('INSERT INTO users VALUES(?,?,?,?)');

    $stmt->bindParam(1, $fn, PDO::PARAM_STR,  32);
    $stmt->bindParam(2, $sn, PDO::PARAM_STR,  32);
    $stmt->bindParam(3, $un, PDO::PARAM_STR,  32);
    $stmt->bindParam(4, $pw, PDO::PARAM_STR, 255);

    $stmt->execute([$fn, $sn, $un, $pw]);
  }
?>

