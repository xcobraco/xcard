<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/orderstyles.css">
    <title>Order Now</title>

    <style>
        /* General body styling */
        body {
            font-family: 'Arial', sans-serif;
            color: #ffffff;
            margin: 0;
        }

        /* Background image and responsive adjustments */
        body {
            background-image: url(https://i.ibb.co/7jmTcQt/sofindd-fp-12-11-2023-303.png);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 20px;
        }

        @media only screen and (max-width: 600px) {
            body {
                background-image: url(https://i.ibb.co/17FDV88/Artboard-1.png);

                
            }
            
        }

        /* Form container styling */
      

        /* Container styling */
        .container {
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Column styling */
        .form-column, .summary-column {
            background: rgb(98 103 32 / 40%);
             padding: 17px;
            border-radius: 55px;
            box-shadow: 0 0 15px rgb(255 255 255 / 98%);
            margin-bottom: -14px;
            width: 60%;
        }

        /* Summary column positioning */
        .summary-column {
            order: 1;
            position: sticky;
            top: 10px;
        }

        form {
    background: #000000db;
    padding: 10px;
    border-radius: 10px;
    box-shadow: -1px -1px 19px 14px rgb(255 214 6 / 35%);
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Input and Select box styling */
input[type="text"],
input[type="email"],
input[type="file"],
select,
input[type="button"],
input[type="submit"] {
    width: calc(80% - 24px);
    padding: 12px;
    margin: 8px 0;
    border:1px solid #ffd400;
    border-radius: 4px;
    box-sizing: border-box;
    max-width: 400px; /* Limit maximum width of input fields */
}
        /* Radio button group styling */
        .radio-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 10px 0;
        }

        .radio-group label {
            flex: 0 0 33.33%; /* 3 columns */
            padding: 10px;
            text-align: center;
        }

        /* Hide and Show elements */
        [style*="display: none"] {
            display: none !important;
        }

        /* Button styling */
        .btn-primary {
            width: 100%;
            background-color: #93871075;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        /* Custom HR styles */
        .hr {
            border: none;
            height: 2px;
            background: #ccc;
            margin: 20px 0;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            body {
                padding: 10px;
            }

            form {
                padding: 10px;
            }

            .radio-group label {
                flex-basis: 50%; /* 2 columns on smaller screens */
            }
            .form-column, .summary-column {
        width: 80%; /* Change width to 80% for mobile screens */
    }
        }

    </style>
</head>
<body>

<div class="container">
    <div class="summary-column">
        <h2>Form Summary</h2>
        <div id="formSummary">
            <!-- Real-time summary content will be displayed here -->
        </div>
    </div>
    <form id="registrationForm" method="post" action="submit.php" enctype="multipart/form-data">
        <h2>User Preferences</h2>
       <div class="radio-group">
    <label><input type="radio" name="userPreference" value="Classic White Card" id="op1" required> <img src="https://i.ibb.co/CbHTTY7/bgr1-4.png" alt="Design 2" width="70%"><br>
        <p>LKR 3200.00</p>
    </label>
    <label><input type="radio" name="userPreference" value="Classic Black Card" id="op2" required><img src="https://i.ibb.co/QJtt6RM/bgr1-5.png" alt="Design 1" width="70%">
        <p>LKR 3600.00</p>
    </label>
    <label><input type="radio" name="userPreference" value="Company White Card" id="op3" required>   <img src="https://i.ibb.co/ZfwJmJp/bgr1-1.png" alt="Design 3" width="70%">
        <p>LKR 4500.00</p>
    </label>
    <label><input type="radio" name="userPreference" value="Company Black Card" id="op4" required><img src="https://i.ibb.co/FbBy9cn/bgr1-3.png" alt="Design 4" width="70%">
        <p>LKR 4700.00</p>
    </label>
    <label><input type="radio" name="userPreference" value="Custom Card" id="op5" required> <img src="https://i.ibb.co/8Ymmc50/bgr1-2.png" alt="Design 5" width="70%">
        <p>LKR 5300.00</p>
    </label>
    <label><input type="radio" name="userPreference" value="Custom Card (Custom Design)" id="op6" required><img src="https://i.ibb.co/CBwXmWN/bgr1-6.png" alt="Design 6" width="70%">
        <p>LKR 6200.00</p>
    </label>
</div>

        <hr class="hr">
        <h2>Personal and Professional Information</h2>
        <p>fill name and other details for your card</p>
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="contact" placeholder="Contact Number" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="position" placeholder="Position">
        <input type="text" name="company" placeholder="Company Name">
        <hr class="hr">
        <div id="uploadsSection">
            <h2>Uploads</h2>
            <input type="file" name="logo" placeholder="Upload Logo">
            <input type="file" name="design" placeholder="Upload Design">
            <hr class="hr">
        </div>
        
       
       
        <h2>File This Email to Send Payment Slip</h2>
        <input type="email" name="emailSlip" placeholder="Email for Payment Slip" required> <!-- Corrected name attribute -->
        <hr class="hr">
        <h2>Delivery Address</h2>
        <input type="text" name="address" placeholder="Delivery Address" required> <!-- Corrected name attribute -->
        <hr class="hr">
        <h2>coupon code (If you have)</h2>
        <input type="text" name="coupon" placeholder="coupon code">
        <hr class="hr">
         <!-- Terms and Conditions section -->
  
    <!-- End of Terms and Conditions section -->
         <h2>Payment Method</h2>
        <div class="radio-group">
            <label>
                <input type="radio" name="paymentMethod" value="Bank Slip" id="bankSlip" required>
                Bank Slip
                <img src="https://i.ibb.co/6B8DdPM/istockphoto-1294462504-612x612-removebg-preview.png" width="50%" >
            </label>
            <label>
                <input type="radio" name="paymentMethod" value="Card Payment">
                Card Payment
                <img src="https://i.ibb.co/ftxtJJg/6963703.png" width="50%" >
            </label>
            <label>
                <input type="radio" name="paymentMethod" value="Cash on Delivery">
                Cash on Delivery
                <img src="https://i.ibb.co/pdz1X31/Untitled-removebg-preview.png" width="60%" >
            </label>
             <hr class="hr">
        <div id="bankSlipUpload">
            <h1>Account Details</h1>
            <p>Name: &nbsp &nbsp Avishka Ravishan</p>
            <p>Account No: &nbsp &nbsp 3187869</p>
            <p>Bank: &nbsp &nbsp Bank of Ceylon </p>
            <p>Branch : &nbsp &nbsp Veyangoda</p>
            <input type="file" name="paymentSlip">
        </div>
              <label for="agreeTerms">   <input type="checkbox" name="agreeTerms" id="agreeTerms" required>I agree to the<a href="synerx.lk/admin.html"> Terms and Conditions</a></label>

        </div>
          <center> <img src="https://i.ibb.co/bgQk8w9/360-F-406753914-SFSBhjhp6kb-Hbl-Ni-UFZ1-MXHcu-EKe7e7-P-removebg-preview.png" width="30%"></center>
        <p>If you have a problem with this purchase, you can call us at +94 74 134 2997</p>
        <input type="submit" value="Place the Order" class="btn btn-primary">
    </form>
<br><br><br>
    
</div>
<script>
    // Function to update the form summary with personal, professional information, and user preferences
    function updateFormSummary() {
        // Capture values from all input fields
        const name = document.querySelector('input[name="name"]').value;
        const contact = document.querySelector('input[name="contact"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const position = document.querySelector('input[name="position"]').value;
        const company = document.querySelector('input[name="company"]').value; // Corrected variable name
        const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked') ? document.querySelector('input[name="paymentMethod"]:checked').value : '';
        const userPreference = document.querySelector('input[name="userPreference"]:checked') ? document.querySelector('input[name="userPreference"]:checked').value : '';
        const emailSlip = document.querySelector('input[name="emailSlip"]').value;
        const address = document.querySelector('input[name="address"]').value;

        // Generate HTML for form summary
        let summaryHtml = `
    <table>
        <tr>
            <td><strong>Card Type:</strong></td>
            <td>${userPreference}</td>
        </tr>
        <tr>
            <td><strong>Name:</strong></td>
            <td>${name}</td>
        </tr>
        <tr>
            <td><strong>Contact:</strong></td>
            <td>${contact}</td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td>${email}</td>
        </tr>
        <tr>
            <td><strong>Position:</strong></td>
            <td>${position}</td>
        </tr>
        <tr>
            <td><strong>Company Name:</strong></td>
            <td>${company}</td>
        </tr>
        <tr>
            <td><strong>Payment Method:</strong></td>
            <td>${paymentMethod}</td>
        </tr>
        <tr>
            <td><strong>Email for Payment Slip:</strong></td>
            <td>${emailSlip}</td>
        </tr>
        <tr>
            <td><strong>Delivery Address:</strong></td>
            <td>${address}</td>
        </tr>`;

        // Fetch the price based on the selection
        const price = prices[userPreference];
        if(price !== undefined) {
            summaryHtml += `<tr><td><strong>Price:</strong></td><td>LKR ${price.toFixed(2)} + dilivary chagers LKR450.00</td></tr>`;
        }

        // Apply discount if applicable
        const couponCode = document.querySelector('input[name="coupon"]').value;
        let discountApplied = 0;
        if (couponCode === "sliit2024" && price) {
            discountApplied = price - 600;
        }

        if (discountApplied > 0) {
            summaryHtml += `<tr><td><strong>Discount prise :</strong></td><td>LKR ${discountApplied.toFixed(2)} + dilivary chagers LKR450.00</td></tr>`;
        }

        summaryHtml += `</table>`;

        // Update the form summary element
        document.getElementById('formSummary').innerHTML = summaryHtml;
    }

    // Function to toggle the bank slip upload field based on payment method selection
    function toggleBankSlipUpload() {
        const bankSlipRadio = document.getElementById("bankSlip");
        const bankSlipUpload = document.getElementById("bankSlipUpload");
        bankSlipUpload.style.display = bankSlipRadio.checked ? "block" : "none";
    }

    // Function to toggle additional inputs based on the selected user preference
    function togglePreferenceDetails() {
        const userPreference = document.querySelector('input[name="userPreference"]:checked') ? document.querySelector('input[name="userPreference"]:checked').value : '';
        const uploadsSection = document.getElementById('uploadsSection');

        if (userPreference === "Classic White Card" || userPreference === "Classic Black Card") {
            uploadsSection.style.display = "none";
        } else {
            uploadsSection.style.display = "block";
        }
    }

    // Event listeners for the form
    document.querySelectorAll('input[name="userPreference"]').forEach(input => {
        input.addEventListener("change", function() {
            togglePreferenceDetails();
            updateFormSummary();
        });
    });

    document.querySelectorAll('input[name="paymentMethod"]').forEach(input => {
        input.addEventListener("change", function() {
            toggleBankSlipUpload();
            updateFormSummary();
        });
    });

    document.querySelectorAll('input[name="name"], input[name="contact"], input[name="email"], input[name="position"], input[name="company"], input[name="emailSlip"], input[name="address"]').forEach(input => {
        input.addEventListener("input", updateFormSummary);
    });

    // Initial setup calls
    toggleBankSlipUpload();
    togglePreferenceDetails();
    updateFormSummary();
</script>

<script>
    const prices = {
        "Classic White Card": 3200,
        "Classic Black Card": 3600,
        "Company White Card": 4500,
        "Company Black Card": 4700,
        "Custom Card": 5300,
        "Custom Card (Custom Design)": 6200,
    };

    // Event listener for coupon code input
    document.querySelector('input[name="coupon"]').addEventListener('input', function() {
        updateFormSummary();
    });

    // Initial call to setup form summary
    updateFormSummary();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var radios = document.querySelectorAll('input[type=radio][name="userPreference"]');
        radios.forEach(radio => radio.addEventListener('change', toggleInputs));
    });

    function toggleInputs() {
        var logoInput = document.querySelector('input[name="logo"]');
        var designInput = document.querySelector('input[name="design"]');

        // Hide both logo and design inputs for Classic White Card and Classic Black Card
        if (document.getElementById('op1').checked || document.getElementById('op2').checked) {
            logoInput.style.display = 'none';
            designInput.style.display = 'none';
        }
        // Hide only design input for Company White Card and Company Black Card
        else if (document.getElementById('op3').checked || document.getElementById('op4').checked) {
            logoInput.style.display = '';
            designInput.style.display = 'none';
        } 
        // Show both inputs for other options
        else {
            logoInput.style.display = '';
            designInput.style.display = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Select all radio inputs with name 'paymentMethod'
        var paymentRadios = document.querySelectorAll('input[type=radio][name="paymentMethod"]');
        // Add change event listener to each radio input
        paymentRadios.forEach(radio => radio.addEventListener('change', togglePaymentSlipInput));
        // Initially hide the payment slip input
        document.getElementById('bankSlipUpload').style.display = 'none';
    });

    function togglePaymentSlipInput() {
        var bankSlipRadio = document.getElementById('bankSlip');
        var paymentSlipInput = document.getElementById('bankSlipUpload');

        // If Bank Slip radio is checked, show the payment slip input, otherwise hide it
        if (bankSlipRadio.checked) {
            paymentSlipInput.style.display = '';
        } else {
            paymentSlipInput.style.display = 'none';
        }
    }
</script>

<script>
    const prices = {
        "Classic White Card": 3200,
        "Classic Black Card": 3600,
        "Company White Card": 4500,
        "Company Black Card": 4700,
        "Custom Card": 5300,
        "Custom Card (Custom Design)": 6200,
    };

    // Function to apply a discount based on a coupon code
    function applyDiscount() {
        const couponInput = document.querySelector('input[name="remarks"]');
        if (!couponInput) return; // Exit if coupon input does not exist

        const couponCode = couponInput.value;
        const userPreference = document.querySelector('input[name="userPreference"]:checked') ?
            document.querySelector('input[name="userPreference"]:checked').value : '';
        let price = prices[userPreference];

        if (couponCode === "SPECIAL10" && price) {
            const discountPercentage = 10; // 10% discount for this coupon
            const discountedPrice = price - (price * discountPercentage / 100);

            // Update the summary with the discounted price
            const summaryElement = document.getElementById('formSummary');
            const priceRow = summaryElement.querySelector('[data-price]');
            if(priceRow) {
                priceRow.innerHTML = `LKR ${discountedPrice.toFixed(2)}`;
            } else {
                // If for some reason the price row doesn't exist, append it
                summaryElement.innerHTML += `<tr><td><strong>Discounted Price:</strong></td><td>LKR ${discountedPrice.toFixed(2)}</td></tr>`;
            }
        }
    }

    // Event listener for user preference and coupon code
    document.querySelectorAll('input[name="userPreference"]').forEach(input => {
        input.addEventListener("change", updateFormSummary);
    });

    document.querySelector('input[name="remarks"]').addEventListener('input', () => {
        // Delay discount application to allow for debounce or other logic
        setTimeout(applyDiscount, 500);
    });

    // Initial calls to setup form
    updateFormSummary();
</script>


</body>
</html>
