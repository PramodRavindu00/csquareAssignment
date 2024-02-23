<?php
include("dbConnection.php");
include("functions.php");

$customerTitle = "";
$customerFirstName  = "";
$customerMiddleName = "";
$customerLastName = "";
$customerContact = "";
$customerDistrict = "";
$action = "submit";
$buttonText = "Register";

if (isset($_GET['id'])) {
    $customerSavedData = displayCustomerEditData($conn, $_GET['id']);
    $customerTitle = $customerSavedData['title'];
    $customerFirstName = $customerSavedData['first_name'];
    $customerMiddleName = $customerSavedData['middle_name'];
    $customerLastName = $customerSavedData['last_name'];
    $customerContact = $customerSavedData['contact_no'];
    $customerDistrict = $customerSavedData['district'];;
    $action = "edit";
    $buttonText = "Update";
}

$Title = ['Mr', 'Miss', 'Mrs', 'Dr'];
$districtList = returnDistricts($conn);

?>

<!DOCTYPE html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="../css/add.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/validations.js"></script>
</head>

<body>
    <div class="sub-navbar-container">


        <div class="sub-navbar">
            <ul class="sub-navbar-list">
                <li><a class="active" id="backbtn" href="customerList.php">Back to List</a></li>
            </ul>
        </div>
    </div>



    <div class="container">


        <div>
            <p class="header"><?php echo $buttonText; ?></p>
        </div>
        <div class="subHeading">
            Enter Customer Details
        </div>

        <form action="" method="POST" onsubmit="return customerValidation();">
            <div class="fieldHeader">Title *</div>
            <div>
                <span id="titleError" class="error"></span>
                <div class="spinner-container">
                    <select type="spinner" class="user-type-select" id="title" name="title">
                        <option value="" disabled selected>Select Title</option>
                        <?php
                        if (!isset($_GET['id'])) {

                            foreach ($Title as $title) {
                                echo '<option value="' . $title . '">' . $title . '</option>';
                            }
                        } else {

                            foreach ($Title as $title) {
                                if ($customerTitle == $title) {
                                    echo '<option value="' . $title . '" selected>' . $title . '</option>';
                                } else {
                                    echo '<option value="' . $title . '">' . $title . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="fieldHeader">First Name *</div>
            <div>
                <span id="fnameError" class="error"></span>
                <input type="text" placeholder="Enter First Name" class="txtField" value="<?php echo $customerFirstName ?>" name="fname" id="fname">
            </div>
            <div class="fieldHeader">Middle Name *</div>
            <div>
                <span id="mnameError" class="error"></span>
                <input type="text" placeholder="Enter Middle Name" class="txtField" value="<?php echo $customerMiddleName ?>" name="mname" id="mname">
            </div>
            <div class="fieldHeader">Last Name *</div>
            <div>
                <span id="lnameError" class="error"></span>
                <input type="text" placeholder="Enter Last Name" class="txtField" value="<?php echo $customerLastName ?>" name="lname" id="lname">
            </div>
            <div class="fieldHeader">Contact No *</div>
            <div>
                <span id="contactError" class="error"></span>
                <input type="text" placeholder="Enter Contact No" class="txtField" value="<?php echo $customerContact ?>" name="contact" id="contact">
            </div>
            <div class="fieldHeader">District *</div>
            <div>
                <span id="districtError" class="error"></span>
                <div class="spinner-container">
                    <select type="spinner" class="user-type-select" id="district" name="district">
                        <option value="" disabled selected>Select District</option>
                        <?php
                        if (!isset($_GET['id'])) {

                            foreach ($districtList as $district) {
                                echo '<option value="' . $district['id'] . '">' . $district['district'] . '</option>';
                            }
                        } else {

                            foreach ($districtList as $district) {
                                if ($customerDistrict == $district['id']) {
                                    echo '<option value="' . $district['id'] . '" selected>' . $district['district'] . '</option>';
                                } else {
                                    echo '<option value="' . $district['id'] . '">' . $district['district'] . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="" id="submitbtn">
                <button class="btn" name="<?php echo $action ?>"><?php echo $buttonText ?></button>
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

<?php
if (isset($_POST['submit'])) {

    $resultinsert =  registerCustomer($conn);

    if ($resultinsert) {
        echo '<script> swal("Success!", "New Customer registered successfully!", "success")
                    .then((value) => {
                        window.location.href = "customerList.php";
                    });
              </script>';
    } else {
        echo '<script>swal("Failed!", "An error occurred while registering new customer!", "error")
                    .then((value) => {
                        window.location.href = "registerCustomer.php";
                    });
              </script>';
    }
}




if (isset($_POST['edit'])) {

    $resultupdate = updateCustomerDetails($conn, $_GET['id']);

    if ($resultupdate) {
        echo '<script>
                    swal("Success!", "Customer details updated successfully!", "success")
                      .then((value) => {
                          window.location.href = "customerList.php";
                      });
                  </script>';
    } else {
        echo '<script>
                    swal("Failed!", "An error occured while updating Customer details!", "error")
                      .then((value) => {
                          window.location.href = "registerCustomer.php";
                      });
                  </script>';
    }
}
?>