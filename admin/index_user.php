<?php 
session_start();
if(!isset($_SESSION['email'])){
	header('Location: ../login.php');
}
    include '../Config/database.php';
    global $message;
    
    // Methode pour update un user
    if(isset($_GET['method']) && $_GET['method'] == 'update'){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM user WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    if(isset($_GET['update']) && $_GET['update'] == 'update'){
        $id = $_POST['id'];
        $email = $_POST['email'];
        $is_valide = $_POST['is_valide'];

        if($is_valide == 'on'){
            $is_valide = true;
        }else {
            $is_valide = false;
        }

        $sql="UPDATE user SET email = :email, is_valide = :is_valide
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'is_valide' => $is_valide,
            'id' => $id
        ]);
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style type="text/css">
.tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
.tftable tr {background-color:#d4e3e5;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
.tftable tr:hover {background-color:#ffffff;}
</style>

<form method="post" action="index_user.php?update=update">

<table class="tftable" border="1">
<tr><th>Informations</th><th>Value</th></tr>
<tr><td>ID</td><td><input type="text" name="id" value="<?=  $user['id'] ? $user['id'] : '' ?>"></td></tr>
<tr><td>Pseudo</td><td><input type="text" name="pseudo" value="<?=  $user['pseudo'] ? $user['pseudo'] : '' ?>"></td></tr>
<tr><td>email </td><td><input type="text" name="email" value="<?=  $user['email'] ? $user['email'] : '' ?>"></td></tr>
<tr><td>birth_date</td><td><input type="text" name="birth_date" value="<?=  $user['birth_date'] ? $user['birth_date'] : '' ?>"></td></tr>
<tr><td>is_valide</td><td><input type="checkbox" name="is_valide" <?= $user['is_valide'] == 1 ? 'checked' :'' ?>></td></tr>
<tr><td>updated_at</td><td><input type="text" name="updated_at" value="<?=  $user['updated_at'] ? $user['updated_at'] : '' ?>"></td></tr>
<tr><td>picture</td><td></td></tr>
<tr><td>banner</td><td></td></tr>



</table>
<button type="submit">Envoyer</button>
</form>

</body>
</html>