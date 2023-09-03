<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardNumber = $_POST["card-number"];
    $expiry = $_POST["expiry"];
    $cvv = $_POST["cvv"];
    $name = $_POST["name"];

    // Validate card number using the Luhn algorithm
    if (!isValidCreditCardNumber($cardNumber)) {
        die("Invalid card number.");
    }

    // Perform additional validation and processing here
    // - Check expiration date
    // - Validate CVV
    // - Verify cardholder's name
    // - Connect to a payment gateway for payment processing

    // If all validations pass, the payment is considered valid
    echo "Payment Successful!";
}

// Function to validate a credit card number using the Luhn algorithm
function isValidCreditCardNumber($cardNumber) {
    $cardNumber = preg_replace('/\D/', '', $cardNumber); // Remove non-numeric characters

    $sum = 0;
    $alt = false;

    for ($i = strlen($cardNumber) - 1; $i >= 0; $i--) {
        $digit = intval($cardNumber[$i]);

        if ($alt) {
            $digit *= 2;
            if ($digit > 9) {
                $digit -= 9;
            }
        }

        $sum += $digit;
        $alt = !$alt;
    }

    return ($sum % 10 === 0);
}
?>
