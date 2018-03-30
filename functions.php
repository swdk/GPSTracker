<?php
//definie function for db connections and query
function dbconnect(){
    DEFINE('DB_USER', 'root');
    DEFINE('DB_PASSWORD', 'root');
    DEFINE('DB_HOST', '127.0.0.1');
    DEFINE('DB_NAME', 'tracer');
    $db = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    $db->query("SET NAMES 'utf8'");
    $db->query("SET CHARACTER_SET_CLIENT=utf8");
    $db->query("SET CHARACTER_SET_RESULTS=utf8");
    return $db;
}
?>