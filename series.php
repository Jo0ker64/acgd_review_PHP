<?php
    // phpinfo();
    include 'Config/Database.php';

    $categories = ["séries","séries","séries"];
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
            $séries = $stmt;
        } elseif( $i === 1) {
            $séries2 = $stmt;
        } else {
            $séries3 = $stmt;
        }
        $i++;
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <?php include '_partials/head.php'; ?>
<body>
    <?php include '_partials/header.php'; ?>
    <main>
        <img src="./assets/image/series/slide1.png" alt="" class="mt-3 series-slide">
        <div>
            <h1 class="text-uppercase series-bold text-center series-titre py-1">la page des série-maniac</h1>
        </div>
        <div>
            <h2 class="text-uppercase series-gras text-center py-2 series-stitre">bandes-annonces à ne pas manquer</h2>
        </div>
        <div class="text-center">
            <p class="series-p">Toutes les bandes-annonces a ne pas manquer.</p>
            <section>
                <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/series/bd1.png" alt="bandes-annonces"></a></article>
                <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/series/bd2.png" alt="bandes-annonces"></a></article>
                <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/series/bd3.png" alt="bandes-annonces"></a></article>
                <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/series/bd4.png" alt="bandes-annonces"></a></article>
                <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/series/bd5.png" alt="bandes-annonces"></a></article>
                <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/series/bd6.png" alt="bandes-annonces"></a></article>
            </section>
        </div>
        <div>
            <div>
                <h2 class="text-uppercase series-gras text-center py-2 series-stitre">actuellement disponible</h2>
            </div>
            <div class="series-black series-hashtag text-center">
                <a href=""><p class="d-inline px-3 series-p series-a series-ap">#Séries pour enfants</p></a>
                <a href=""><p class="d-inline px-3 series-p series-a series-ap">#Agenda des sorties</p></a>
                <a href=""><p class="d-inline px-3 series-p series-a series-ap">#Sorties streaming du mois</p></a>
                <a href=""><p class="d-inline px-3 series-p series-a series-ap">#Actus sorties séries</p></a>
                <a href=""><p class="d-inline px-3 series-p series-a series-ap">#Box Office</p></a>
            </div>
            <div class="py-4">
                <div class="text-center">
                    <a class="series-a" href=""><img src="./assets/image/series/actdispobande.png" alt="" class="series-mob"></a>
                    <a class="series-a" href=""><img src="./assets/image/series/affichemob.png" alt="" class="series-mob2"></a>
                </div>
                <section class="text-center series-actu pt-3">
                    <?php while($row = $séries->fetch(PDO::FETCH_ASSOC)): ?>
                        <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/covers/<?= $row['cover'] ?>" alt=""></a></article>
                    <?php endwhile; ?>
                </section>
            </div>
        </div>
        <div>
            <div>
                <h2 class="text-uppercase series-gras text-center py-2 series-stitre">prochainement</h2>
            </div>
            <div class="py-4">
                <div class="text-center">
                    <a class="series-a" href=""><img src="./assets/image/series/bannerpro.png" alt="" class="series-mob"></a>
                    <a class="series-a" href=""><img src="./assets/image/series/prochainementbannermob.png" alt="" class="series-mob2"></a>
                </div>
                <section class="text-center series-actu pt-3">
                    <?php while($row = $séries2->fetch(PDO::FETCH_ASSOC)): ?>
                        <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/covers/<?= $row['cover'] ?>" alt=""></a></article>
                    <?php endwhile; ?>
                </section>
            </div>
        </div>
        <div>
            <div>
                <h2 class="text-uppercase series-gras text-center py-2 series-stitre">les plus attendus</h2>
            </div>
            <div class="py-4">
                <div class="text-center">
                    <a class="series-a" href=""><img src="./assets/image/series/bannerattendues.png" alt="" class="series-mob"></a>
                    <a class="series-a" href=""><img src="./assets/image/series/attenduemob.png" alt="" class="series-mob2"></a>
                </div>
                <section class="text-center series-actu pt-3">
                    <?php while($row = $séries3->fetch(PDO::FETCH_ASSOC)): ?>
                        <article class="d-inline"><a class="series-a" href=""><img src="./assets/image/covers/<?= $row['cover'] ?>" alt=""></a></article>
                    <?php endwhile; ?>
                </section>
            </div>
        </div>
    </main>
    <?php include '_partials/footer.php'; ?>
</body>
</html>