<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/carousel.css">
    <link rel="stylesheet" href="ecomm.css">


    <?php
    include "db.php";

    $nextID = 1;
    $results = $con->query("SELECT MAX(p_id) AS p_id FROM prodtbl");
    if ($results && $ids = $results->fetch_assoc()){
        $nextID = $ids['p_id'] + 1;
    }

    ?>
    
</head>
<body>
    <Header>
        <nav>
            <img src="img/woa.jpg" alt="" class="logo"> 
            <div class="links">
            
            <a href="Home.php" class="link-btn" >Home</a>
            <a href="Products.php" class="link-btn">Products</a>
            <a href="About-Us.html" class="link-btn">About Us</a>
            <a href="Contact-Us.html" class="link-btn">Contact Us</a>
            </div>
            
        </nav>
    </Header>
    <main>
         <section>
            <div class="wrap">

                <div class="sect-1">


                    <div class="inpt-field">
                        <form action="input.php" method="post">
                            <h1>Input product info</h1>
                            <table>
                                <tr>
                                    <td><label>Product ID: </label></td>
                                    <td><input type="text" class="inpt-box" id="p_ID" name="p_ID" value="<?php echo $nextID; ?>" readonly></td>
                                </tr>

                                <tr>
                                    <td><label>Product Name: </label></td>
                                    <td><input type="text" class="inpt-box" id="p_name" name="p_name"></td>
                                </tr>
                                
                                <tr>
                                    <td><label>Product price: </label></td>
                                    <td><input type="number" class="inpt-box" id="p_price" name="p_price"></td>
                                </tr>

                                <tr>
                                    <td><label>Stock: </label></td> 
                                    <td><input type="number" class="inpt-box" id="p_stock" name="p_stock"></td>
                                </tr>

                               
                            </table>
                            <center>
                                <div class="img-input">
                                    <table>
                                        <td><label class="img-">Image: </label></td><td><input type="file" name="p_img"></td>
                                    </table>
                                    
                                </div>
                            </center>
                            
                            <table>
                                <tr>
                                    <td><Button type="submit" name="add" class="product-btn">Add product</Button></td>
                                    <td><Button type="Reset" class="product-btn ">Reset</Button></td>
                                    <td><Button type="submit" name="update" class="product-btn ">update</Button></td>
                                </tr>
                                
                            </table>

                        </form>


                    </div>
                </div>

                <div class="sect-2">
                    <div class="prod-tbl">
                        <table class="p-tbl">
                            <thead>
                                <th class='tabhead'>Product ID</th>
                                <th class='tabhead'>Product name</th>
                                <th class='tabhead'>Produxt price</th>
                                <th class='tabhead'>Available stock</th>
                                <th class='tabhead'>Product image</th>
                            </thead>

                            <tbody>
                                <?php
                                $sql = "SELECT * FROM prodtbl";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    while($product = $result-> fetch_assoc()){
                                    echo "
                                        <tr>
                                            <td class='tab'>{$product['p_id']}</td>
                                            <td class='tab'>{$product['p_name']}</td>
                                            <td class='tab'>{$product['p_price']}</td>
                                            <td class='tab'>{$product['p_stock']}</td>
                                            <td class='tab'><img class='tab-img' src='img/{$product['p_img']}'></td>
                                        </tr>
                                        ";
                                    }
                                }
                                else {
                                    echo "<tr> <td colspan='5' class='tab'> No products available. </td></tr> ";
                                }
                                $con->close();
                                ?>

                            </tbody>
                        </table>

                        <script>
                            fetch('fetch_products.php')
                                .then(response => response.json())
                                .then(data => {
                                    const tbody = document.querySelector("table tbody");
                                    tbody.innerHTML = "";

                                    data.forEach(Product => {
                                        const row = document.createElement("tr");
                                        row.innerHTML = `
                                            <td>${Product.p_ID}</td>
                                            <td>${Product.p_name}</td>
                                            <td>${Product.p_price}</td>
                                            <td>${Product.p_stock}</td>
                                            `;
                                            tbody.appendChild(row);            
                                    });
                                })
                                .catch(error => console.error("Error fetching data: ", error));

                                document.addEventListener("DOMContentLoaded", function (){
                                    const rows = document.querySelectorAll(".p-tbl tbody tr");

                                    rows.forEach(row => {
                                        row.addEventListener("click", function (){
                                            const cells = row.querySelectorAll("td");

                                            // document.getElementById("p_ID").value = "balls";

                                            document.getElementById("p_ID").value = cells[0].textContent;
                                            document.getElementById("p_name").value = cells[1].textContent;
                                            document.getElementById("p_price").value = cells[2].textContent;
                                            document.getElementById("p_stock").value = cells[3].textContent;
                                            // // alert("hey");

                                        });

                                    });
                                });
                        </script>

                    </div>
                </div>
                
            </div>
         </section>
    </main>
  
</body>
</html>