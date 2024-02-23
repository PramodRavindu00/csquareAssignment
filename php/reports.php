<?php

include("dbConnection.php");
include("generatePDF.php");

if (isset($_POST['items'])) {
    generateItemReport($conn);
}
if (isset($_POST['invoice'])) {
    generateInvoiceReport($conn);
}
if (isset($_POST['invoiceItems'])) {
    generateInvoiceItemsReport($conn);
}
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="../css/add.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/validations.js"></script>
</head>

<body>




    <div class="sub-navbar-container">


        <div class="sub-navbar">
            <ul class="sub-navbar-list">
                <li><a class="notActive" href="customerList.php">Customers</a></li>
                <li><a class="notActive" href="itemList.php">Items</a></li>
                <li><a class="active" href="">Reports</a></li>
                <li><a class="active" id="backbtn" href="../index.html">Back to Home</a></li>
            </ul>
        </div>
    </div>
    <div>
                <p class="header">Generate Reports</p>
            </div>
    <div class="form-container">

        <div class="container">


            <div>
                <p class="header"></p>
            </div>
            <div class="subHeading">
                Generate Invoice Report
            </div>

            <form action="" method="POST" onsubmit="return reportInvoiceValidation();">
                <div class="fieldHeader">Select Start Date *</div>
                <div>
                    <span id="startDateError" class="error"></span>
                    <input type="date" class="date" name="startdate" id="startdate">
                </div>
                <div class="fieldHeader">Select End Date *</div>
                <div>
                    <span id="endDateError" class="error"></span>
                    <input type="date" class="date"  name="enddate" id="enddate">
                </div>

                <div class="" id="submitbtn">
                    <button class="btn" name="invoice">Generate</button>
                </div>
            </form>
        </div>
        <div class="container">


            <div>
                <p class="header"></p>
            </div>
            <div class="subHeading">
                Generate Invoice Items Report
            </div>

            <form action="" method="POST" onsubmit="return reportInvoiceItemsValidation();">
                <div class="fieldHeader">Select Start Date *</div>
                <div>
                    <span id="startDateErrorII" class="error"></span>
                    <input type="date" class="date" name="startdate" id="startdateII">
                </div>
                <div class="fieldHeader">Select End Date *</div>
                <div>
                    <span id="endDateErrorII" class="error"></span>
                    <input type="date" class="date"  name="enddate" id="enddateII">
                </div>

                <div class="" id="submitbtn">
                    <button class="btn" name="invoiceItems">Generate</button>
                </div>
            </form>
        </div>
        
    </div>
    <div class="container">
            <form action="" method="POST">
                <div class="" id="submitbtn">
                    <button class="btn" name="items">Generate Items Report</button>
                </div>
            </form>
        </div>
    <div class="copyright">

        <p> Developed by Pramod Ravindu

            <br>All Rights Reserved.
        </p>
    </div>
</body>
</html>