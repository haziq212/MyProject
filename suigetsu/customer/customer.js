//to search items in custHompage
function searchMenu() {
  // Get the search input value
  var searchInput = document.getElementById("searchBar").value.toLowerCase();

  // Get all the menu item elements
  var menuItems = document.getElementsByClassName("card");

  // Loop through each menu item and check if it matches the search input
  for (var i = 0; i < menuItems.length; i++) {
    var menuItem = menuItems[i];
    var menuItemText = menuItem.textContent || menuItem.innerText;

    // Hide or show the menu item based on the search input
    if (menuItemText.toLowerCase().indexOf(searchInput) > -1) {
      menuItem.style.display = "";
    } else {
      menuItem.style.display = "none";
    }
  }
}

//to display success adding item to cart
function success() {
  // Create a container div for the message
  var messageContainer = document.createElement("div");
  messageContainer.style.position = "fixed";
  messageContainer.style.top = "50%";
  messageContainer.style.left = "50%";
  messageContainer.style.transform = "translate(-50%, -50%)";
  messageContainer.style.backgroundColor = "white";
  messageContainer.style.border = "2px solid black";
  messageContainer.style.borderRadius = "10px";
  messageContainer.style.padding = "20px";
  messageContainer.style.textAlign = "center";
  messageContainer.style.fontWeight = "bold";
  messageContainer.style.fontSize = "24px";
  messageContainer.style.fontFamily = "comic sans";

  // Create the message element
  var messageText = document.createElement("p");
  messageText.innerText = "Clothes Added To Cart!";

  // Append the message element to the container
  messageContainer.appendChild(messageText);

  // Append the container to the body
  document.body.appendChild(messageContainer);

  // Remove the message after 2 seconds
  setTimeout(function () {
    document.body.removeChild(messageContainer);
  }, 1200000);
}

// Wait for the DOM content to load
document.addEventListener("DOMContentLoaded", function () {
  // Get the card element
  var card = document.querySelector(".card");

  // Add the "show" class to trigger the fade-in animation
  card.classList.add("show");
});

function navigateToPage(event, pageUrl) {
  event.preventDefault(); // Prevent the default link behavior

  // Add the CSS class for the fade-out transition
  document.body.classList.add("transition-fade");

  // Wait for the transition to complete before navigating to the new page
  setTimeout(function () {
    window.location.href = pageUrl;
  }, 500); // Adjust the delay to match the duration of the CSS transition
}
