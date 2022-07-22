const inputRecherche = document.querySelector('#searchCateg');
const lesCategories = document.querySelectorAll('.lesCategories');

inputRecherche.addEventListener('input', function (e) {
    let maRecherche = e.currentTarget.value.toLowerCase();
    
    for (let i = 0; i < lesCategories.length; i++) {
        const laCategorie = lesCategories[i];
        const laCategorieText = laCategorie.textContent.toLowerCase();
        
        if (!laCategorieText.includes(maRecherche)) {
            laCategorie.classList.add("filtrerRechercheCategorie");
        } else {
            laCategorie.classList.remove("filtrerRechercheCategorie");
        }
    }
});