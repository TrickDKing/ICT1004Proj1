/* 
For form validation
 */
/*
$(document).ready(function () {



    //var myInput = document.getElementById("psw");
    //alert(checkPassword(myInput));
});


var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");



function checkPassword(targetString) {
    var errorMsg; 
    console.log("A");
    var lowerCaseLetters = /[a-z]/g;
    if (!(targetString.value.match(lowerCaseLetters))) {
        console.log("A");
        errorMsg +="Password does not contain lower case!";
    } 

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (!(targetString.value.match(upperCaseLetters))) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (!(targetString.value.match(numbers))) {
        number.classList.remove("invalid");
        number.classList.add("valid");
    }

    // Validate length
    if (!(targetString.value.length >= 8)) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    }

    return(errorMsg);
}
*/
