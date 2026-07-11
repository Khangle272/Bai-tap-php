<?php
header("Content-Type: application/json");

$file = "data.json";

if($_SERVER["REQUEST_METHOD"] === 'GET')
{
    if(file_exists($file))
    {
        $data = file_get_contents($file);
        echo $data;
    } else {
        echo '[]';
    }

}

if($_SERVER["REQUEST_METHOD"] === 'POST')
{
    $inputJSON = file_get_contents('php://input');

    if(file_put_contents($file, $inputJSON))
    {
        echo json_encode(array(['status' => 'success','message'=> 'Đã lưu dữ liệu thành công']));
    } else {
        echo json_encode(array('status'=> 'error','message'=> 'Không thể ghi file'));
    }
}
?>