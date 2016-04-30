<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(404);
  exit(0);
}

$gpio14 = exec('gpio -g read 14');
$gpio15 = exec('gpio -g read 15');

http_response_code(200);
echo json_encode(["status" => 200, "gpio14" => $gpio14, "gpio15" => $gpio15]);
