<?php
$i = 8;

/**
 * @throws \Random\RandomException
 */
function getInvoiceCode($i): string
{
    return bin2hex(random_bytes($i / 2));
}

$products = array(
        ["id"=> 1, "item" => "Coffee", "quantity" => 2, "price" => 2.99, "stock" => 10],
    ["id"=> 2, "item" => "Milk", "quantity" => 2, "price" => 1.99, "stock" => 30],
);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<h1>Zoho Invoice PDF Example</h1>

<form method="post" action="generate-pdf.php">
    <h2>Address</h2>
    <label for="address">Address</label>
    <input type="text" name="address" id="address">

    <label for="postcode">Post Code</label>
    <input type="text" name="postcode" id="postcode">

    <label for="email">Email</label>
    <input type="email" name="email" id="email">

    <h2>Sub Information</h2>
    <label for="invoice">Invoice Number</label>
    <input type="text" name="invoice" id="invoice" value="<?= getInvoiceCode($i) ?>">

    <label for="date">Date</label>
    <input type="text" name="date" id="date" value="<?php echo date("Y-m-d")?>">
    <br>


    <button>Generate PDF</button>




</form>

</body>
</html>