<?php
include "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $p_id = $_POST["p_ID"];
    $p_name = $_POST["p_name"];
    $p_price = $_POST["p_price"];
    $p_stock = $_POST["p_stock"];
    $p_img = $_POST["p_img"];

    if(isset($_POST['add'])){

        $sql = "INSERT INTO `prodtbl` (`p_id`,`p_name`,`p_price`,`p_stock`,`p_img`)
                VALUE ('$p_id', '$p_name', '$p_price', '$p_stock', '$p_img')";

                if ($con->query($sql) == TRUE) {
                    echo "<script> alert('Product added!!!'); window.location.href='Admin.php'; </script>";
                    exit();
                }
                else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
    }


    if(isset($_POST['update'])) {

    if($p_img == ""){
         $sql = "UPDATE prodtbl
                SET p_name='$p_name', p_price='$p_price', p_stock='$p_stock'
                WHERE p_id='$p_id'";
    }else{
        $sql = "UPDATE prodtbl
                SET p_name='$p_name', p_price='$p_price', p_stock='$p_stock', p_img='$p_img'
                WHERE p_id='$p_id'";
    }

        

                if($con->query($sql) === TRUE) {
                    echo "<script> alert('Product updated successfully!!!'); window.location.href='Admin.php'; </script>";
                    exit();
                }
                else{
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
    }

}


$con->close();
?>