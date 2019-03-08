<?php
// Connecting, selecting database
$dbconn = pg_connect("host=127.0.0.1 dbname=postgres user=cicero password=100TESTE")
    or die('Could not connect: ' . pg_last_error());

// Performing SQL query
//$query = 'CREATE DATABASE CICERO';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Closing connection
pg_close($dbconn);
?>

