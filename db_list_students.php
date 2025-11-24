<?php
require 'db_connect.php';
$pdo=getDbConnection();
$st=$pdo->query("SELECT * FROM students");
$rows=$st->fetchAll();
?>
<table border=1>
<tr><th>ID</th><th>Name</th><th>Matricule</th><th>Group</th><th>Actions</th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?= $r['id'] ?></td>
<td><?= htmlspecialchars($r['fullname']) ?></td>
<td><?= htmlspecialchars($r['matricule']) ?></td>
<td><?= htmlspecialchars($r['group_id']) ?></td>
<td>
<a href="db_update_student.php?id=<?= $r['id'] ?>">Edit</a>
<a href="db_delete_student.php?id=<?= $r['id'] ?>">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</table>