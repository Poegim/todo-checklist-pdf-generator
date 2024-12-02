<?php

require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true); 
$options->set('isPhpEnabled', true); 
$dompdf = new Dompdf($options);

$title = $_POST['title'] ?? 'Untitled Checklist';
$list = $_POST['list'] ?? [];

$html = '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; margin: 0; }
        h1 { text-align: center; color: #333; font-size: 24px; margin-bottom: 20px; }

        ul {
            list-style: none; 
            padding-left: 0;
        }

        li {
            display: flex;
            align-items: center; 
            margin: 10px 0;
            font-size: 18px;
        }

        li::before {
            content: "";
            width: 20px;
            height: 20px;
            border: 2px solid #333;
            border-radius: 3px;
            margin-right: 10px;
            display: inline-block;
            vertical-align: middle; 
        }
    </style>
</head>
<body>
    <h1>' . htmlspecialchars($title) . '</h1>
    <ul>';

foreach ($list as $item) {
    $html .= '<li>' . htmlspecialchars($item) . '</li>';
}

$html .= '</ul>
</body>
</html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="checklist.pdf"');

$dompdf->render();
$dompdf->stream();
?>
