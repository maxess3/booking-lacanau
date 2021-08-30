const usernameLogin = document.getElementById("username-login");
const passwordLogin = document.getElementById("password-login");

if(usernameLogin !== null || usernameLogin !== undefined){
    if(usernameLogin.dataset.focusUsername){
        usernameLogin.focus();
    }
}

if(passwordLogin !== null || passwordLogin !== undefined){
    if(passwordLogin.dataset.focusPassword){
        passwordLogin.focus();
    }
}