// Remove the event listener from the form
var paymentForm = document.getElementById('paymentForm');
paymentForm.removeEventListener('submit', payWithPaystack);

// Add a click event listener to the external button
document.getElementById('externalButton').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent default form submission
    payWithPaystack(); // Call the payWithPaystack function
});

function payWithPaystack() {
    // Your payWithPaystack function code remains the same
    var handler = PaystackPop.setup({
        key: 'pk_test_e8d079e07545fbc9ba0dea540dae14ed076e7383', // Replace with your public key
        email: document.getElementById('email-address').value,
        amount: document.getElementById('amount').textContent.slice(1) * 100, // Adjust to get the amount correctly
        currency: 'GHS',
        ref: "" + Math.floor(Math.random() * 1000000000 + 1),
        callback: function(response) {
            $.ajax({
                url: "../actions/payment_process.php?reference=" + response.reference,
                method: "GET",
                success: function() {
                    window.location.href = "../view/order_summary.php";
                }
            })
            var reference = response.reference;
            alert('Payment complete! Reference: ' + reference);
        },
        onClose: function() {
            alert('Transaction was not completed, window closed.');
        },
    });
    handler.openIframe();
}
