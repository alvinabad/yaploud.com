/**
 * Javascript for User Information Module
 * 
 * Created on Feb 10, 2008
 * Author: alvinabad@alumni.cmu.edu
 */


var UpdateUserInfo;
UpdateUserInfo = {};

UpdateUserInfo.focus = function(id) {
        var element = document.getElementById(id);
        element.focus();
};

UpdateUserInfo.validate = function() {
    // TODO: Use arrays when user info gets too big
    
    var first_name = document.getElementById('first_name');
    var last_name = document.getElementById('last_name');
    var email = document.getElementById('email');
    var error_message = document.getElementById('error_message_update_userinfo');

    first_name.value = first_name.value.replace(/^\s+|\s+$/g, '') ;
    last_name.value = last_name.value.replace(/^\s+|\s+$/g, '') ;
    email.value = email.value.replace(/^\s+|\s+$/g, '') ;
    
    if (first_name.value == "") {
        error_message.innerHTML = "Invalid first name";
        first_name.focus();
        return false;
    }
    else if (last_name.value == "") {
        error_message.innerHTML = "Invalid last name";
        last_name.focus();
        return false;
    }
    else if (email.value == "") {
        error_message.innerHTML = "Invalid email";
        email.focus();
        return false;
    }

    //validate email
    var regx = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if(regx.test(email.value) == false) {
        error_message.innerHTML = "Invalid email address. Please try again.";
        email.focus();
        return false;
    }

    return true;
};
    