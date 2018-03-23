// This will be the JavaScript file for our project
// <script src=”javaScript.js”></script> This will be
// how to link files in this file to the js

var arePWtheSame = function()
	if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value){
        document.getElementById('submit').disabled = false;
    } 
	else {
        document.getElementById('submit').disabled = true;
    }