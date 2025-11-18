<?php
// webhook.php - placeholder to receive payment notifications
// In production implement MercadoPago SDK or verify signatures
$raw = file_get_contents('php://input');
file_put_contents(__DIR__.'/../logs/webhook_'.time().'.log', $raw);
http_response_code(200);
echo 'OK';
