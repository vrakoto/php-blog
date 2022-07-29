<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="<?= $avatar ?>" alt="Mon avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3"><?= $identifiant ?></h5>
                    <a href="index.php?p=utilisateur&identifiant=<?= $monIdentifiant ?>">Consulter mon profil</a>
                </div>
            </div>

            <form class="card mb-4 mb-lg-0" action="index.php?p=updateMonProfil" method="POST">
                <h3 class="text-center mt-2 mb-0">Paramètres</h3>
                <div class="card-body">

                    <?php foreach ($lesParams as $param) :
                        require COMPONENTS . 'variablesParametres.php';
                    ?>
                        <?= form_checkbox($varParam, $refParam, $checkedParam) ?>
                    <?php endforeach ?>

                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>
            </form>
        </div>

        <div class="col-lg-8">
            <form class="card mb-4" action="index.php?p=updateMonProfil" method="POST">
                <div class="card-body">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-3">
                            <p class="mb-0">Avatar (URL uniquement)</p>
                        </div>
                        <div class="col-sm-7">
                            <input name="avatar" id="imgURL" type="text" class="form-control" value="<?= $avatar ?>">
                        </div>

                        <div class="col-sm-2">
                            <span class="btn btn-warning" onclick="baseURLImage()">Reset URL</span>
                        </div>
                    </div>

                    <hr>

                    <div class="row d-flex align-items-center">
                        <div class="col-sm-2">
                            <p class="mb-0">Nom</p>
                        </div>
                        <div class="col-sm-10">
                            <input name="nom" type="text" class="form-control" value="<?= $nom ?>">
                        </div>
                    </div>

                    <hr>

                    <div class="row d-flex align-items-center">
                        <div class="col-sm-2">
                            <p class="mb-0">Prénom</p>
                        </div>
                        <div class="col-sm-10">
                            <input name="prenom" type="text" class="form-control" value="<?= $prenom ?>">
                        </div>
                    </div>

                    <hr class="mb-0">
                </div>

                <div class="d-inline-block text-center mb-3">
                    <button class="btn btn-success" type="submit">Mettre à jour</button>
                </div>
            </form>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 mb-md-0">
                        <div class="card-body">
                            <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                            </p>
                            <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                            <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                            <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                            <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                            <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                            <div class="progress rounded mb-2" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>