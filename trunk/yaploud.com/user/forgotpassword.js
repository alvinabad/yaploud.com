/**
 * Javascript for ForgotPassword Module
 * 
 * Created on Nov 19, 2007
 * Author: alvinabad@alumni.cmu.edu
 */


var ForgotPassword;
ForgotPassword = {};

ForgotPassword.focus = function(id) {
        var element = document.getElementById(id);
        element.focus();
};

ForgotPassword.validate = function() {
    var email = document.getElementById('email');
    var captcha = document.getElementById('captcha');
    var error_message = document.getElementById('error_message');

    // trim those parameters
    email.value = email.value.replace(/^\s+|\s+$/g, '') ;
    captcha.value = captcha.value.replace(/^\s+|\s+$/g, '') ;
    
    if (email.value == "") {
        error_message.innerHTML = "Invalid email. Please try again.";
        email.focus();
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
        error_message.innerHTML = "Invalid email. Please try again.";
        return false;
    }

    return true;
};
    
ForgotPassword.clear = function() {
    var email = document.getElementById('email');
    var captcha = document.getElementById('captcha');
    var error_message = document.getElementById('error_message');

    error_message.innerHTML = "";
    email.value = "";
    captcha.value = "";
};
