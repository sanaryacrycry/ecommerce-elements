<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <!-- header -->
    <header>
        <nav>
            <div class="navi">
                <label class="logo">LOGO</label>

                <div class="nav-btns">
                    <a href="">HOME</a>
                    <a href="">PRODUCTS</a>
                    <a href="">ADMIN</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="main-wrap">
        
        <!-- promos  -->
        <section class="promos">
            <div class="promo-img">
                <img src="bakit png.png ">
            </div>
            <div class="promo-dsc">
                <table class="promos-tbl">
                    <tr>
                        <td>
                            <strong>On sale</strong><br>
                            <label>up to 60% OFF</label>
                        </td>
                        <td>
                            <strong>Free shipping</strong><br>
                            <label>on all orders over ₱99</label>
                        </td>
                        <td>
                            <strong>Money back guarantee</strong><br>
                            <label>30 days money back guarantee</label>
                        </td>
                    </tr>
                </table>
            </div>
        </section>

        <!-- new products (top 4)-->
        <section class="new-products">
            <div class="products">
            <?php
            include "db.php";

            $sql = "SELECT * FROM prodtbl LIMIT 4";
            $result = $con->query($sql);

            ?>

                <div class="title">
                    <h2>New Products</h2>
                </div>
                <hr style="color:#e3d1c9;">
                    <div class="product-grid">
                <?php
                if($result->num_rows > 0){
                    while($product = $result->fetch_assoc()){
                ?>
                
                        <div class="product-box">
                            <div class="product-img">
                                <img src="<?php echo $product['p_img']; ?>" class="p-img" id="p-img">
                            </div>

                            <div class="product-info">
                                <label class="p-name"><?php echo $product['p_name']; ?></label><br>
                                <strong>Price:</strong><label class="p-info"><?php echo $product['p_price']; ?></label><br>
                                <strong>Available:</strong><label class="p-info"><?php echo $product['p_stock']; ?></label>
                            </div>

                            <div class="product-btn">
                                <button type="button" class="p-btn" onclick="buyNow(<?php echo $product['p_id']; ?>,'<?php echo $product['p_name']; ?>', 
                    <?php echo $product['p_price']; ?>, <?php echo $product['p_stock']; ?>,'<?php echo $product['p_img']; ?>')"
                    <?php if($product['p_stock'] == 0){ echo "disabled";}?>>Buy Now</button>
                            </div>

                        </div>
                <?php 

                                    }
                }else{
                    echo "<h1> N Products Available.</h1>";
                }

                ?>
                </div>

                <dialog id="modal">
                    <form action="" method="post">
                        <input type="hidden" name="p-m-id" id="h-id" value="">
                        <input type="hidden" name="total" id="h-t-price">
                        <input type="hidden" id="h-price" value="67">

                    <div class="modal-wrap"> 
                        <h1>Check out</h1>
                        <div class="modal-left">
                            <div class="modal-img-box">
                                <img src="bakit png.png" alt="">
                            </div>
                        </div>
                        <div class="modal-right">
                            <div class="modal-info">
                                <table class="m-info-tbl">
                                    <tr>
                                        <td><label class="modal-label">Product:</label></td><td class="modal-data"><label id="p-m-name"></label></td>
                                    </tr>
                                    <tr>
                                        <td><label class="modal-label">Price:</label></td><td class="modal-data"><label id="p-m-price"></label></td>
                                    </tr>
                                    <tr>
                                        <td><label class="modal-label">Stocks:</label></td><td class="modal-data"><label id="p-m-stock"></label></td>
                                    </tr>
                                </table>
                                
                                
                                
                                <table class="modal-tbl">
                                    <tr>
                                        <td><label class="modal-label">Total Price:</label></td>
                                        <td><input type="text" id="modal-total" name="total" readonly value="67"></td>
                                    </tr>
                                    <tr>
                                        <td><label class="modal-label">Amount</label></td>
                                        <td><input type="number" id="modal-amnt" name="amnt" min="1" value="1" oninput="totalCalc()"></td>
                                    </tr>
                                </table>
                                <table class="modal-btns">                                    
                                    <tr>
                                        <td><button type="button" onclick="checkOut()">Check Out</button></td>
                                        <td><button type="button" onclick="closeModal()">Cancel</button></td>
                                    </tr>
                                </table>
                                
                               

                            </div>
                        </div>
                    </div>
                </form>
                </dialog>

            </div>
            <script>
                function buyNow(id, name, price, stock, img){
                    pPrice = parseFloat(price);
                    document.getElementById("modal").showModal();

                    document.getElementById("modal-total").value =  "₱" + pPrice.toFixed(2);
                    document.getElementById("modal-amnt").value = 1;

                    document.getElementById("h-id").value = id;
                    document.getElementById("h-t-price").value = pPrice;
                    document.getElementById("p-m-name").textContent = name;
                    document.getElementById("p-m-price").textContent = pPrice.toFixed(2);   
                    document.getElementById("p-m-stock").textContent = stock;
                    document.getElementById("p-m-img").src = "img/" + img;
                }
                function closeModal(){
                    document.getElementById("modal").close();
                }
                function totalCalc(){
                    const initPrice = document.getElementById("h-price");
                    const amnt = document.getElementById("modal-amnt");

                    var price = initPrice.value;
                    var amntVal = amnt.value;

                    var result = amntVal * price;
                    document.getElementById("modal-total").value = "₱" + result.toFixed(2);
                }
            </script>
        </section>

        <footer class="footer">
            <div class="footer-info">
                <div class="footer-space">

                </div>
                <table class="footer-tbl">
                    <tr>
                        <td>
                            <strong>General</strong>
                        </td>
                        <td>
                            <strong>Socials</strong>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            LINKS
                        </td>
                        <td>
                            links
                        </td>
                    </tr>
                    <tr>
                        <td>
                            LINKS
                        </td>
                        <td>
                            links
                        </td>
                    </tr>
                    <tr>
                        <td>
                            LINKS
                        </td>
                        <td>
                            links
                        </td>
                    </tr>
                    <tr>
                        <td>
                            LINKS
                        </td>
                        <td>
                            links
                        </td>
                    </tr>

                </table>
            </div>
        </footer>


        </div>
    </main>
    
</body>
</html>