function validateForm(event) {
    // Prevent the form from submitting by default
    event.preventDefault();

    const fullName = document.getElementById('fullName').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const country = document.getElementById('country').value;
    const city = document.getElementById('city').value;
    const contactNumber = document.getElementById('contactNumber').value;

    // Email validation using a simple regex for Ashesi emails
    const emailRegex = /^[a-zA-Z0-9._-]+@ashesi\.edu\.gh$/;
    if (!emailRegex.test(email)) {
        document.getElementById('emailError')?.textContent = 'Please enter a valid Ashesi email address.';
        return false;
    } else {
        document.getElementById('emailError')?.textContent = ''; // Clear any previous error message
    }

    // Phone number validation using a regex for E.164 standard
    const phoneNumberRegex = /^\+\d{1,3}\d{6,14}$/;
    if (!phoneNumberRegex.test(contactNumber)) {
        document.getElementById('phoneError')?.textContent = 'Please enter a valid phone number in E.164 format.';
        return false;
    } else {
        document.getElementById('phoneError')?.textContent = ''; // Clear any previous error message
    }

    // If all validations pass, allow the form to submit
    return true;
}