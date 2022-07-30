function rechercherCategorie(currentInput) {
    const lesCategories = document.querySelectorAll('.lesCategories');
    let maRecherche = currentInput.value.toLowerCase();
    
    for (let i = 0; i < lesCategories.length; i++) {
        const laCategorie = lesCategories[i];
        const laCategorieText = laCategorie.textContent.toLowerCase();
        
        if (!laCategorieText.includes(maRecherche)) {
            laCategorie.classList.add("filtrerRechercheCategorie");
        } else {
            laCategorie.classList.remove("filtrerRechercheCategorie");
        }
    }
}

function rechercherBlog(currentInput) {
    const titreBlogs = document.querySelectorAll('.titre');
    let maRecherche = currentInput.value.toLowerCase();
    
    for (let i = 0; i < titreBlogs.length; i++) {
        const leTitre = titreBlogs[i];
        const leBlog = leTitre.closest('.leBlog');
        const leTitreText = leTitre.textContent.toLowerCase();
        
        if (!leTitreText.includes(maRecherche)) {
            leBlog.classList.add("filtrerRechercheCategorie");
        } else {
            leBlog.classList.remove("filtrerRechercheCategorie");
        }
    }
}

function baseURLImage() {
    const imgURL = "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Breezeicons-actions-22-im-user.svg/1200px-Breezeicons-actions-22-im-user.svg.png"
    document.querySelector('#imgURL').value = imgURL
}