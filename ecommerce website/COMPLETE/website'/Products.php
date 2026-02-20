<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/carousel.css">
    <link rel="stylesheet" href="ecomm.css">
    
</head>
<body>
    <Header>
        <nav>
            <img src="img/woa.jpg" alt="" class="logo"> 
            <div class="links">
            
            <a href="Home.php" class="link-btn">Home</a>
            <a href="Products.php" class="link-btn active" aria-current="page">Products</a>
            <a href="About-Us.html" class="link-btn">About Us</a>
            <a href="Contact-Us.html" class="link-btn">Contact Us</a>
            </div>
            
        </nav>
    </Header>
    <section class="products">
                    <?php 
                        include "db.php";

                        $sql = "SELECT * FROM prodtbl";
                        $result = $con->query($sql);
                    ?>  
        <div class="product-container">
                    <?php
                    if($result->num_rows >0){
                        while($product = $result->fetch_assoc()){
                    
                    ?>
            

            <div class="product-box">
                <div class="p-img-holder">
                    <img src="img/<?php echo $product['p_img']; ?>" class="product-img">
                </div>
                <h1 class="bolass"><?php echo $product['p_name']; ?></h1>
                <strong>Price: </strong><label for=""><?php echo $product['p_price']; ?></label><br>
                <strong>Stocks: </strong><label for=""><?php echo $product['p_stock']; ?></label><br>
                
                <div class="p-btns">
                    <button class="product-btn">Add to cart</button>
                    <button class="product-btn" onclick="buyNow(<?php echo $product['p_id']; ?>,'<?php echo $product['p_name']; ?>', 
                    <?php echo $product['p_price']; ?>, <?php echo $product['p_stock']; ?>,'<?php echo $product['p_img']; ?>')"
                    <?php if($product['p_stock'] == 0){ echo "disabled";}?>>Buy now</button>
                </div>
                
            </div>

            <?php 
            }}
            else{
                echo "<h1>No Products Available.<h1>";
            }
            ?>
                    

            </div>
        </div>
                       
        </section>

  
</body>
</html>