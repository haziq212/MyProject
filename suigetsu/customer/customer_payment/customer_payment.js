//show alert message 
function showAlert() {
    var alertBox = document.createElement("div");
    alertBox.className = "alert-box";
    
    var closeButton = document.createElement("button");
    closeButton.className = "close-button";
    closeButton.innerHTML = "Close";
    closeButton.addEventListener("click", function() {
      alertBox.remove();
    });
    
    var message = document.createElement("p");
    message.innerHTML = "There Is No Item In The Cart";w
    
    alertBox.appendChild(message);
    alertBox.appendChild(closeButton);
    document.body.appendChild(alertBox);
  }
   