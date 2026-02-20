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
            
            <a href="" class="link-btn active" aria-current="page">Home</a>
            <a href="Products.php" class="link-btn">Products</a>
            <a href="About-Us.html" class="link-btn">About Us</a>
            <a href="Contact-Us.html" class="link-btn">Contact Us</a>
            </div>
            
        </nav>
    </Header>
    <main>
        <section class="carousel">
            
         <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/ppppp.jpg" style="width: 100%; height: 100%;">          
            <div class="container">
              <div class="carousel-caption text-start">
                <h1>Promo 1</h1>
                <p class="opacity-75">
                 promo number 1
                </p>
                <p>
                  <a class="btn btn-lg btn-primary" 
                  style="background-color: black;
                         border: 1px solid white;"
                   href="#">Sign up today</a>
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/ranni.png" style="width: 100%; height: 100%;">
            </svg>
            <div class="container">
              <div class="carousel-caption">
                <h1>Promo 2</h1>
                <p>
                  promo number 2
                </p>
                <p><a class="btn btn-lg btn-primary" 
                  style="background-color: black;
                         border: 1px solid white;"
                   href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/bolai.jpg" alt="" style="width: 100%; height: 100%;">
            </svg>
            <div class="container">
              <div class="carousel-caption text-end">
                <h1>Promo 3</h1>
                <p>
                  promo number 3
                </p>
                <p>
                  <a class="btn btn-lg btn-primary" 
                  style="background-color: black;
                         border: 1px solid white;"
                   href="#">Look into it</a>
                </p>
              </div>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
        <script src="bootstrap/bootstrap.bundle.min.js">
            
        </script>
         
        </section>

        

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

        <!-- modal -->

        <dialog id="modal">
        <div class="modal-wrap">
            <form action="buyNow.php" method="post">


            <input type="hidden" id="p-m-id" name="id">
            <input type="hidden" id="p-m-total" name="total">
            <input type="hidden" id="p-m-hstock">

            <div class="sect-1">
                <div class="modal-img">
                    <img src="img/" id="p-m-img" style="width: 100%; height: 100%; border-radius: 10px;">
                </div>
            </div>
            <div class="sect-2">
                <div class="modal-info">
                    <table class="m-info-tbl">
                        <tr>
                            <th colspan="2"><strong id="p-m-name">name</strong></th>
                        </tr>

                        <tr>
                            <td>
                                <label class="label-modal">Price: ₱</label>
                            </td>
                            <td>
                                <label id="p-m-price"></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label-modal">Stocks: </label>
                            </td>
                            <td>
                                <label id="p-m-stock"></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label-modal" >Amount: </label>
                            </td>
                            <td>
                                 <input id="amnt-modal" type="number" oninput="updateTotal()" name="amount">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label-modal">Total: </label>
                            </td>
                            <td>
                                <input id="total-modal" type="text" readonly>
                            </td>
                        </tr>
                    </table>
                    <table class="p-m-btns">
                        <tr>
                            <td>
                                <button class="product-btn" type="button" onclick="checkOut()">Check Out</button>
                                <button class="product-btn" type="button" onclick="modalClose()">Cancel</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <dialog id="check-out">
                <center>
                    <strong>Customer Info</strong>
                </center>
                

                <table>
                    <tr>
                        <td>
                            <label>Full name: </label>
                        </td>
                        <td>
                            <input type="text" class="co-input" name="c-name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> Contact No.:</label>
                        </td>
                        <td>
                            <input type="text"  class="co-input" name="c-num">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> Address:</label>
                        </td>
                        <td>
                            <input type="text"  class="co-input" name="c-address">
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>
                            <button type="submit"class="product-btn" name="home">Purchase</button>
                        </td>
                        <td>
                            <button type="button" class="product-btn" onclick="checkCancel()">Cancel</button>
                        </td>
                    </tr>
                </table>

            </dialog>
        </form>
        </div>
    </dialog>                
        </section>
    </main>
  
    <script>
        var pPrice = 0;

        function buyNow(id, name, price, stock, img){
            pPrice = parseFloat(price);
            document.getElementById("modal").showModal();
            
            
            document.getElementById("total-modal").value =  "₱" + pPrice.toFixed(2);
            // document.getElementById("p-m-total").value = pPrice.toFixed(2);
            document.getElementById("amnt-modal").value = 1;
            

            document.getElementById("p-m-id").value = id;
            document.getElementById("p-m-hstock").value = stock;
            // alert("hey");
            document.getElementById("p-m-name").textContent = name;
            document.getElementById("p-m-price").textContent = pPrice.toFixed(2);   
            document.getElementById("p-m-stock").textContent = stock;
            document.getElementById("p-m-img").src = "img/" + img;
            document.getElementsByTagName("body").disabled = 'true';
            

        }

        function modalClose() {
            document.getElementById("modal").close();
        }

        function updateTotal() {
          // alert("hey");
          const amountBox = document.getElementById("amnt-modal");
          const totalBox = document.getElementById("p-m-price");
          

          var amountVal = amountBox.value;
          var totalVal = totalBox.textContent;

          var totalRes = totalVal * amountVal;
          

          document.getElementById("total-modal").value =  "₱" + totalRes.toFixed(2);
          document.getElementById("p-m-total").value =  totalRes.toFixed(2);
        }

         function checkOut() {
          const amountCheck = document.getElementById("amnt-modal").value;
          const stocks = document.getElementById("p-m-hstock").value;

        //   var ball = stocks + 1;
         

          if (amountCheck <= 0){
            alert("Entered an invalid amount.");
          } 
          
          else if (amountCheck != stocks || amountCheck > stocks){
            alert("Amount exceeds available stock! only " + stocks + " left.");
            
          }
          else if (amountCheck > 0 && amountCheck <= stocks){
            document.getElementById("check-out").showModal();
          }
        }
        function checkCancel() {
            document.getElementById("check-out").close();
        }
    </script>
</body>
</html>