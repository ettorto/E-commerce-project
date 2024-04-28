function validateForm() {
    var brandName = document.getElementById("brandName").value;
    // Add more validation logic if needed

    if (brandName.trim() == "") {
        alert("Brand Name cannot be empty");
        return false;
    }
    return true;
}
