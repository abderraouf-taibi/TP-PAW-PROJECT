<?php
require 'db_connect.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $pdo=getDbConnection();
 $stmt=$pdo->prepare("INSERT INTO students(fullname,matricule,group_id) VALUES(?,?,?)");
 $stmt->execute([$_POST['fullname'],$_POST['matricule'],$_POST['group_id']]);
 echo "Added.";
 exit;
}
?>
<form method="post">
<input name="fullname" placeholder="Full name" required>
<input name="matricule" placeholder="Matricule" required>
<input name="group_id" placeholder="Group" required>
<button>Add</button>
</form>