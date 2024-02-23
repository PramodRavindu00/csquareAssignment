<?php

include("dbConnection.php");
include("functions.php");

?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items </title>
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
                <li><a class="notActive" href="customerList.php">Customers</a></li>
                <li><a class="active" href="">Items</a></li>
                <li><a class="notActive" href="reports.php">Reports</a></li>
                <li><a class="active" id="backbtn" href="../index.html">Back to Home</a></li>
            </ul>
        </div>
    </div>


    <div class="search-container">

        <form action="" method="POST">
            <div class="search-bar">
                <input type="text" placeholder="Search Items..." name="search">
        </form>

    </div>
    <a class="addB" href="addItem.php">Add New Item</a>
    </div>



    <div class="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Code</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!isset($_POST['search']) || $_POST['search'] === "") {  //display all the details if search bar is empty

                    $sql = "SELECT item.*, item_category.category AS category, item_subcategory.sub_category AS sub_category
                    FROM item
                    LEFT JOIN item_category ON item.item_category = item_category.id
                    LEFT JOIN item_subcategory ON item.item_subcategory = item_subcategory.id";

                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['item_code'] . "</td>
                                <td>" . $row['category'] . "</td>
                                <td>" . $row['sub_category'] . "</td>
                                <td>" . $row['item_name'] .  "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>" . $row['unit_price'] . "</td>";
                                echo '
                        <td>
                        <a href="addItem.php?id=' . $row['id'] . '"><img src="../icon/editIcon.png" alt=""></a>
                        <a href="itemList.php?id=' . $row['id'] . '" class="deleteLink"><img src="../icon/deleteIcon.png" alt=""></a>
                            </td>
                        </tr>';
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan='7'>No items found !!!!</td>";
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

                    $sql = "SELECT item.*, item_category.category AS category, item_subcategory.sub_category AS sub_category
                    FROM item
                    LEFT JOIN item_category ON item.item_category = item_category.id
                    LEFT JOIN item_subcategory ON item.item_subcategory = item_subcategory.id
                    WHERE
                    LOWER(REPLACE(item.id, ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(item.item_code, ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(item_category.category, ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(item_subcategory.sub_category, ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(item.item_name, ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(item.quantity, ' ', '')) = '$searchKey' OR
                    LOWER(REPLACE(item.unit_price, ' ', '')) = '$searchKey'";

                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['item_code'] . "</td>
                                <td>" . $row['category'] . "</td>
                                <td>" . $row['sub_category'] . "</td>
                                <td>" . $row['item_name'] .  "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>" . $row['unit_price'] . "</td>";
                                echo '
                        <td>
                        <a href="addItem.php?id=' . $row['id'] . '"><img src="../icon/editIcon.png" alt=""></a>
                        <a href="itemList.php?id=' . $row['id'] . '" class="deleteLink"><img src="../icon/deleteIcon.png" alt=""></a>
                            </td>
                        </tr>';
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan='7'>No items found. Try using different word !!!!</td>";
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


    $result = deleteItem($conn, $_GET['id']);

    if ($result) {
        echo '<script>
                    swal("Success!", "Item deleted successfully!", "success")
                      .then((value) => {
                          window.location.href = "itemList.php";
                      });
                  </script>';
    } else {
        echo '<script>
                    swal("Failed!", "An error occured while deleting the Item!", "error")
                      .then((value) => {
                          window.location.href = "itemList.php";
                      });
                  </script>';
    }
};

?>