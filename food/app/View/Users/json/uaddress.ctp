<?php
header("Pragma: no-cache");
header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
header('Content-Type: text/x-json');
header('Content-type: application/json');
echo json_encode($address);
?>