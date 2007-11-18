/**
 * Javascript for Change Password Module
 * 
 * Created on Nov 17, 2007
 * Author: alvinabad@alumni.cmu.edu
 */


var ChangePassword;
ChangePassword = {};

ChangePassword.focus = function(id) {
        var element = document.getElementById(id);
        element.focus();
};

ChangePassword.validate = function() {
    var password = document.getElementById('password');
    var password2 = document.getElementById('password2');
    var error_message = document.getElementById('error_message');

    password.value = password.value.replace(/^\s+|\s+$/g, '') ;
    password2.value = password2.value.replace(/^\s+|\s+$/g, '') ;
    
    if (password.value == "") {
        error_message.innerHTML = "Invalid password";
        password.focus();
        return false;
    }
    else if (password2.value == "") {
        error_message.innerHTML = "Invalid password";
        password2.focus();
        return false;
    }

    if ( password.value != password2.value ) {
        error_message.innerHTML = "Passwords do not match";
        password.focus();
        password.value = "";
        password2.value = "";
        
        return false;
    }

    return true;
};
    
ChangePassword.clear = function() {
    var password = document.getElementById('password');
    var password2 = document.getElementById('password2');
    var error_message = document.getElementById('error_message');

    error_message.innerHTML = "";
    password.value = "";
    password2.value = "";
};

ChangePassword.success = function() {
    ChangePassword.clear();
    var error_message = document.getElementById('error_message');
    error_message.innerHTML = "Success! Your password has been changed.";
};
