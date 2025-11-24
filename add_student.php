<?php
header('Content-Type: text/html; charset=utf-8');
function redirect($msg) {
    echo "<p>$msg</p><p><a href='add_student_form.html'>Back</a></p>";
    exit;
}
$student_id = trim($_POST['student_id'] ?? '');
$name = trim($_POST['name'] ?? '');
$group = trim($_POST['group'] ?? '');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('Please submit the form.');
if ($student_id === '' || $name === '' || $group === '') redirect('All fields are required.');
if (!preg_match('/^[\w-]+$/', $student_id)) redirect('Invalid student ID.');
$file = __DIR__ . '/students.json';
$students = [];
if (file_exists($file)) {
    $decoded = json_decode(file_get_contents($file), true);
    if (is_array($decoded)) $students = $decoded;
}
foreach ($students as $s) {
    if ($s['student_id'] === $student_id) redirect("Student with ID $student_id already exists.");
}
$new = ['student_id'=>$student_id,'name'=>$name,'group'=>$group];
$students[]=$new;
$encoded=json_encode($students,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
file_put_contents($file,$encoded,LOCK_EX);
echo "<p>Student added successfully.</p>";
?>