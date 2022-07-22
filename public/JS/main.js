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
    const titreBlogs = document.querySelectorAll('.card-title');
    let maRecherche = currentInput.value.toLowerCase();
    
    for (let i = 0; i < titreBlogs.length; i++) {
        const leTitre = titreBlogs[i];
        const leBlog = leTitre.closest('.card.mx-3');
        const leTitreText = leTitre.textContent.toLowerCase();
        
        if (!leTitreText.includes(maRecherche)) {
            leBlog.classList.add("filtrerRechercheCategorie");
        } else {
            leBlog.classList.remove("filtrerRechercheCategorie");
        }
    }
}