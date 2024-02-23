<?php
include("dbConnection.php");
include("functions.php");

$itemCode = "";
$itemCategory = "";
$itemSubCategory = "";
$itemName = "";
$quantity = "";
$price = "";
$action = "submit";
$buttonText = "Add New Item";

if (isset($_GET['id'])) {
    $itemSavedData = displayItemEditData($conn, $_GET['id']);
    $itemCode = $itemSavedData['item_code'];
    $itemCategory = $itemSavedData['item_category'];
    $itemSubCategory = $itemSavedData['item_subcategory'];
    $itemName = $itemSavedData['item_name'];
    $quantity = $itemSavedData['quantity'];
    $price = $itemSavedData['unit_price'];;
    $action = "editItem";
    $buttonText = "Update Item";
}

$categoryList = returnCategoryNames($conn);
$subCategoryList = returnSubCategoryNames($conn);

?>

<!DOCTYPE html>

<head>
    <title>Add Item</title>
    <link rel="stylesheet" href="../css/add.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/validations.js"></script>
</head>

<body>
    <div class="sub-navbar-container">


        <div class="sub-navbar">
            <ul class="sub-navbar-list">
                <li><a class="active" id="backbtn" href="itemList.php">Back to List</a></li>
            </ul>
        </div>
    </div>



    <div class="container">


        <div>
            <p class="header"><?php echo $buttonText;?></p>
        </div>
        <div class="subHeading">
            Enter Item Details
        </div>

        <form action="" method="POST" onsubmit="return itemValidation();">
            <div class="fieldHeader">Item Code *</div>
            <div>
                <span id="codeError" class="error"></span>
                <input type="text" placeholder="Enter Item Code" class="txtField" value="<?php echo $itemCode ?>" name="code" id="code">

            </div>

            <div class="fieldHeader">Category Name*</div>
            <span id="categoryError" class="error"></span>

            <div class="spinner-container">
                <select type="spinner" class="user-type-select" id="categoryname" name="categoryname">
                    <option value="" disabled selected>Select Category</option>
                    <?php
                    if (!isset($_GET['id'])) {

                        foreach ($categoryList as $category) {
                            echo '<option value="' . $category['id'] . '">' . $category['category'] . '</option>';
                        }
                    } else {

                        foreach ($categoryList as $category) {
                            if ($itemCategory == $category['id']) {
                                echo '<option value="' . $category['id'] . '" selected>' . $category['category'] . '</option>';
                            } else {
                                echo '<option value="' . $category['id'] . '">' . $category['category'] . '</option>';
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="fieldHeader">Select Sub Category *</div>
            <span id="subCategoryError" class="error"></span>

            <div class="spinner-container">
                <select type="spinner" class="user-type-select" id="subcategory" name="subcategory">
                    <option value="" disabled selected>Select Sub Category</option>
                    <?php
                    if (!isset($_GET['id'])) {

                        foreach ($subCategoryList as $subCategory) {
                            echo '<option value="' . $subCategory['id'] . '">' . $subCategory['subcategory'] . '</option>';
                        }
                    } else {

                        foreach ($subCategoryList as $subCategory) {
                            if ($itemSubCategory == $subCategory['id']) {
                                echo '<option value="' . $subCategory['id'] . '" selected>' . $subCategory['subcategory'] . '</option>';
                            } else {
                                echo '<option value="' . $subCategory['id'] . '">' . $subCategory['subcategory'] . '</option>';
                            }
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="fieldHeader">Item Name *</div>

            <div>
                <span id="nameError" class="error"></span>
                <input type="text" placeholder="Enter Item Name" value="<?php echo $itemName ?>" class="txtField" id="itemname" name="itemname">
            </div>

            <div class="fieldHeader">Quantity *</div>
            <span id="quantityError" class="error"></span>
            <div>
                <input type="text" placeholder="Enter quantity" class="txtField" value="<?php echo $quantity ?>" name="quantity" id="quantity">
            </div>


            <div class="fieldHeader">Unit Price (Rs.)*</div>
            <span id="priceError" class="error"></span>
            <div>
                <input type="text" placeholder="Enter price" class="txtField" value="<?php echo $price ?>" name="price" id="price">
            </div>
            <div class="" id="submitbtn">
                <button class="btn" name="<?php echo $action ?>"><?php echo $buttonText ?></button>
            </div>
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

    $resultinsert =  addNewItem($conn);

    if ($resultinsert) {
        echo '<script> swal("Success!", "New Item added successfully!", "success")
                    .then((value) => {
                        window.location.href = "itemList.php";
                    });
              </script>';
    } else {
        echo '<script>swal("Failed!", "An error occurred while adding the new Item!", "error")
                    .then((value) => {
                        window.location.href = "addItem.php";
                    });
              </script>';
    }
}




if (isset($_POST['editItem'])) {

    $resultupdate = updateItem($conn,$_GET['id']);

    if ($resultupdate) {
        echo '<script>
                    swal("Success!", "Item details updated successfully!", "success")
                      .then((value) => {
                          window.location.href = "itemList.php";
                      });
                  </script>';
    } else {
        echo '<script>
                    swal("Failed!", "An error occured while updating Item details!", "error")
                      .then((value) => {
                          window.location.href = "addItem.php";
                      });
                  </script>';
    }
}

?>