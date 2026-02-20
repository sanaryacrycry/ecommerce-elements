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

                document.getElementById("p_ID").value = cells[0].textContent;
                document.getElementById("p_name").value = cells[1].textContent;
                document.getElementById("p_price").value = cells[2].textContent;
                document.getElementById("p_stock").value = cells[3].textContent;

            });

        });
    });

    var pPrice = 0;

    function buyNow(id, name, price, stock, img){
        pPrice = parseFloat(price);
        document.getElementById("modal").showModal();

        document.getElementById("total-modal").value =  "₱" + pPrice.toFixed(2);
        document.getElementById("amnt-modal").value = 1;

        document.getElementById("p-m-id").value = id;
        document.getElementById("p-m-name").textContent = name;
        document.getElementById("p-m-price").textContent =  "₱" + pPrice.toFixed(2);                        
        document.getElementById("p-m-stock").textContent = stock;
        document.getElementById("p-m-img").src = "img/" + img;
        

    }

    function modalClose() {
         document.getElementById("modal").close();
    }