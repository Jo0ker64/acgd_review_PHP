<?php include 'Config/database.php';
 $categories = ["Cinéma","Cinéma","Cinéma"];
 $i = 0;

 // i want series1 series2

 foreach($categories as $category) {
     $sql = "SELECT article.title, article.cover, article.description, article.created_at  
             FROM article
             INNER JOIN categories  
                 ON article.categories_id = categories.id 
             WHERE categories.title = '$category'
             ORDER BY article.id DESC
             Limit 6
             ";
     // one for each categories
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     if( $i === 0) {
         $cinéma = $stmt;
     } elseif( $i === 1) {
         $cinéma2 = $stmt;
     } else {
         $cinéma3 = $stmt;
     }
     $i++;
 }
?>



<!DOCTYPE html>
<html lang="en">

<?php include '_partials/head.php';?>

<body>

    <?php include '_partials/header.php';?>

    <main>
        <img src="./assets/image/movie_theatre/Slide/batverse.png" alt="slide" class="p-3 slide">
        <div>
            <h1 class="text-uppercase bold text-center titre py-1">la page des cinéphiles</h1>
        </div>
        <div>
            <h2 class="text-uppercase gras text-center py-2 stitre">bandes-annonces à ne pas manquer</h2>
        </div>
        <div class="text-center">
            <section>
                <article class="d-inline"><a href="./movie_description.php"><img
                            src="./assets/image/movie_theatre/movies/bd1.png" alt="bandes-annonces"></a></article>
                <article class="d-inline"><a href=""><img src="./assets/image/movie_theatre/movies/bd2.png"
                            alt="bandes-annonces"></a></article>
                <article class="d-inline"><a href=""><img src="./assets/image/movie_theatre/movies/bd3.png"
                            alt="bandes-annonces"></a></article>
                <article class="d-inline"><a href=""><img src="./assets/image/movie_theatre/movies/bd4.png"
                            alt="bandes-annonces"></a></article>
                <article class="d-inline"><a href=""><img src="./assets/image/movie_theatre/movies/bd5.png"
                            alt="bandes-annonces"></a></article>
                <article class="d-inline"><a href=""><img src="./assets/image/movie_theatre/movies/bd6.png"
                            alt="bandes-annonces"></a></article>
            </section>
        </div>
        <div>
            <div>
                <h2 class="text-uppercase gras text-center py-2 stitre">actuellement disponible</h2>
            </div>
            <div class="hashtag text-center">
                <a href="https://www.allocine.fr/kids/">
                    <p class="d-inline px-3"><span style="color:#F4661B">#</span> Films pour enfants</p>
                </a>
                <a href="https://www.allocine.fr/film/agenda/">
                    <p class="d-inline px-3"><span style="color:#F4661B">#</span> Agenda des sorties</p>
                </a>
                <a href="https://www.allocine.fr/dvd/">
                    <p class="d-inline px-3"><span style="color:#F4661B">#</span> Sorties DVD Blue-Ray</p>
                </a>
                <a href="https://www.allocine.fr/film/avantpremieres/">
                    <p class="d-inline px-3"><span style="color:#F4661B">#</span> Avant première</p>
                </a>
                <a href="https://www.allocine.fr/boxoffice/france/">
                    <p class="d-inline px-3"><span style="color:#F4661B">#</span> Box Office</p>
                </a>
            </div>

            <section>
                <div>
                    <form class="row">
                        <div class="col-6">
                            <label class="form-label"></label>
                            <input class="form-control light" type="search"
                                placeholder="Rechercher une salle : Dax, CGR, 64100,..." aria-label="Search">
                        </div>
                        <div class="col-6">
                            <label class="form-label"></label>
                            <p> <a href="./login.php" style="color:#434343">Connectez vous pour enregistrer vos films
                                    favoris</a></p>
                        </div>
                    </form>
                </div>
        </div>

        <div class="py-4">
        <section class="text-center series-actu pt-3">
                    <?php while($row = $cinéma->fetch(PDO::FETCH_ASSOC)): ?>
                        <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/covers/<?= $row['cover'] ?>" alt=""></a></article>
                    <?php endwhile; ?>
                </section>
        </div>
        </div>
        <div>
            <div>
                <h2 class="text-uppercase gras text-center py-2 stitre">prochainement</h2>
            </div>
            <div class="py-4">
            <section class="text-center series-actu pt-3">
                    <?php while($row = $cinéma->fetch(PDO::FETCH_ASSOC)): ?>
                        <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/covers/<?= $row['cover'] ?>" alt=""></a></article>
                    <?php endwhile; ?>
                </section>
        </div>
            </div>
        </div>
        <div>
            <div>
                <h2 class="text-uppercase gras text-center py-2 stitre">les plus attendus</h2>
            </div>
            <div class="py-4">
            <section class="text-center series-actu pt-3">
                    <?php while($row = $cinéma->fetch(PDO::FETCH_ASSOC)): ?>
                        <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/covers/<?= $row['cover'] ?>" alt=""></a></article>
                    <?php endwhile; ?>
                </section>
        </div>
            </div>
        </div>
    </main>


    <?php include '_partials/footer.php'; ?>


</body>

</html>