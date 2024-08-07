function validateForm() {
    // Get form inputs
    var fname = document.forms["signin"]["fname"].value.trim();
    var lname = document.forms["signin"]["lname"].value.trim();
    var mail = document.forms["signin"]["mail"].value.trim();
    var phoneNumber = document.forms["signin"]["num"].value.trim();
    var dob = document.forms["signin"]["dob"].value.trim();
    var gender = document.querySelector('input[name="gender"]:checked');
    var password = document.forms["signin"]["password"].value;
    var passconfirm = document.forms["signin"]["passconfirm"].value;

    // Regular expressions for validation
    var nameRegex = /^[a-zA-Z]+$/;
    var emailRegex = /^\S+@\S+\.\S+$/;
    var phoneRegex = /^[0-9]{10,20}$/;
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

    // Validation checks
    if (!fname.match(nameRegex)) {
        alert("Please enter a valid first name.");
        return false;
    }
    if (!lname.match(nameRegex)) {
        alert("Please enter a valid last name.");
        return false;
    }
    if (!mail.match(emailRegex)) {
        alert("Please enter a valid email address.");
        return false;
    }
    if (!phoneNumber.match(phoneRegex)) {
        alert("Please enter a valid phone number.");
        return false;
    }
    if (!dob) {
        alert("Please select your date of birth.");
        return false;
    }
    if (!gender) {
        alert("Please select your gender.");
        return false;
    }
    if (!password.match(passwordRegex)) {
        alert("Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, and one number.");
        return false;
    }
    if (password !== passconfirm) {
        alert("Passwords do not match.");
        return false;
    }

    // Display success message
    alert("Registration successful!");
    return true;
  }