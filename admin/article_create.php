<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

include '../Config/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /**
     * si le fichier est bien envoyé
     */
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
        $file = $_FILES['cover'];
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        move_uploaded_file($file['tmp_name'], '../assets/img/cover/' . $filename);
    }

    /**
     * ENTREE EN BDD
     */
    $titre = $_POST['title'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $youtube = $_POST['youtube'];
    $categorie = $_POST['category'];
    $user_id = $_SESSION['id'];   

    // si distribution est vide 
    if (empty($_POST['text'])) {
        $distribution = json_encode([]);
    } else {
        $distribution = json_encode($_POST['text']);
    }

    $data = [
        'title' => $titre,
        'slug' => $slug,
        'description' => $description,
        'youtube' => $youtube,
        'categories_id' => $categorie,
        'distribution' => $distribution,
        'created_at' => date('Y-m-d H:i:s'),
        'user_id' => $user_id,
        'cover' => $filename
    ];
    $sql = "INSERT INTO article (our_review, cover, title, slug, description, youtube, categories_id , created_at, `distribution`, `user_id`  ) 
                VALUES ('', :cover, :title, :slug, :description, :youtube, :categories_id , :created_at, :distribution, :user_id  )";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);

    // recupere le dernier id
    $last_id = $conn->lastInsertId();
    
    // si des fichiers sont envoyés
    if (isset($_FILES['files'])) {
       $countFiles = count($_FILES['files']['name']);
       for ($i = 0; $i < $countFiles; $i++) {
              if ($_FILES['files']['error'][$i] == 0) {
                $file = $_FILES['files'];
                $extension = pathinfo($file['name'][$i], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $extension;
                move_uploaded_file($file['tmp_name'][$i], '../assets/img/cover/' . $filename);
                    $sql = "INSERT INTO picture  (`name`, `alt`, `position`, `article_id`)
                        VALUES (:name, :alt, :position, :article_id)";     
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        'name' => $filename,
                        'alt' => $filename,
                        'position' => $i,
                        'article_id' => $last_id
                    ]); 
              }
       }
    }

    header('Location: article.php');
}

$sql = "SELECT id, title FROM categories";
$cat = $conn->prepare($sql);
$cat->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="title" id="title" placeholder="Title"> <br>
        
        <input type="file" name="cover" id="cover" placeholder="cover"><br>

        <select name="category" id="category">
            <?php
            while ($row = $cat->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
            }
            ?>
        </select><br>
        <input type="text" name="slug" id="slug" placeholder="slug"><br>
        <textarea name="description" id="description" cols="30" rows="10"></textarea><br>
        <input type="text" name="youtube" id="youtube" placeholder="youtube"><br>
       

        <input type="file" multiple name="files[]" label="Drop files here or click to upload." help="Upload files here and they won't be sent immediately" is="drop-files" />
        <!-- je veux un input avec un a href qui me permet de rajouter des inputs -->
        <!-- HTML + JS -->
        <a href="#" id="addInput">Add input</a>


        <button type="submit">Create</button>
    </form>

    <script type="module" src="//unpkg.com/@grafikart/drop-files-element"></script>
    <script>
        document.getElementById('addInput').addEventListener('click', function(e) {
            e.preventDefault();
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'text[]';
            document.querySelector('form').appendChild(input);
        });
    </script>

</body>

</html>