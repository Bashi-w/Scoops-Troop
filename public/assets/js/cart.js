// Get all the "Add to Cart" icons
const addToCartIcons = document.querySelectorAll('.add-to-cart-icon');
let cartDiv = document.getElementById("cart");
const branch = sessionStorage.getItem('selectedBranch');

// Add a click event listener to each icon
addToCartIcons.forEach(icon => {
    icon.addEventListener('click', function () {
        // Get the product ID from the clicked icon's data attributes
        const productId = this.getAttribute('data-product-id');
        const productName = this.getAttribute('data-product-name');
        const productPrice = this.getAttribute('data-product-price');
        const productImage = this.getAttribute('data-product-image');
        const userId = this.getAttribute('data-user-id');
        const branch = sessionStorage.getItem('selectedBranch');

        // Create an object to represent the product
        const product = {
            id: productId,
            name: productName,
            price: productPrice,
            image: productImage,
            user: userId,
            branch: branch,
            quantity: 1,
            topping:null,
            serving: "Cone:small"
        };

        // Check if there's an existing cart in local storage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Check if the product is already in the cart
        const existingProductIndex = cart.findIndex(item => item.id === productId && item.user === userId);

        if (existingProductIndex !== -1) {
            // If the product is already in the cart, increase its quantity
            cart[existingProductIndex].quantity += 1;
        } else {
            // If the product is not in the cart, add it
            cart.push(product);
        }

        // Update the cart in local storage
        localStorage.setItem('cart', JSON.stringify(cart));

        updateCartIcon(); 
        showCart();

    });
});

function updateCartIcon() {
    // Get the cart items from local storage

    const userId = parseInt(window.currentUser.id, 10); // Access the user's ID from the global variable

    // Filter cart items by the user ID
    console.log("userId:", userId);

// Get the cart items from local storage and log them
const cart = JSON.parse(localStorage.getItem('cart')) || [];
console.log("Cart items:", cart);

// Filter cart items by both user ID and branch
const userCart = cart.filter(item => {
    const itemUserId = parseInt(item.user, 10); // Convert item.user to integer
    return itemUserId === userId && item.branch === branch; // Filter by both user ID and branch
});

  
    // Calculate the total quantity
    let totalQuantity = 0;
    for (const item of userCart) {
        totalQuantity += item.quantity;
    }
  
    // Update the quantity in the HTML
    const quantityElement = document.getElementById('quantity');
    if (quantityElement) {
        quantityElement.textContent = totalQuantity.toString();
    }
  
  }
  
  function showCart() {
    const cartDiv = document.getElementById("cart");
    cartDiv.innerHTML = ""; // Clear the existing content
  
    // Get the cart items from local storage
    const userId = parseInt(window.currentUser.id, 10); // Access the user's ID from the global variable

    let totalPrice = 0;

    // Filter cart items by the user ID
    console.log("userId:", userId);

// Get the cart items from local storage and log them
const cart = JSON.parse(localStorage.getItem('cart')) || [];
console.log("Cart items:", cart);

// Filter cart items by both user ID and branch
const userCart = cart.filter(item => {
    const itemUserId = parseInt(item.user, 10); // Convert item.user to integer
    return itemUserId === userId && item.branch === branch; // Filter by both user ID and branch
});


console.log("User's Cart:", userCart);
  
        for (let i = 0; i < userCart.length; i++) {
          // Create a new <div> element to represent the cart item
          const cartItemDiv = document.createElement("div");
          cartItemDiv.classList.add("cart-item");
  
          const close = document.createElement("i");
          close.classList.add("fas", "fa-times", "close-icon");
  
          close.addEventListener('click', function () {
          // Find the index of the item to remove in the cart array
          const itemIndexToRemove = userCart.findIndex(item => item.id === userCart[i].id);
  
          if (itemIndexToRemove !== -1) {
              // Remove the item from the cart array
              userCart.splice(itemIndexToRemove, 1);
  
              // Update the cart in local storage
              localStorage.setItem('cart', JSON.stringify(userCart));
  
              // Refresh the cart displayed on the page
              showCart();
  
              // Recalculate the total price
              calculateTotalPrice();
              updateCartIcon();
          }
      });
     
  
      // Create an <img> element for the product image
      const imgElement = document.createElement("img");
      imgElement.src = productImageBaseUrl + userCart[i].image;
      imgElement.alt = userCart[i].name;
  
      const cartDetails = document.createElement("div");
      cartDetails.classList.add("cart-details");
  
      // Create a <p> element for the product name
      const nameElement = document.createElement("p");
      nameElement.textContent = userCart[i].name;
      nameElement.classList.add("name");
  
      const quantityDiv = document.createElement("div");
      quantityDiv.classList.add("quantity-div");
  
      // Create a <p> element for the product quantity
      const quantityElement = document.createElement("p");
      quantityElement.textContent =userCart[i].quantity;
      quantityElement.classList.add("quantity");
  
       // Create increase and decrease buttons
      const decreaseButton = document.createElement("button");
      decreaseButton.textContent = "-";
      decreaseButton.classList.add("quantity-decrease");
      const increaseButton = document.createElement("button");
      increaseButton.textContent = "+";
      increaseButton.classList.add("quantity-increase");
  
      // Add click event listeners to the increase and decrease buttons
      decreaseButton.addEventListener('click', function () {
          if (userCart[i].quantity > 1) {
            userCart[i].quantity--;
              quantityElement.textContent = userCart[i].quantity;
  
              // Update the quantity in the local storage for the selected product
              updateProductQuantityInLocalStorage(userCart[i].id, userCart[i].quantity);
  
              calculateTotalPrice();
          }
      });
  
      increaseButton.addEventListener('click', function () {
        userCart[i].quantity++;
          quantityElement.textContent = userCart[i].quantity;
  
          // Update the quantity in the local storage for the selected product
          updateProductQuantityInLocalStorage(userCart[i].id, userCart[i].quantity);
  
          calculateTotalPrice();
      });
  
      const priceElement = document.createElement("p");
      priceElement.textContent = userCart[i].price + "LKR";
      priceElement.classList.add("price");
  
      // Append the image, name, and quantity elements to the cart item div
      cartItemDiv.appendChild(imgElement);
      cartItemDiv.appendChild(cartDetails);
      cartDetails.appendChild(nameElement);
      cartDetails.appendChild(priceElement);
      cartDetails.appendChild(quantityDiv);
      quantityDiv.appendChild(decreaseButton);
      quantityDiv.appendChild(quantityElement);
      quantityDiv.appendChild(increaseButton);
      cartItemDiv.appendChild(close);
      
  
      // Append the cart item div to the cart container
      cartDiv.appendChild(cartItemDiv);
  
      totalPrice += parseFloat(userCart[i].price) * userCart[i].quantity;
    }
  
    // Create a total price element
    const totalElement = document.createElement("div");
    totalElement.classList.add("cart-total");
    totalElement.textContent = "Total Price: " + totalPrice.toFixed(2) + " LKR";
  
    // Create cart action buttons
    // const actionsElement = document.createElement("div");
    // actionsElement.classList.add("cart-actions");
    // const checkoutLink = document.createElement("a");
    // checkoutLink.href = "/checkout"; 
    // checkoutLink.textContent = "Proceed to Checkout";
    // actionsElement.appendChild(checkoutLink);
  
    // Append the total price and action buttons to the cart container
    cartDiv.appendChild(totalElement);
    // cartDiv.appendChild(actionsElement);
  }
  
  updateCartIcon();
  showCart();
  
  let clearBtn = document.getElementById("clear-btn");
  clearBtn.addEventListener('click', function () {
    console.log('button clicked');
      // Clear the cart for the logged-in user
      clearUserCart();
  })
  
  // Function to clear the cart for the logged-in user
  function clearUserCart() {
    const userId = parseInt(window.currentUser.id, 10); // Access the user's ID from the global variable
    const branch = sessionStorage.getItem('selectedBranch');

    // Get the cart items from local storage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Filter cart items by both user ID and branch to remove only the user's items
    cart = cart.filter(item => {
        const itemUserId = parseInt(item.user, 10); // Convert item.user to integer
        return itemUserId !== userId || item.branch !== branch;
    });

    // Update the cart in local storage
    localStorage.setItem('cart', JSON.stringify(cart));

    // Refresh the cart displayed on the page
    showCart();
    updateCartIcon();
}

  
  
  // Function to update the quantity in the local storage for a specific product
  function updateProductQuantityInLocalStorage(productId, quantity) {
      // Get the cart items from local storage
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
  
      // Find the product in the cart
      const productIndex = cart.findIndex(item => item.id === productId);
  
      if (productIndex !== -1) {
          // Update the quantity for the specific product
          cart[productIndex].quantity = quantity;
  
          // Update the cart in local storage
          localStorage.setItem('cart', JSON.stringify(cart));
      }
  
      updateCartIcon();
  }
  
  function calculateTotalPrice() {
      // Get the cart items from local storage
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      let totalPrice = 0;
  
      for (let i = 0; i < cart.length; i++) {
          totalPrice += parseFloat(cart[i].price) * cart[i].quantity;
      }
  
      // Update the total price element in the HTML
      const totalElement = document.querySelector(".cart-total");
      if (totalElement) {
          totalElement.textContent = "Total Price: " + totalPrice.toFixed(2) + " LKR";
      }
  }