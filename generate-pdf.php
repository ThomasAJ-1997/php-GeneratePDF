<?php
require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$address = $_POST['address'];
$postcode = $_POST['postcode'];
$email = $_POST['email'];
$invoice = $_POST['invoice'];
$date = $_POST['date'];

$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

$dompdf->setPaper("A4", "landscape");

$html = file_get_contents("template.html");
$html = str_replace(["{{ address }}", "{{ postcode }}", "{{ email }}", "{{ invoice }}",
    "{{ date }}"],
    [$address, $postcode, $email, $invoice, $date], $html);


$dompdf->loadHtml($html);
//$dompdf->loadHtmlFile("template.html");

$dompdf->render();

$dompdf->addInfo("Title", "Zoho Invoice PDF");

$dompdf->stream("invoice.pdf", array("Attachment" => false));

$output = $dompdf->output();
file_put_contents("file.pdf", $output);