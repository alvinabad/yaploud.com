/**
 * Javascript for Change Password
 *
 */


var ChangePassword = {

    focus:function(id) {
        var element = document.getElementById(id);
        element.focus();
    },

    validate:function() {
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
    },
    
    clear:function() {
        var password = document.getElementById('password');
        var password2 = document.getElementById('password2');
        var error_message = document.getElementById('error_message');
    
        error_message.innerHTML = "";
        password.value = "";
        password2.value = "";
    },
    
    success:function() {
        ChangePassword.clear();
        var error_message = document.getElementById('error_message');
        error_message.innerHTML = "Success! Your password has been changed.";
    }
};
