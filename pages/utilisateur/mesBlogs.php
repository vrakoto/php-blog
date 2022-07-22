<div class="container mt-5">
    <h3 class="text-center">Mes blogs</h3>
    <input type="text" class="form-control mt-3" oninput="rechercherBlog(this)" placeholder="Rechercher un blog" autofocus>

    <div class="d-flex justify-content-center mt-5">
        <?php require_once COMPONENTS . 'blog.php' ?>
    </div>
</div>