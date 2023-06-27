const pwShowHide = document.querySelectorAll(".pw_hide"),
  signupBtn = document.querySelector("#signup"),
  formContainer = document.querySelector(".form_container"),
  formCloseBtn = document.querySelector(".form_close"),
  formOpenBtn = document.querySelector("#form-open"),
  home = document.querySelector(".home"),
  loginBtn = document.querySelector("#login");

formOpenBtn.addEventListener("click", () => home.classList.add("show"));
formCloseBtn.addEventListener("click", () => home.classList.remove("show"));

//password show (eye)
pwShowHide.forEach((icon) => {
  icon.addEventListener("click", () => {
    let getPwInput = icon.parentElement.querySelector("input");
    if (getPwInput.type === "password") {
      getPwInput.type = "text";
      icon.classList.replace("uil-eye-slash", "uil-eye");
    } else {
      getPwInput.type = "password";
      icon.classList.replace("uil-eye", "uil-eye-slash");
    }
  });
});
// end password show

//function untuk matched password1 dan password2
function cmpass() {
  var password = document.getElementById("passwordSignUp").value;
  var confirmPassword = document.getElementById("password2").value;
  if (password != confirmPassword) {
    document.getElementById("wrong_pass_alert").style.color = "red";
    document.getElementById("wrong_pass_alert").innerHTML =
      "☒ Use same password";
    document.getElementById("button").disabled = true;
    document.getElementById("button").style.opacity = 0.4;
  } else {
    document.getElementById("wrong_pass_alert").style.color = "green";
    document.getElementById("wrong_pass_alert").innerHTML =
      "🗹 Password Matched";
    document.getElementById("button").disabled = false;
    document.getElementById("button").style.opacity = 1;
  }
}

signupBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.add("active");
});

loginBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.remove("active");
});
