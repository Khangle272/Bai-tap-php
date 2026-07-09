<?php
require 'autoload.php';

use students\student;

$student1 = new Student("Nguyễn Văn A", 20, "SV001");
$student2 = new Student("Trần Thị B", 21, "SV002");
$student3 = new Student("Lê Văn C", 22, "SV003");

echo "<ul>";
echo "<li>" . $student1->getStudentInfo() . "</li>";
echo "<li>" . $student2->getStudentInfo() . "</li>";
echo "<li>" . $student3->getStudentInfo() . "</li>";
echo "</ul>";
?>