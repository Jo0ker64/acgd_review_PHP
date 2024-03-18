<?php 

// session_start();
// if(!isset($_SESSION['email'])){
// 	header('Location: article.php');
// }
 include '../Config/database.php';
    global $message ;

   
    // Création du CRUD

    // méthode pour supprimer un utilisateur
    if(isset($_GET['method']) && $_GET['method'] == 'delete'){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM article WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $message = "<div class='alert alert-success text center'>L'article a été supprimé </div>";
        }
    }

    // Methode pour modifier un utilisateur

    

    //méthode pour lister les articles
    $sql = "SELECT article.*, categories.title AS toto FROM article
    INNER JOIN categories ON article.categories_id = categories.id order by created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
// var_dump($stmt->fetch(PDO::FETCH_ASSOC));

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
.tftable {font-size:12px;color:#fbfbfb;width:100%;border-width: 1px;border-color: #686767;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#171515;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;text-align:left;}
.tftable tr {background-color:#2f2f2f;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;}
.tftable tr:hover {background-color:#171515;}
</style>
<?= $message ?>
<table class="tftable" border="1">
<tr><th>Id</th><th>Image</th><th>Title</th><th>Categories</th><th>Slug</th><th>Article crée le </th><th>Détails</th><th>Modifier</th><th>Supprimer</th></tr>

<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
<tr><td><?= $row['id'] ?></td><td><?= $row['cover'] ?></td><td><?= $row['title'] ?></td><td><?= $row['toto'] ?></td><td><?= $row['slug'] ?></td><td><?= $row['created_at'] ?></td>
    <td><a href="">Voir plus</a> </td>
    <td><a href="article_update.php?method=update&id=<?=$row['id'] ?>">Modifier</a></td>
    <td><a href="article.php?method=delete&id=<?=$row['id'] ?>">Supprimer</a> </td>
</tr>
<?php } ?>
</table>


</body>
</html>