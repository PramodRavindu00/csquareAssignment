<?php

include("dbConnection.php");
include("functions.php");

?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link rel="stylesheet" href="../css/listView.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/confirmdelete.js"></script>
</head>

<body>




    <div class="sub-navbar-container">


        <div class="sub-navbar">
            <ul class="sub-navbar-list">
                <li><a class="active" href="">Customers</a></li>
                <li><a class="notActive" href="itemList.php">Items</a></li>
                <li><a class="notActive" href="reports.php">Reports</a></li>
                <li><a class="active" id="backbtn" href="../index.html">Back to Home</a></li>
            </ul>
        </div>
    </div>


    <div class="search-container">

        <form action="" method="POST">
            <div class="search-bar">
                <input type="text" placeholder="Search Customers..." name="search">
        </form>

    </div>
    <a class="addB" href="registerCustomer.php">Register Customer</a>
    </div>



    <div class="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Title</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Contact No</th>
                    <th>District</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!isset($_POST['search']) || $_POST['search'] === "") {  //display all the details if search bar is empty

                    $sql = "SELECT customer.*, district.district AS district
                    FROM customer
                    LEFT JOIN district ON customer.district = district.id";


                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['title'] . "</td>
                                <td>" . $row['first_name'] . "</td>
                                <td>" . $row['middle_name'] . "</td>
                                <td>" . $row['last_name'] .  "</td>
                                <td>" . $row['contact_no'] . "</td>
                                <td>" . $row['district'] . "</td>";
                                echo '
                        <td>
                        <a href="registerCustomer.php?id=' . $row['id'] . '"><img src="../icon/editIcon.png" alt=""></a>
                        <a href="customerList.php?id=' . $row['id'] . '" class="deleteLink"><img src="../icon/deleteIcon.png" alt=""></a>
                            </td>
                        </tr>';
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan='7'>Not found !!!!</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='7' style='color:red;'>An error occured while retrieving data !!!!</td>";
                        echo "</tr>";
                    }
                } else {
                    //removing spaces and converting to lower case of the search key
                    $searchKey = strtolower(str_replace(' ', '', $_POST['search']));

                    $sql = "SELECT customer.*, district.district AS district
                    FROM customer
                    LEFT JOIN district ON customer.district = district.id
                    WHERE
                    LOWER(REPLACE(customer.id, ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(customer.title, ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(customer.first_name, ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(customer.middle_name, ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(customer.last_name, ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(customer.contact_no , ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(district.district, ' ', '')) = '$searchKey'";

                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['title'] . "</td>
                                <td>" . $row['first_name'] . "</td>
                                <td>" . $row['middle_name'] . "</td>
                                <td>" . $row['last_name'] .  "</td>
                                <td>" . $row['contact_no'] . "</td>
                                <td>" . $row['district'] . "</td>";
                                echo '
                        <td>
                        <a href="registerCustomer.php?id=' . $row['id'] . '"><img src="../icon/editIcon.png" alt=""></a>
                        <a href="customerList.php?id=' . $row['id'] . '" class="deleteLink"><img src="../icon/deleteIcon.png" alt=""></a>
                            </td>
                        </tr>';
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan='7'>Not found. Try using different word !!!!</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='7' style='color:red;'>An error occurred while retrieving data !!!!</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="copyright">

        <p> Developed by Pramod Ravindu

            <br>All Rights Reserved.
        </p>
    </div>

</body>

</html>
<?php
if (isset($_GET['id'])) {


    $result = deleteCustomer($conn, $_GET['id']);

    if ($result) {
        echo '<script>
                    swal("Success!", "Customer deleted successfully!", "success")
                      .then((value) => {
                          window.location.href = "customerList.php";
                      });
                  </script>';
    } else {
        echo '<script>
                    swal("Failed!", "An error occured while deleting the customer!", "error")
                      .then((value) => {
                          window.location.href = "customerList.php";
                      });
                  </script>';
    }
};

?>