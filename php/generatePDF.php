<?php
include("dbConnection.php");
include("../fpdf/fpdf.php");

ob_end_clean();   //turn off output buffering

function generateItemReport($conn)
{
    $pdf = new FPDF('p', 'mm', 'A4');
    $pdf->AddPage();
    $sql = "SELECT item.*, item_category.category AS category, item_subcategory.sub_category AS sub_category
    FROM item
    LEFT JOIN item_category ON item.item_category = item_category.id
    LEFT JOIN item_subcategory ON item.item_subcategory = item_subcategory.id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(71, 10, '', 0, 0);
        $pdf->Cell(59, 5, 'Item List', 0, 0);
        $pdf->Cell(50, 10, '', 0, 1);

        // Heading of the table 
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 6, 'Item Name', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Category', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Sub Category', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Quantity', 1, 1, 'C');

        // Body of the table
        $pdf->SetFont('Arial', '', 10);
        while ($row = mysqli_fetch_assoc($result)) {
            $pdf->Cell(40, 6, $row['item_name'], 1, 0, 'C');
            $pdf->Cell(50, 6, $row['category'], 1, 0, 'C');
            $pdf->Cell(50, 6, $row['sub_category'], 1, 0, 'C');
            $pdf->Cell(50, 6, $row['quantity'], 1, 1, 'C');
        }
    } else {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(59, 5, 'There are no items available right now', 0, 0);
    }
    $pdfPath = '../reports/itemList.pdf';
    $pdf->Output("F", $pdfPath);
    echo '<script type="text/javascript">';
    echo 'window.open("' . $pdfPath . '", "_blank");';
    echo '</script>';
}

function generateInvoiceReport($conn)
{
    $startDate = $_POST['startdate'];
    $endDate = $_POST['enddate'];

    $pdf = new FPDF('p', 'mm', 'A4');
    $pdf->AddPage();
    $sql = "SELECT invoice.invoice_no,invoice.date,invoice.customer,invoice.item_count,invoice.amount, district.district AS customer_district 
    FROM invoice JOIN customer ON invoice.customer = customer.id 
    JOIN district ON customer.district = district.id
    WHERE date BETWEEN '$startDate' AND '$endDate'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(71, 10, '', 0, 0);
        $pdf->Cell(59, 5, 'Invoices', 0, 0);
        $pdf->Cell(50, 10, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(100, 5, '', 0, 0);
        $pdf->Cell(25, 5, 'From : ', 0, 0);
        $pdf->Cell(64, 5, $startDate, 0, 1);

        $pdf->Cell(100, 5, '', 0, 0);
        $pdf->Cell(25, 5, 'To : ', 0, 0);
        $pdf->Cell(64, 5, $endDate, 0, 1);

        $pdf->Cell(50, 10, '', 0, 1);

        // Heading of the table 
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 6, 'Invoice No', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Date', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Customer ID', 1, 0, 'C');
        $pdf->Cell(40, 6, 'District', 1, 0, 'C');
        $pdf->Cell(30, 6, 'No of Items', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Total Amount', 1, 1, 'C');

        // Body of the table
        $pdf->SetFont('Arial', '', 10);
        while ($row = mysqli_fetch_assoc($result)) {
            $pdf->Cell(30, 6, $row['invoice_no'], 1, 0, 'C');
            $pdf->Cell(30, 6, $row['date'], 1, 0, 'C');
            $pdf->Cell(30, 6, $row['customer'], 1, 0, 'C');
            $pdf->Cell(40, 6, $row['customer_district'], 1, 0, 'C');
            $pdf->Cell(30, 6, $row['item_count'], 1, 0, 'C');
            $pdf->Cell(30, 6, $row['amount'], 1, 1, 'C');
        }
    } else {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(59, 5, 'No data found', 0, 0);
    }
    $pdfPath = '../reports/invoiceList.pdf';
    $pdf->Output("F", $pdfPath);
    echo '<script type="text/javascript">';
    echo 'window.open("' . $pdfPath . '", "_blank");';
    echo '</script>';
}

function generateInvoiceItemsReport($conn)
{
    $startDate = $_POST['startdate'];
    $endDate = $_POST['enddate'];

    $pdf = new FPDF('p', 'mm', 'A4');
    $pdf->AddPage();
    $sql = "SELECT invoice.invoice_no,invoice.date,customer.first_name,item.item_name,item.item_code,item.unit_price,item_category.category
    from invoice
    join customer on invoice.customer = customer.id
    join invoice_master on invoice.invoice_no = invoice_master.invoice_no
    join item on invoice_master.item_id = item.id
    join item_category on item.item_category = item_category.id
    WHERE date BETWEEN '$startDate' AND '$endDate'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(71, 10, '', 0, 0);
        $pdf->Cell(59, 5, 'Invoice Items', 0, 0);
        $pdf->Cell(50, 10, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(100, 5, '', 0, 0);
        $pdf->Cell(25, 5, 'From : ', 0, 0);
        $pdf->Cell(64, 5, $startDate, 0, 1);

        $pdf->Cell(100, 5, '', 0, 0);
        $pdf->Cell(25, 5, 'To : ', 0, 0);
        $pdf->Cell(64, 5, $endDate, 0, 1);

        $pdf->Cell(50, 10, '', 0, 1);

        // Heading of the table 
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 6, 'Invoice No', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Date', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Customer Name', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Item Code', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Item', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Category', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Unit Price (Rs)', 1, 1, 'C');

        // Body of the table
        $pdf->SetFont('Arial', '', 10);
        while ($row = mysqli_fetch_assoc($result)) {
            $pdf->Cell(20, 6, $row['invoice_no'], 1, 0, 'C');
            $pdf->Cell(25, 6, $row['date'], 1, 0, 'C');
            $pdf->Cell(30, 6, $row['first_name'], 1, 0, 'C');
            $pdf->Cell(25, 6, $row['item_code'], 1, 0, 'C');
            $pdf->Cell(40, 6, $row['item_name'], 1, 0, 'C');
            $pdf->Cell(25, 6, $row['category'], 1, 0, 'C');
            $pdf->Cell(25, 6, $row['unit_price'], 1, 1, 'C');
        }
    } else {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(59, 5, 'No data found', 0, 0);
    }
    $pdfPath = '../reports/invoiceItemsList.pdf';
    $pdf->Output("F", $pdfPath);
    echo '<script type="text/javascript">';
    echo 'window.open("' . $pdfPath . '", "_blank");';
    echo '</script>';
}
