$.validator.addMethod("lettersOnly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z]+(([',. -][a-zA-Z])?[a-zA-Z]*)*$/g.test(value);
}, "Please enter letters only.");
 
/**
 * Custom validator for numbers only (0-9)
 */
$.validator.addMethod("numbersOnly", function (value, element) {
    return this.optional(element) || /^[0-9]+$/i.test(value);
}, "Please enter numbers only.");
 

$.validator.addMethod("lettersAndNumbersOnly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
}, "Please enter letters and numbers only.");