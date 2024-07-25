// validation.js

function validateForm() {
    var name = document.forms["registrationForm"]["Name"].value;
    var bestRecord = document.forms["registrationForm"]["BestRecord"].value;
    var age = document.forms["registrationForm"]["Age"].value;
    var email = document.forms["registrationForm"]["email"].value;
    var phone = document.forms["registrationForm"]["Phone"].value;
    var address = document.forms["registrationForm"]["Address"].value;

    // Reset previous validation messages
    document.getElementById("nameError").innerHTML = "";

    // Validate Name: Should only contain letters
    if (!/^[a-zA-Z]+$/.test(name)) {
        document.getElementById("nameError").innerHTML = "Name should only contain letters";
        return false;
    }

    // Validate Email: Should be in the correct format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Invalid email format");
        return false;
    }

    // Validate Age: Should be a number and below 80
    if (isNaN(age) || parseInt(age) >= 80) {
        alert("Age must be a number and below 80");
        return false;
    }

    // Basic email validation
    if (email !== "" && !/\S+@\S+\.\S+/.test(email)) {
        alert("Invalid email address");
        return false;
    }

    // Basic phone number validation (allowing only digits and optional hyphens)
    if (phone !== "" && !/^[0-9-]+$/.test(phone)) {
        alert("Invalid phone number");
        return false;
    }

    // Other specific validations can be added here

    return true;
}