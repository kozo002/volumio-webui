<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(404);
  exit(0);
}

/*
右 オーディオミニジャック
*/

exec('which gpio > /dev/null 2>&1 && gpio -g mode 14 out && gpio -g mode 15 out && gpio -g write 14 1 && gpio -g write 15 1');

http_response_code(201);
echo json_encode(["status" => 201]);
