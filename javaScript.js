// This will be the JavaScript file for our project
// <script src=”javaScript.js”></script> This will be
// how to link files in this file to the js

var arePWtheSame = function()
	if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value){
        document.getElementById('areMatching').style.color = 'green';
		document.getElementById('areMatching').innerHTML = 'Passwords Match';
    } 
	else {
		document.getElementById('areMatching').style.color = 'red';
		document.getElementById('areMatching').innerHTML = 'Passwords Do Not Match';
    }