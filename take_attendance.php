<?php
header('Content-Type: text/html; charset=utf-8');
$studentsFile = __DIR__ . '/students.json';
if (!file_exists($studentsFile)) { echo "No students.json found."; exit; }
$students = json_decode(file_get_contents($studentsFile), true);
$today = date('Y-m-d');
$attFile = __DIR__ . "/attendance_{$today}.json";
if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (file_exists($attFile)) { echo "Attendance already taken."; exit; }
    $result=[];
    foreach ($students as $s) {
        $id=$s['student_id'];
        $status=($_POST['status'][$id]??'absent')==='present'?'present':'absent';
        $result[]=['student_id'=>$id,'status'=>$status];
    }
    file_put_contents($attFile,json_encode($result,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE),LOCK_EX);
    echo "Attendance saved.";
    exit;
}
?>
<!doctype html><html><body>
<h2>Take attendance for <?= $today ?></h2>
<?php if (file_exists($attFile)): ?>
<p>Attendance already taken.</p>
<?php else: ?>
<form method="post">
<table border="1">
<tr><th>ID</th><th>Name</th><th>Group</th><th>Status</th></tr>
<?php foreach ($students as $s): ?>
<tr>
<td><?= htmlspecialchars($s['student_id']) ?></td>
<td><?= htmlspecialchars($s['name']) ?></td>
<td><?= htmlspecialchars($s['group']) ?></td>
<td>
<label><input type="radio" name="status[<?= htmlspecialchars($s['student_id']) ?>]" value="present" checked>Present</label>
<label><input type="radio" name="status[<?= htmlspecialchars($s['student_id']) ?>]" value="absent">Absent</label>
</td>
</tr>
<?php endforeach; ?>
</table>
<button>Save</button>
</form>
<?php endif; ?>
</body></html>