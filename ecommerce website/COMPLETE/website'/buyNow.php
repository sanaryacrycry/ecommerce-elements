<?php

include "db.php";

$id = $_POST["id"];
$amount = $_POST["amount"];
$total = $_POST["total"];

$cName = $_POST["c-name"];
$cContact = $_POST["c-num"];
$cAdress = $_POST["c-address"];

$sql = "SELECT * FROM prodtbl WHERE p_id = $id";
$result = $con->query($sql);

$row = $result->fetch_assoc();

if ($amount == 1){
    $total = $row['p_price'];
}

// make order 
 $orderId = 1;
$res = $con->query("SELECT MAX(o_id) AS o_id FROM ordertbl");
if ($res && $ids = $res->fetch_assoc()){
    $orderId = $ids['o_id'] + 1;
}

$sql_insert = "INSERT INTO `ordertbl`(`o_id`, `p_id`, `p_name`, `amount`, `total_price`, `c_name`, `c_num`, `c_address`) 
                VALUES ('$orderId','$row[p_id]','$row[p_name]','$amount','$total','$cName','$cContact','$cAdress')";

                    if($con->query($sql_insert) === TRUE) {
                         $newStock = $row['p_stock'] - $amount;
                        // update stocks
                        $sql_u = "UPDATE prodtbl
                        SET p_stock='$newStock'
                        WHERE p_id='$id'";

                        if (isset($_POST['home'])) {

                        if($con->query($sql_u) === TRUE) {
                            echo "<script> alert('Thank you for buying!!!'); window.location.href='Home.php';</script>";
                        }
                        }

                        if (isset($_POST['products'])) {
                            if($con->query($sql_u) === TRUE) {
                            echo "<script> alert('Thank you for buying!!!'); window.location.href='Products.php';</script>";
                        }
                        }
                    } 
                    else{
                        echo "Error: " . $sql . "<br>" . $con->error;
                    }