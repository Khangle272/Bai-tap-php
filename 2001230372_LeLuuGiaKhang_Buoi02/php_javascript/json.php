<?php
$data = ["name" => "Khang", "age" => 20];
echo json_encode($data);
?>

<script>
    let obj = JSON.parse('{"name":"Khang","age":21}');
    console.log(obj.name, obj.age);
</script>