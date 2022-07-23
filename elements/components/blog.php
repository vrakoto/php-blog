<?php foreach ($lesBlogs as $blog) :
    require 'variablesBlog.php';
?>
    <div class="card mx-3 mt-3" style="width: 18rem;">
        <img src="https://static.pexels.com/photos/7096/people-woman-coffee-meeting.jpg" class="card-img-top" alt="Image d'un blog">
        <div class="card-body">
            <h5 class="card-title"><?= $titre ?></h5>
            <p><?= $description ?></p>
            <a href="index.php?p=blog&id=<?= $id ?>" class="btn btn-primary">Consulter</a>
            <?php if ($monBlog): ?>
                <a href="index.php?p=supprimerBlog&id=<?= $id ?>" class="btn btn-danger">Supprimer</a>
            <?php endif ?>
        </div>
    </div>
<?php endforeach ?>