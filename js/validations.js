function itemValidation() {
  let itemcode = document.getElementById("code").value;
  let category = document.getElementById("categoryname").value;
  let subcategory = document.getElementById("subcategory").value;
  let itemname = document.getElementById("itemname").value;
  let quantity = document.getElementById("quantity").value;
  let price = document.getElementById("price").value;

  let codeError = document.getElementById("codeError");
  let categoryError = document.getElementById("categoryError");
  let subCategoryError = document.getElementById("subCategoryError");
  let nameError = document.getElementById("nameError");
  let quantityError = document.getElementById("quantityError");
  let priceError = document.getElementById("priceError");

  if (itemcode === "") {
    codeError.textContent = "Item Code is required";
  } else if (!/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]+$/.test(itemcode)) {
    codeError.textContent = "Item Code should contain both numbers and letters";
  } else if (/\s/.test(itemcode)) {
    codeError.textContent = "Item Code cannot contain any space";
  } else {
    codeError.textContent = "";
  }

  if (category === "") {
    categoryError.textContent = "Category should be selected";
  } else {
    categoryError.textContent = "";
  }

  if (subcategory === "") {
    subCategoryError.textContent = "Sub Category should be selected";
  } else {
    subCategoryError.textContent = "";
  }

  if (itemname === "") {
    nameError.textContent = "Name is required";
  } else {
    nameError.textContent = "";
  }

  if (quantity === "") {
    quantityError.textContent = "Quantity is required";
  } else if (/\s/.test(quantity)) {
    quantityError.textContent = "Quantity cannot contain any space";
  } else if (!/^\d+$/.test(quantity)) {
    quantityError.textContent = "Quantity should only contain numerical values";
  } else {
    quantityError.textContent = "";
  }

  if (price === "") {
    priceError.textContent = "Price is required";
  } else if (/\s/.test(price)) {
    priceError.textContent = "Price cannot contain any space";
  } else if (!/^\d+(\.\d+)?$/.test(price)) {
    priceError.textContent = "Price should be a number (Eg : 30 / 30.50 )";
  } else {
    priceError.textContent = "";
  }

  if (
    codeError.textContent !== "" ||
    categoryError.textContent !== "" ||
    subCategoryError.textContent !== "" ||
    nameError.textContent !== "" ||
    quantityError.textContent !== "" ||
    priceError.textContent !== ""
  ) {
    return false;
  } else {
    return true;
  }
}

function customerValidation() {
  let title = document.getElementById("title").value;
  let fname = document.getElementById("fname").value;
  let mname = document.getElementById("mname").value;
  let lname = document.getElementById("lname").value;
  let contact = document.getElementById("contact").value;
  let district = document.getElementById("district").value;

  let titleError = document.getElementById("titleError");
  let fnameError = document.getElementById("fnameError");
  let mnameError = document.getElementById("mnameError");
  let lnameError = document.getElementById("lnameError");
  let contactError = document.getElementById("contactError");
  let districtError = document.getElementById("districtError");

  if (title === "") {
    titleError.textContent = "Title should be selected";
  } else {
    titleError.textContent = "";
  }

  if (fname === "") {
    fnameError.textContent = "First Name is required";
  }  else if (/\s/.test(fname)) {
    fnameError.textContent = "Name cannot contain any space and should be a single word";
  }else if (!/^[a-zA-Z\s]*$/.test(fname)) {
    fnameError.textContent ="Name should only contain letters";
  } else {
    fnameError.textContent = "";
  }

  if (mname === "") {
    mnameError.textContent = "Middle Name is required";
  }else if (/\s/.test(mname)) {
    mnameError.textContent = "Name cannot contain any space and should be a single word";
  } else if (!/^[a-zA-Z\s]*$/.test(mname)) {
    mnameError.textContent ="Name should only contain letters";
  } else {
    mnameError.textContent = "";
  }

  if (lname === "") {
    lnameError.textContent = "Last Name is required";
  }else if (/\s/.test(lname)) {
    lnameError.textContent = "Name cannot contain any space and should be a single word";
  } else if (!/^[a-zA-Z\s]*$/.test(lname)) {
    lnameError.textContent ="Name should only contain letters";
  } else {
    lnameError.textContent = "";
  }

  if (contact === "") {
    contactError.textContent = "Contact Number is required";
  } else if (/\s/.test(contact)) {
    contactError.textContent = "Contact Number cannot contain any space";
  } else if (!/^\d+$/.test(contact)) {
    contactError.textContent =
      "Contact number should only contain numerical values";
  } else if (!/^0/.test(contact)) {
    contactError.textContent =
      "Contact number should start with a zero ( Eg: 077 / 038 )";
  } else if (contact.length !== 10) {
    contactError.textContent =
      "Contact number should only contains 10 digits exactly";
  } else {
    contactError.textContent = "";
  }

  if (district === "") {
    districtError.textContent = "District should be selected";
  } else {
    districtError.textContent = "";
  }

  if (
    titleError.textContent !== "" ||
    fnameError.textContent !== "" ||
    mnameError.textContent !== "" ||
    lnameError.textContent !== "" ||
    contactError.textContent !== "" ||
    districtError.textContent !== ""
  ) {
    return false;
  } else {
    return true;
  }
}

function reportInvoiceValidation(){
    let startdate = document.getElementById("startdate").value;
    let enddate = document.getElementById("enddate").value;

    let startDateError = document.getElementById("startDateError");
    let endDateError = document.getElementById("endDateError");

    if (startdate === "") {
        startDateError.textContent = "Start Date is required";
      } else {
        startDateError.textContent = "";
      }

      if (enddate === "") {
        endDateError.textContent = "End Date is required";
      } else {
        endDateError.textContent = "";
      }

    if (
        startDateError.textContent !== "" ||
        endDateError.textContent !== ""
      ) {
        return false;
      } else {
        return true;
      }

}

function reportInvoiceItemsValidation(){
    let startdate = document.getElementById("startdateII").value;
    let enddate = document.getElementById("enddateII").value;

    let startDateError = document.getElementById("startDateErrorII");
    let endDateError = document.getElementById("endDateErrorII");

    if (startdate === "") {
        startDateError.textContent = "Start Date is required";
      } else {
        startDateError.textContent = "";
      }

      if (enddate === "") {
        endDateError.textContent = "End Date is required";
      } else {
        endDateError.textContent = "";
      }

    if (
        startDateError.textContent !== "" ||
        endDateError.textContent !== ""
      ) {
        return false;
      } else {
        return true;
      }

}