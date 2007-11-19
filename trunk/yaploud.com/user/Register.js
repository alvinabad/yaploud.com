/**
 * Javascript for Registration Module
 * 
 * Created on Nov 17, 2007
 * Author: alvinabad@alumni.cmu.edu
 */


var Register;
Register = {};

Register.focus = function(id) {
        var element = document.getElementById(id);
        element.focus();
};

Register.validate = function() {
    var username = document.getElementById('username');
    var first_name = document.getElementById('first_name');
    var last_name = document.getElementById('last_name');
    var email = document.getElementById('email');
    var password = document.getElementById('password');
    var password2 = document.getElementById('password2');
    var captcha = document.getElementById('captcha');
    var error_message = document.getElementById('error_message');

    // trim those parameters
    username.value = username.value.replace(/^\s+|\s+$/g, '') ;
    first_name.value = first_name.value.replace(/^\s+|\s+$/g, '') ;
    last_name.value = last_name.value.replace(/^\s+|\s+$/g, '') ;
    email.value = email.value.replace(/^\s+|\s+$/g, '') ;
    password.value = password.value.replace(/^\s+|\s+$/g, '') ;
    password2.value = password2.value.replace(/^\s+|\s+$/g, '') ;
    captcha.value = captcha.value.replace(/^\s+|\s+$/g, '') ;
    
    if ( username.value == "" ) {
        error_message.innerHTML = "Invalid username. Please try again.";
        username.focus();
        return false;
    }
    else if (username.value.length < 3) {
        error_message.innerHTML = "Username is too short. Please try again.";
        username.focus();
        return false;
    }
    else if (first_name.value == "") {
        error_message.innerHTML = "Invalid first name. Please try again.";
        first_name.focus();
        return false;
    }
    else if (last_name.value == "") {
        error_message.innerHTML = "Invalid last name. Please try again.";
        last_name.focus();
        return false;
    }
    else if (email.value == "") {
        error_message.innerHTML = "Invalid email. Please try again.";
        email.focus();
        return false;
    }
    else if (password.value == "") {
        error_message.innerHTML = "Invalid password. Please try again.";
        password.focus();
        return false;
    }
    else if (password2.value == "") {
        error_message.innerHTML = "Invalid password. Please try again.";
        password2.focus();
        return false;
    }
    else if (password.value.length < 4) {
        error_message.innerHTML = "Password is too short. Please try again.";
        password.focus();
        return false;
    }
    else if (captcha.value == "") {
        error_message.innerHTML = "Invalid captcha. Please try again.";
        captcha.focus();
        return false;
    }
    
    //validate email
    var regx = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if(regx.test(email.value) == false) {
        error_message.innerHTML = "Invalid email address. Please try again.";
        return false;
    }

    // check if passwords matched
    if ( password.value != password2.value ) {
        error_message.innerHTML = "Passwords do not match. Please try again.";
        password.focus();
        password.value = "";
        password2.value = "";
        
        return false;
    }

    return true;
};
    
Register.clear = function() {
    var username = document.getElementById('username');
    var first_name = document.getElementById('first_name');
    var last_name = document.getElementById('last_name');
    var email = document.getElementById('email');
    var password = document.getElementById('password');
    var password2 = document.getElementById('password2');
    var captcha = document.getElementById('captcha');
    var error_message = document.getElementById('error_message');

    error_message.innerHTML = "";
    username.value = "";
    first_name.value = "";
    last_name.value = "";
    email.value = "";
    captcha.value = "";
    password.value = "";
    password2.value = "";
};

Register.success = function() {
    Register.clear();
    var error_message = document.getElementById('error_message');
    error_message.innerHTML = "Congratulations! You have successfully registered.";
};
