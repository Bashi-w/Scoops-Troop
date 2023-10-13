@extends('layouts.guest')
@section('content')
<style>
    header{
        background-color:black;
    }
    footer{
        display:none;
    }
    .order-container{
        display: grid;
        grid-template-columns:2fr 1fr;
        grid-gap:2em;
        margin:10% 10%;
    }
    .order-summary,.order-form{
        
        background: #ffffff; 
    border-radius: 20px;
    padding: 2em;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .cart-item {
        position:relative;
        width:100%;
    }

    .cart-item .toppingBtn{
        position: absolute;
        top:30%;
        right:10%;
        /* left:70%; */

    }

    .toppingBtn , .add, .confirm-btn, #proceedToCheckoutBtn{
    background-color: #4CAF50; 
    color: white; 
    border: none; 
    padding: 10px 20px;
    cursor: pointer; 
    border-radius: 5px; 
}

/* Style the button on hover */
.toppingBtn:hover, .add:hover {
    background-color: #45a049; /* Darker green background color on hover */
}

.add{
    margin-top:5%;
}
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: white;
    margin: 10% auto;
    padding: 4em;
    border: 1px solid #888;
    width: fit-content;
    border-radius: 5px;
}

.close {
    position: absolute;
    right: 10px;
    top: 5px;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

</style>
<div class="order-container">
    <div class="order-summary">
        <h4><b>Order Items</b></h4>
        <div class="summary" id="summary">

        </div>
        <div id="toppingModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3><b>Customise your Icecream</b></h3>
                <select id="toppingDropdown" class="form-control">
                    @foreach($toppings as $topping)
                        <option value="{{ $topping->id }}" data-price="{{ $topping->price }}">{{ $topping->name }}: {{ $topping->price }} LKR</option>
                    @endforeach
                    <option>No Toppings</option>
                </select>
                <p>Select Toppings</p>
                <br>
                <select id="servingDropdown" class="form-control">
                    <option value="Cone: small">Cone: small</option>
                    <option value="Cone: medium">Cone: medium</option>
                    <option value="Cone: large">Cone: large</option>
                    <option value="Cup: Single Scoop">Cup: Single Scoop</option>
                    <option value="Cup: Double Scoop">Cup: Double Scoop</option>
                    <option value="Cup: Triple Scoop">Cup: Triple Scoop</option>
                </select>
                <p>Default serving type is "Cone:small"</p>
                <button onclick="addTopping()" class="add">Add</button>
            </div>
        </div>
    </div>

    <div class="order-form">
        <h4><b>Order Summary</b></h4>
        <table class="table table-borderless">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">Number of items</th>
                <td class="num-items">4</td>
                </tr>
                <tr>
                <th scope="row">Total Product Price</th>
                <td class="total-product-price">1400.00 LKR</td>
                </tr>
                <tr>
                <th scope="row">Topping Price</th>
                <td class="total-topping-price">200.00 LKR</td>
                </tr>
                <tr>
                <th scope="row">Net Total</th>
                <td class="overall-total">1600.00 LKR</td>
                </tr>
            </tbody>
        </table>
        <!-- <label for="branch"><b>Select branch</b></label>
        <br>
        <select id="branchDropdown" class="form-control">
            @foreach($branches as $branch)
                <option value="{{ $branch->id }}">{{ $branch->location }} Branch</option>
            @endforeach
        </select> -->
        <br>
        <button class="confirm-btn">CONFIRM ORDER</button>
    </div>
    </div>

    <!-- Modal HTML -->
<div id="successModal" class="modal">
    <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
        <p>Your order was placed successfully!</p>
        <form id="checkoutForm" action="{{ route('checkout') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" id="order_id" value="">
            <button id="proceedToCheckoutBtn" type="submit">Proceed to Checkout</button>
        </form>

    </div>
</div>

<script>
    window.currentUser = {
        id: {{ Auth::user()->id }},
    };
    console.log("User ID:", window.currentUser.id);
</script>

<script>

 // Get the cart items from local storage
 let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const userId = parseInt(window.currentUser.id, 10);

    const userCart = cart.filter(item => {
    const itemUserId = parseInt(item.user, 10); // Convert item.user to integer
    return itemUserId === userId;
});

showCart();
orderSummary();

   


function showCart() {
    const cartDiv = document.getElementById("summary");
    cartDiv.innerHTML = ""; // Clear the existing content


    let totalPrice = 0;

    for (let i = 0; i < userCart.length; i++) {
        // Create a new <div> element to represent the cart item
        const cartItemDiv = document.createElement("div");
        cartItemDiv.classList.add("cart-item");

        // Create an <img> element for the product image
        const imgElement = document.createElement("img");
        imgElement.src = "{{ asset('storage/') }}/" + userCart[i].image;
        imgElement.alt = userCart[i].name;

        const cartDetails = document.createElement("div");
        cartDetails.classList.add("cart-details");

        // Create a <p> element for the product name
        const nameElement = document.createElement("p");
        nameElement.textContent = userCart[i].quantity + " " + userCart[i].name;
        nameElement.classList.add("name");

        // If a topping is selected, split the name at ":" and append it
        if (userCart[i].topping && userCart[i].topping.name) {
            const [toppingName] = userCart[i].topping.name.split(":");
            nameElement.textContent = userCart[i].quantity + " " + userCart[i].name + " with " + toppingName.trim();
        } else {
            nameElement.textContent = userCart[i].quantity + " " + userCart[i].name;
        }

        const servingElement = document.createElement("p");
        servingElement.textContent = userCart[i].serving;
        servingElement.classList.add("serving");

        // Convert the product price to a number
        const productPrice = parseFloat(userCart[i].price);

        const priceElement = document.createElement("p");
        priceElement.textContent = (productPrice + (userCart[i].topping ? parseFloat(userCart[i].topping.price) : 0)).toFixed(2) + " LKR";
        priceElement.classList.add("price");

        const toppingBtn = document.createElement("button");
        toppingBtn.textContent = "Customise";
        toppingBtn.classList.add("toppingBtn");

        // Append the image, name, and quantity elements to the cart item div
        cartItemDiv.appendChild(imgElement);
        cartItemDiv.appendChild(cartDetails);
        cartDetails.appendChild(nameElement);
        cartDetails.appendChild(priceElement);
        cartDetails.appendChild(servingElement);
        // cartDetails.appendChild(toppingElement);
        cartItemDiv.appendChild(toppingBtn);

        // Append the cart item div to the cart container
        cartDiv.appendChild(cartItemDiv);

        // Calculate the total price including toppings
        totalPrice += (productPrice + (userCart[i].topping ? parseFloat(userCart[i].topping.price) : 0)) * userCart[i].quantity;

        // Attach the event listener to the "Add Topping" button after creating it
        toppingBtn.addEventListener("click", () => openModal(i));
    }

    // Create a total price element
    const totalElement = document.createElement("div");
    totalElement.classList.add("cart-total");
    totalElement.textContent = "Total Price: " + totalPrice.toFixed(2) + " LKR";

    // Append the total price and action buttons to the cart container
    cartDiv.appendChild(totalElement);

    orderSummary();
}



function openModal(index) {
    const modal = document.getElementById("toppingModal");
    modal.style.display = "block";

    // You can store the index of the item in a data attribute
    // to identify which item's topping is being selected
    modal.setAttribute("data-item-index", index);
}

function closeModal() {
    const modal = document.getElementById("toppingModal");
    modal.style.display = "none";

    const successModal = document.getElementById('successModal');
        successModal.style.display = 'none';
}

function addTopping() {
    const modal = document.getElementById("toppingModal");
    const selectedIndex = modal.getAttribute("data-item-index");
    const selectedToppingId = document.getElementById("toppingDropdown").value;
    const selectedServing = document.getElementById("servingDropdown").value; // Get the selected serving option

    // Close the modal
    closeModal();



    // Get the selected topping name and price
    let toppingName = "";
    let toppingPrice = 0;
    if (selectedToppingId !== "No Toppings") {
        const selectedToppingOption = document.querySelector(`#toppingDropdown option[value="${selectedToppingId}"]`);
        toppingName = selectedToppingOption.textContent;
        toppingPrice = parseFloat(selectedToppingOption.getAttribute("data-price"));
    }

    // Update the name element and price for the selected cart item
    const cartItemDiv = document.querySelector(`.cart-item:nth-child(${parseInt(selectedIndex) + 1})`);
    const nameElement = cartItemDiv.querySelector(".name");
    const priceElement = cartItemDiv.querySelector(".price");
    const quantity = userCart[selectedIndex].quantity;
    
    // Always set the name text to include the topping name or "No Toppings"
    if (toppingName) {
        nameElement.textContent = `${quantity} ${userCart[selectedIndex].name} with ${toppingName}`;
    } else {
        nameElement.textContent = `${quantity} ${userCart[selectedIndex].name} (No Toppings)`;
    }


     // Update the serving option
     userCart[selectedIndex].serving = selectedServing;

    // Update the price element based on the new topping price
    priceElement.textContent = `${userCart[selectedIndex].price + toppingPrice} LKR`;

    // Update the topping information in the cart in local storage
    if (selectedToppingId !== "No Toppings") {
        userCart[selectedIndex].topping = {
            id: selectedToppingId,
            name: toppingName,
            price: toppingPrice,
        };
    } else {
        userCart[selectedIndex].topping = null;
    }

    // Update the cart in local storage
    localStorage.setItem('cart', JSON.stringify(userCart));

    // Recalculate and display the total cost
    showCart();
}

function orderSummary() {
    let totalItems = 0;
    let totalProductPrice = 0;
    let totalToppingPrice = 0;
    let overallTotalPrice = 0;

    for (let i = 0; i < userCart.length; i++) {
        const productPrice = parseFloat(userCart[i].price);
        const toppingPrice = userCart[i].topping ? parseFloat(userCart[i].topping.price) : 0;

        totalItems += userCart[i].quantity;
        totalProductPrice += productPrice * userCart[i].quantity;
        totalToppingPrice += toppingPrice * userCart[i].quantity;
        overallTotalPrice += (productPrice + toppingPrice) * userCart[i].quantity;
    }

    // Update the table cells inside the order-form div
    const numItemsCell = document.querySelector(".num-items");
    const totalProductPriceCell = document.querySelector(".total-product-price");
    const totalToppingPriceCell = document.querySelector(".total-topping-price");
    const overallTotalCell = document.querySelector(".overall-total");

    // Update the text content of the table cells
    numItemsCell.textContent = totalItems;
    totalProductPriceCell.textContent = totalProductPrice.toFixed(2) + " LKR";
    totalToppingPriceCell.textContent = totalToppingPrice.toFixed(2) + " LKR";
    overallTotalCell.textContent = overallTotalPrice.toFixed(2) + " LKR";
}

let confirm = document.querySelector('.confirm-btn');
confirm.addEventListener('click', () => {

    const selectedBranch = sessionStorage.getItem('selectedBranch');
    // const branchId = document.getElementById('branchDropdown').value;
    // console.log(branchId);

    // Prepare the order items
    const orderItems = userCart.map(cartItem => ({
        product_id: cartItem.id,
        topping_id: cartItem.topping ? cartItem.topping.id : null,
        topping_price: cartItem.topping ? cartItem.topping.price : null,
        serving: cartItem.serving,
        quantity: cartItem.quantity,
        price: cartItem.price,
    }));

    console.log(orderItems);
    // Create the order data object
    const orderData = {
        order_date: new Date(), 
        order_items: orderItems,
        branch_id: selectedBranch,
    };

    console.log(orderData);

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/confirm', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ orderData }), // Wrap orderData in an object
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        clearUserCart();
        showCart();
        orderSummary();

        const successModal = document.getElementById('successModal');
        successModal.style.display = "block";

        // Access the order ID from the response data
        const orderId = data.order_id;
        console.log(orderId);

        // Set the value of the hidden input field
        const orderIdInput = document.getElementById('order_id');
        orderIdInput.value = orderId;


        const checkoutBtn = document.getElementById('proceedToCheckoutBtn');
        checkoutBtn.addEventListener('click', () => {
            const checkoutForm = document.getElementById('checkoutForm');
            checkoutForm.submit();
        })
    // Submit the form to the checkout route
    
})
    .catch(error => {
        
    });
});

function clearUserCart() {
      const userId = parseInt(window.currentUser.id, 10); // Access the user's ID from the global variable
      // Get the cart items from local storage
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      
      // Filter out items that belong to the logged-in user
      const updatedCart = cart.filter(item => {
          const itemUserId = parseInt(item.user, 10); // Convert item.user to integer
          return itemUserId !== userId;
      });
  
      // Update the cart in local storage with the filtered cart
      localStorage.setItem('cart', JSON.stringify(updatedCart));
  }


// Call the orderSummary function to update the summary when the page loads
orderSummary();







</script>
@endsection