<?php
include("dbConnection.php");

function addNewItem($conn){

    $itemCode = trim(mysqli_real_escape_string($conn, $_POST['code']));
    $itemCode = strtoupper($itemCode);  //uppercasing the letters
    $category = trim(mysqli_real_escape_string($conn, $_POST['categoryname']));
    $subCategory = trim(mysqli_real_escape_string($conn, $_POST['subcategory']));
    $itemName = trim(mysqli_real_escape_string($conn, $_POST['itemname']));
    $quantity = trim(mysqli_real_escape_string($conn, $_POST['quantity']));
    $unitPrice = trim(mysqli_real_escape_string($conn, $_POST['price']));
    

    $sql = "INSERT INTO item (item_code, item_category, item_subcategory, item_name, quantity, unit_price)
    VALUES ('$itemCode','$category','$subCategory','$itemName','$quantity','$unitPrice')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function deleteItem($conn, $itemID)
{

    $sql = "DELETE from item where id='$itemID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function displayItemEditData($conn, $itemID)
{
    $sql = "SELECT * from item where id='$itemID'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

function returnCategoryNames($conn)
{

    $sql = "SELECT * from item_category";
    $result = mysqli_query($conn, $sql);
    $categories = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = array(
                'id' => $row['id'],
                'category' => $row['category']
            );
        }
        return $categories;
    } else {
        return [];
    }
}

function returnSubCategoryNames($conn){
    $sql = "SELECT * from item_subcategory";
    $result = mysqli_query($conn, $sql);
    $categories = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = array(
                'id' => $row['id'],
                'subcategory' => $row['sub_category']
            );
        }
        return $categories;
    } else {
        return [];
    }
}

function updateItem($conn,$itemID){
    $itemCode = trim(mysqli_real_escape_string($conn, $_POST['code']));
    $itemCode = strtoupper($itemCode);  //uppercasing the letters
    $category = trim(mysqli_real_escape_string($conn, $_POST['categoryname']));
    $subCategory = trim(mysqli_real_escape_string($conn, $_POST['subcategory']));
    $itemName = trim(mysqli_real_escape_string($conn, $_POST['itemname']));
    $quantity = trim(mysqli_real_escape_string($conn, $_POST['quantity']));
    $unitPrice = trim(mysqli_real_escape_string($conn, $_POST['price']));

    $sql = "UPDATE item 
    SET item_code = '$itemCode' ,
    item_category = '$category' ,
    item_subcategory = '$subCategory' ,
    item_name = '$itemName' ,
    quantity = '$quantity' ,
    unit_price = '$unitPrice'

    where id = $itemID";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        return true;
    } else {
        return false;
    }

}

////////////////////////////////////////////////////////////////////////////////////////////////////////

function registerCustomer($conn){

    $title = trim(mysqli_real_escape_string($conn, $_POST['title']));

    $fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
    $mname = trim(mysqli_real_escape_string($conn, $_POST['mname']));
    $lname = trim(mysqli_real_escape_string($conn, $_POST['lname']));

    $fname = ucfirst($fname);
    $mname = ucfirst($mname);
    $lname = ucfirst($lname);  // capitalizing first letter

    $contact = trim(mysqli_real_escape_string($conn, $_POST['contact']));
    $district = trim(mysqli_real_escape_string($conn, $_POST['district']));
    

    $sql = "INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district)
    VALUES ('$title','$fname','$mname','$lname','$contact','$district')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function displayCustomerEditData($conn, $customerID)
{
    $sql = "SELECT * from customer where id='$customerID'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

function updateCustomerDetails($conn,$customerID){
    $title = trim(mysqli_real_escape_string($conn, $_POST['title']));

    $fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
    $mname = trim(mysqli_real_escape_string($conn, $_POST['mname']));
    $lname = trim(mysqli_real_escape_string($conn, $_POST['lname']));

    $fname = ucfirst($fname);
    $mname = ucfirst($mname);
    $lname = ucfirst($lname);  // capitalizing first letter

    $contact = trim(mysqli_real_escape_string($conn, $_POST['contact']));
    $district = trim(mysqli_real_escape_string($conn, $_POST['district']));

    $sql = "UPDATE customer 
    SET title = '$title' ,
    first_name = '$fname' ,
    middle_name = '$mname' ,
    last_name = '$lname' ,
    contact_no = '$contact' ,
    district = '$district'

    where id = $customerID";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        return true;
    } else {
        return false;
    }

}

function deleteCustomer($conn, $customerID)
{

    $sql = "DELETE from customer where id='$customerID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

 function returnDistricts($conn){
    $sql = "SELECT * from district";
    $result = mysqli_query($conn, $sql);
    $districts = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $districts[] = array(
                'district' => $row['district'],
                'active' => $row['active'],
                'id' => $row['id']
            );
        }
        return $districts;
    } else {
        return [];
    }
 }