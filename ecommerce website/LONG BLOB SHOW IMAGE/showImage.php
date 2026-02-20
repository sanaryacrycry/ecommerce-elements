<?php
include "conn.php";

if (!isset($_GET['id'])) die("No ID specified.");

$id = intval(value: $_GET['id']);

$sql = "SELECT product_image FROM product_tbl WHERE product_id = $id";
$result = $con->query(query: $sql);

if ($result->num_rows == 0) die("No Image found.");

$row = $result->fetch_assoc();

$finfo = finfo_open();
$type = finfo_buffer(finfo: $finfo,string: $row['product_image'], flags: FILEINFO_MIME_TYPE);
finfo_close(finfo: $finfo);


header(header: "Content-Type: $type");
echo $row['product_image'];
?>