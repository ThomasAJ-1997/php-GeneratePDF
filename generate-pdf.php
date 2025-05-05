<?php
require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$name = $_POST['name'];
$quantity = $_POST['quantity'];

//$html = "<img src='img/invoice.png'>";
//$html .= "<h1 style='color: cornflowerblue'>Your Invoice</h1>";
//$html .= "Hello <em>$name</em>";
//$html .= "Quantity: $quantity";

$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

$dompdf->setPaper("A4", "landscape");

$html = file_get_contents("template.html");
$html = str_replace(["{{ name }}", "{{ quantity }}"],[$name, $quantity], $html);

$dompdf->loadHtml($html);
//$dompdf->loadHtmlFile("template.html");

$dompdf->render();

$dompdf->addInfo("Title", "Zoho Invoice PDF");

$dompdf->stream("invoice.pdf", array("Attachment" => false));

$output = $dompdf->output();
file_put_contents("file.pdf", $output);