/**
 * check the length of a string and validate with 2 paramters
 * value for the string and lessThan for the length less than to check...
 */
function checkLessLength(value, lessThan) {
    if (value.length <= lessThan) {
        return true;
    }

    return false;
}

/**
 * check the length of a string and validate with 2 paramters
 * value for the string and greaterThan for the length less than to check...
 */
function checkGreaterThan(value, greaterThan) {
    if (value.length >= greaterThan) {
        return true;
    }

    return false;
}


/**
 * check is the value in the params is a email...
 * @param {*check if the value is an email} value 
 */
function isEmail(value) {
    var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;

    if (filter.test(value)) {
        return true;
    }

    return false;
}

/**
 * check if fields contains numbers...
 * @param {*check is string contains numbers} value 
 */
function hasNumber(value) {

    var filter = /\d/;
    if (filter.test(value)) {
        return true;
    }

    return false;
}

function disableForNumber() {

}


/**
 * disable non-numeric value for the id when data-number is set to true
 * @param {*disable the input for } id 
 */
function disableNonNumeric(id) {
    var disableField = document.getElementById(id);

    if (disableField.dataset.number == "true") {
        disableField.addEventListener('keypress', function(event) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
            }

        });
    }

}


/**
 * disable numeric values when data-number is set to false
 * @param {*disable numeric values when data-number is set to false} id 
 */
function disableNumeric(id) {
    var disableField = document.getElementById(id);

    if (disableField.dataset.number == "false") {
        disableField.addEventListener('keypress', function(event) {
            if (event.keyCode < 58 || event.keyCode > 122) {
                event.preventDefault();
            }
        });
    }

}

function checkValue(value, testValue) {
    if (value === testValue) {
        return true;
    }

    return false;
}