<?php
header("Content-Type: application/json");

$apiUrl = "https://open.er-api.com/v6/latest/USD";

$respone = @file_get_contents( $apiUrl );

if( $respone !== false )
{
    echo $respone;
} else {
    $fallback = [
        "result" => "success",
        "time_last_update_unix" => time(),
        "base_code" => "USD",
        "rates" => [
            "VND" => 25450,
            "EUR" => 0.92,
            "JPY" => 155.5,
            "GBP" => 0.79,
            "AUD" => 1.52
        ]
    ];

    echo json_encode( $fallback );
}
?>