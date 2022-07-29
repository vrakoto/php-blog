<div class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <div class="card">

                    <div class="userProfil-header rounded-top text-white">
                        <div class="ms-4 mt-5 d-flex align-items-center">
                            <img src="<?= $avatar ?>" class="userProfil-avatar img-fluid img-thumbnail mt-4 mb-2" alt="Avatar de l'utilisateur">
                            <div class="ms-3">
                                <h5><?= ucfirst($prenom) . ' ' . ucfirst($nom) ?></h5>
                                <div class="form-text">Depuis le <?= $dateCreation ?></div>
                            </div>
                        </div>
                    </div>

                    <?php if ($monIdentifiant === $identifiant) : ?>
                        <div class="userProfil-stats d-flex justify-content-between align-items-center text-black p-3">
                            <a href="index.php?p=parametres" class="btn btn-primary">Editer mon profil</a>
                            <div class="d-flex justify-content-evenly text-center">
                                <div>
                                    <h5 class="mb-1"><?= $nbBlogYear ?></h5>
                                    <p class="small text-muted mb-0">Total</p>
                                </div>
                                <div class="px-3">
                                    <h5 class="mb-1"><?= $nbBlogThisWeek ?></h5>
                                    <p class="small text-muted mb-0">Semaine</p>
                                </div>
                                <div>
                                    <h5 class="mb-1"><?= $nbBlogMonth ?></h5>
                                    <p class="small text-muted mb-0">Mois</p>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php if ($statistiquesEnabled): ?>
                            <div class="userProfil-stats otherUser text-black">
                                <h5 class="text-center mt-4"><u>Blogs statistiques</u></h5>
                                <div class="d-flex justify-content-around text-center mt-4">
                                    <div>
                                        <h5 class="mb-1"><?= $nbBlogYear ?></h5>
                                        <p class="small text-muted mb-0">Total</p>
                                    </div>
                                    <div class="px-3">
                                        <h5 class="mb-1"><?= $nbBlogThisWeek ?></h5>
                                        <p class="small text-muted mb-0">Cette semaine</p>
                                    </div>
                                    <div>
                                        <h5 class="mb-1"><?= $nbBlogMonth ?></h5>
                                        <p class="small text-muted mb-0">Ce Mois</p>
                                    </div>
                                    <div>
                                        <h5 class="mb-1"><?= $nbBlogYear ?></h5>
                                        <p class="small text-muted mb-0">Cette année</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="userProfil-stats">
                                <h5 class="text-center mt-4"><u>Cet utilisateur a désactivé ses statistiques.</u></h5>
                            </div>
                        <?php endif ?>
                    <?php endif ?>

                    <div class="d-flex justify-content-between align-items-center m-3">
                        <p class="lead fw-normal mb-0"><?= $phraseSectionBlog ?></p>
                        <p class="mb-0"><a href="index.php?p=lesBlogs&identifiant=<?= $identifiant ?>" class="text-muted">Tous montrer</a></p>
                    </div>

                    <div class="d-flex justify-content-center row g-2 m-2">
                        <?php require_once COMPONENTS . 'blog.php' ?>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center m-3">
                        <p class="lead fw-normal mb-0"><?= $phraseSectionCommentaire ?></p>
                        <p class="mb-0"><a href="#!" class="text-muted">Tous montrer</a></p>
                    </div>

                    <div class="d-flex justify-content-center row g-2 m-2">
                        <?php require_once COMPONENTS . 'blog-commentaire.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>