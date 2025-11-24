<?php
require 'db_connect.php';
$pdo=getDbConnection();
$id=(int)($_GET['id']??0);
if($_SERVER['REQUEST_METHOD']==='POST'){
 $stmt=$pdo->prepare("UPDATE students SET fullname=?,matricule=?,group_id=? WHERE id=?");
 $stmt->execute([$_POST['fullname'],$_POST['matricule'],$_POST['group_id'],$id]);
 echo "Updated."; exit;
}
$stmt=$pdo->prepare("SELECT * FROM students WHERE id=?");
$stmt->execute([$id]);
$s=$stmt->fetch();
?>
<form method="post">
<input name="fullname" value="<?= htmlspecialchars($s['fullname']) ?>">
<input name="matricule" value="<?= htmlspecialchars($s['matricule']) ?>">
<input name="group_id" value="<?= htmlspecialchars($s['group_id']) ?>">
<button>Save</button>
</form>