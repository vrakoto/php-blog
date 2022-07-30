<div class="p-3">
    <h1 class="text-center mb-5">Statistiques</h1>

    <div class="d-flex flex-wrap justify-content-around">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center mb-3"><u>Blog créés globalement</u></h5>
                <div class="d-flex flex-wrap justify-content-between">
                    <p>Aujourd'hui</p>
                    <p><?= $nbBlogToday ?></p>
                </div>
                <div class="d-flex flex-wrap justify-content-between">
                    <p>Cette semaine</p>
                    <p><?= $nbBlogThisWeek ?></p>
                </div>
                <div class="d-flex flex-wrap justify-content-between">
                    <p>Ce mois</p>
                    <p><?= $nbBlogMonth ?></p>
                </div>
                <div class="d-flex flex-wrap justify-content-between">
                    <p>Cette année</p>
                    <p><?= $nbBlogYear ?></p>
                </div>
                <div class="d-flex flex-wrap justify-content-between">
                    <p>Total</p>
                    <p><?= $nbBlogTotal ?></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center mb-3"><u>Catégorie populaire</u></h5>
                <div class="mt-3">
                    <?php foreach ($lesCategories as $categorie) :
                        $intitule = htmlspecialchars($categorie['intitule']);
                        $nbBlogs = (int)$categorie['nbBlogs'];
                    ?>
                        <div class="d-flex flex-wrap justify-content-between">
                            <a href="index.php?p=lesBlogs&categorie=<?= $intitule ?>"><?= ucfirst($intitule) ?></a>
                            <p><?= $nbBlogs ?></p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>

        <?php if ($estConnecte) : ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-3"><u>Vos statistiques</u></h5>
                    <div class="d-flex flex-wrap justify-content-between">
                        <p>Aujourd'hui</p>
                        <p><?= $nbBlogTodayUser ?></p>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between">
                        <p>Cette semaine</p>
                        <p><?= $nbBlogThisWeekUser ?></p>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between">
                        <p>Ce mois</p>
                        <p><?= $nbBlogMonthUser ?></p>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between">
                        <p>Cette année</p>
                        <p><?= $nbBlogYearUser ?></p>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between">
                        <p>Total</p>
                        <p><?= $nbBlogTotalUser ?></p>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>