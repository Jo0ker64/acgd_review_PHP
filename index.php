<?php
    include 'Config/Database.php';

    $categories = ["cinéma", "séries", "gaming", "musique", "livres", "évenements"];

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
        $$category = $stmt;
    }

?>
<!DOCTYPE html>
<html lang="en">
    <?php include '_partials/head.php'; ?>
<body>
    <?php include '_partials/header.php'; ?>   
    <main>
        <!--Slider-->
        <div class="row" id="banner">
            <div class="col-12 col-md-12">
                <img src="./assets/image/accueil/slide-acceuil.jpg" alt="slider" width="100.5%" height="305px"
                    class="slider mt-3">
                <!--<h1 class="slide text-center">Actuellement</h1>-->
            </div>
        </div>

        <!--Hook of the web site-->
        <div>
            <h1 class="tittle text-uppercase gras text-center py-3 titre mb-1 "><strong>distinguer le remarquable du
                    banal!</strong></h1>
        </div>
    <h2 class="category text-uppercase gras text-center py-2 stitre"><strong>cinéma</strong></h2>
        <div class="container-fluid">
            <!--Category 1 title-->
            <section class="col-12">
                <div class="row">
                    <!--MOVIE-->
                    <article class="col-4">
                        <img class="mt-5 rounded-5 " src="./assets/image/accueil/cimema-accueil.jpg"
                            alt="image film aquaman" width="100%" height="85%" >
                    </article>
                    <!--Movie section 1-->
                    <div class="col-8 pt-3">
                        <div class="row">
                            <?php while($row = $cinéma->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="col-6">
                                <div class="row">
                                    <article class="col-4 col-lg-6 ">
                                        <img class="img-fluid mt-3 rounded-5"
                                            src="./assets/image/cover/<?= $row['cover'] ?>" alt="image film aquaman"
                                            width="100%" height="100%">
                                    </article>
                                    <article class="col-4 col-lg-6 mt-3">
                                        <h3 class="align-baseline text-capitalize"><strong><?= substr($row['title'], 0, 30) ?></strong></h3>
                                        <p class="overflow-scroll">
                                        
                                        <?= substr($row['description'], 0, 100) ?></p>
                                        <p>publié le <timer><?= $row['created_at'] ?></timer>
                                    </article>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <h2 class="category text-uppercase gras text-center py-2 stitre mt-3"><strong>série</strong></h2>
        <div class="container-fluid">
            <!--Category 2 title-->
            <section class="col-12">
                <div class="row">
                    <!--SERIES-->
                    <div class="col-sm-8 pt-3">
                        <div class="row">
                            <!--Serie section 1-->
                            <?php while($row = $séries->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="col-6">
                                <div class="row">                         
                                    <article class="col-4 col-lg-6 ">
                                        <img class="img-fluid mt-3 rounded-5"
                                            src="./assets/image/cover/<?= $row['cover'] ?>" alt="image film aquaman"
                                            width="100%" height="100%">
                                    </article>
                                    <article class="col-4 col-lg-6  mt-4">
                                        <h3 class="align-baseline text-capitalize"><strong><?= substr($row['title'], 0, 30) ?></strong></h3>
                                        <p class="overflow-scroll ">
                                        <?= substr($row['description'], 0, 100) ?></p>
                                        <p >publié le <timer><?= $row['created_at'] ?></timer>
                                    </article>
                                </div>
                            </div>
                            <?php endwhile; ?>
                         </div>
                    </div>     
                <div class="col-4">
                    <div class="row">
                        <article class="col-12">
                            <img class="mt-5 rounded-5" src="./assets/image/accueil/serie-accueil.jpg"
                                alt="image film aquaman" width="100%" height="95%" >
                        </article>
                    </div>
                </div>
             </section>
        </div>
    <h2 class="category text-uppercase gras text-center py-2 stitre mt-3"><strong>gaming</strong></h2>
        <div class="container-fluid">
            <!--Category 3 title-->
            <section class="col-12">
                <div class="row">
                    <!--GAMING-->
                    <article class="col-4">
                        <img class="mt-5 rounded-5" src="./assets/image/accueil/gaming-accueil.jpg"
                            alt="image film aquaman" width="100%" height="85%" >
                    </article>
                    <div class="col-8">
                        <div class="row">
                            <!--Gaming section 1-->
                            <?php while($row = $gaming->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="col-6">
                                <div class="row">
                                    <article class="col-4 col-lg-6 ">
                                        <img class="img-fluid mt-3 rounded-5"
                                            src="./assets/image/cover/<?= $row['cover'] ?>" alt="image film aquaman"
                                            width="100%" height="100%">
                                    </article>
                                    <article class="col-4 col-lg-6 mt-3">
                                        <h3 class="align-baseline text-capitalize"><strong><?= substr($row['title'], 0, 30)?></strong></h3>
                                        <p class="overflow-scroll">
                                        <?= substr($row['description'], 0, 100) ?></p>
                                        <p>publié le <timer><?= $row['created_at'] ?></timer>
                                    </article>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <h2 class="category text-uppercase gras text-center py-2 stitre mt-3"><strong>musique</strong></h2>
        <div class="container-fluid">
            <!--Category 4 title-->
            <section class="col-12">
                <div class="row">
                    <!--MUSIC-->
               <div class="col-sm-8">
                        <div class="row">
                            <!--Music section 1-->
                            <?php while($row = $musique->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="col-6">
                                <div class="row">
                                    <article class="col-4 col-lg-6 ">
                                        <img class="img-fluid mt-3 rounded-5"
                                            src="./assets/image/cover/<?= $row['cover'] ?>" alt="image film aquaman"
                                            width="100%" height="100%">
                                    </article>
                                    <article class="col-4 col-lg-6  mt-4">
                                        <h3 class="align-baseline text-capitalize"><strong><?= substr($row['title'], 0, 30)?></strong></h3>
                                        <p class="overflow-scroll ">
                                        <?= substr($row['description'], 0, 100) ?></p>
                                        <p >publié le <timer><?= $row['created_at'] ?></timer>
                                    </article>
                                </div>
                            </div>
                            <?php endwhile; ?>
                         </div>
                    </div>     
                <div class="col-4">
                    <div class="row">
                        <article class="col-12">
                            <img class="mt-5 rounded-5" src="./assets/image/accueil/musique-accueil.jpg"
                                alt="image film aquaman" width="100%" height="90%" >
                        </article>
                    </div>
                </div>
             </section>
        </div>
    <h2 class="category text-uppercase gras text-center py-2 stitre mt-3"><strong>livre</strong></h2>
        <div class="container-fluid">
            <!--Category 5 title-->
            <section class="col-12">
                <div class="row">
                    <!--BOOK-->
                    <article class="col-4">
                        <img class="mt-5 rounded-5" src="./assets/image/accueil/livre-accueil.jpg"
                            alt="image film aquaman" width="100%" height="85%" >
                    </article>
                    <div class="col-8">
                        <div class="row">
                            <!--Book section 1-->
                            <?php while($row = $livres->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="col-6">
                                <div class="row">
                                    <article class="col-4 col-lg-6 ">
                                        <img class="img-fluid mt-3 rounded-5"
                                            src="./assets/image/cover/<?= $row['cover'] ?>" alt="image film aquaman"
                                            width="100%" height="100%">
                                    </article>
                                    <article class="col-4 col-lg-6  mt-4">
                                        <h3 class="align-baseline text-capitalize"><strong><?= substr($row['title'], 0, 30)?></strong></h3>
                                        <p class="overflow-scroll ">
                                        <?= substr($row['description'], 0, 100) ?></p>
                                        <p >publié le <timer><?= $row['created_at'] ?></timer>
                                    </article>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <h2 class="category text-uppercase gras text-center py-2 stitre mt-3"><strong>événement</strong></h2>
        <div class="container-fluid">
            <!--Category 6: title-->
            <section class="col-12">
                <div class="row">
                    <!--EVENTS-->
                    <div class="col-sm-8">
                        <div class="row">
                            <!--Event section 1-->
                            <?php while($row = $évenements->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="col-6">
                                <div class="row">
                                    <article class="col-4 col-lg-6 ">
                                        <img class="img-fluid mt-3 rounded-5"
                                            src="./assets/image/cover/<?= $row['cover'] ?>" alt="image film aquaman"
                                            width="100%" height="100%">
                                    </article>
                                    <article class="col-4 col-lg-6 mt-3">
                                        <h3 class="align-baseline text-capitalize"><strong><?= substr($row['title'], 0, 30)?></strong></h3>
                                        <p class="overflow-scroll ">
                                        <?= substr($row['description'], 0, 100) ?></p>
                                        <p >publié le <timer><?= $row['created_at'] ?></timer>
                                    </article>
                                </div>
                            </div>
                            <?php endwhile; ?>
                         </div>
                    </div> 
                <div class="col-4">
                    <div class="row">
                        <article class="col-12">
                            <img class="mt-5 rounded-5" src="./assets/image/accueil/event-accueil.jpg"
                                alt="image catégorie événements" width="100%" height="90%" >
                        </article>
                    </div>
                </div>
             </section>
                <!--arrow go top page-->
                <div class="limit text-center pb-5">
                    <a href="#"><img src="./assets/image/accueil/fleche-toppage.svg" alt="fleche retour haut de la page accueil" class=""></a>
                </div>
            </section>
        </div>
    </main>
    <?php include '_partials/footer.php'; ?>
</body>
</html>