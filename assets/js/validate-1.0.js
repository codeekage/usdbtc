/**
 * custom tags
 */

class CustomMessage extends HTMLElement {
    constructor() {
        //call to the super class 
        super();

        //standard paragraph elements
        var paragraph = document.createElement('p');
        paragraph.innerText = this.getAttribute('data-message');
        var status = this.getAttribute('data-status');

        //check status 
        if (status === "success")
            paragraph.className = "success-message";

        //check status
        if (status === "error")
            paragraph.className = "failed-message";

        //adding new elements to the dom
        this.appendChild(paragraph);
    }
}

class CustomInput extends HTMLElement {
    constructor() {
        super();

        var input = document.createElement("input");
        var inputType = this.getAttribute("data-type");
        input.placeholder = this.getAttribute("data-placeholder");
        input.classList.add("input-control");



        //add event listener for input fields
        input.addEventListener("keyup", function() {
            var value = input.value;
            if (inputType) {
                switch (inputType.toLocaleLowerCase()) {
                    case "email":

                        if (isEmail(value))
                            status(input, true);
                        else
                            status(input, false)

                        break;
                    case "password":
                        input.type = "password";
                        CheckPasswordStrength(value);
                        break;

                    default:
                        break;
                }
            }
        });

        input.addEventListener("keypress", function(event) {
            var value = input.value;
            if (inputType) {
                switch (inputType.toLocaleLowerCase()) {
                    case "person-name":
                        if (event.keyCode < 58 || event.keyCode > 122)
                            event.preventDefault();

                        break;

                    case "phone-number":
                        if (event.keyCode <= 47 || event.keyCode >= 58)
                            event.preventDefault();
                        if(value.length >= 11)
                            event.preventDefault();

                    default:
                        break;
                }
            }
        })


        this.appendChild(input);
    }
}



//define the new element
customElements.define('custom-message', CustomMessage);
customElements.define('custom-input', CustomInput);


///////////////////////////////FUNCTIONS
function isEmail(value) {
    var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;

    if (filter.test(value)) {
        return true;
    }

    return false;
}


//password strength
function CheckPasswordStrength(password) {


    var password_strength_p = document.createElement("p");
    password_strength_p.setAttribute("id", "password_strength");
    var password_strength = document.getElementById("password_strength");

    //TextBox left blank.
    if (password.length == 0) {
        password_strength.innerHTML = "";
        return;
    }

    //Regular Expressions.
    var regex = new Array();
    regex.push("[A-Z]"); //Uppercase Alphabet.
    regex.push("[a-z]"); //Lowercase Alphabet.
    regex.push("[0-9]"); //Digit.
    regex.push("[$@$!%*#?&]"); //Special Character.

    var passed = 0;

    //Validate for each Regular Expression.
    for (var i = 0; i < regex.length; i++) {
        if (new RegExp(regex[i]).test(password)) {
            passed++;
        }
    }

    //Validate for length of Password.
    if (passed > 2 && password.length > 8) {
        passed++;
    }

    //Display status.
    var color = "";
    var strength = "";
    switch (passed) {
        case 0:
        case 1:
            strength = "Weak";
            color = "red";
            break;
        case 2:
            strength = "Good";
            color = "darkorange";
            break;
        case 3:
        case 4:
            strength = "Strong";
            color = "green";
            break;
        case 5:
            strength = "Very Strong";
            color = "darkgreen";
            break;
    }
    password_strength.innerText = strength;
    password_strength.style.color = color;


}


function status(input, success) {

    if (success === true){
        input.style.border = "1px solid #1be611";
     console.log("correct")
}else{
        input.style.border = "1px solid red";
        input.style.borderdColor = "";
        console.log("wrong");

    }



}

function disableNumeric() {

    if (event.keyCode < 58 || event.keyCode > 122) {
        event.preventDefault();
    }


}