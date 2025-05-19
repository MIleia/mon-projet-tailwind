/*
document.addEventListener('DOMContentLoaded', () => {
    const path = window.location.pathname.split('/').pop();

    if (path === 'connexion.html') {
        // Logique pour page connexion
        const loginForm = document.getElementById('loginForm');
        const errorElem = document.getElementById('error');

        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const res = await fetch('admin.php?action=login', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({email, password})
                });
                const data = await res.json();

                if (data.success) {
                    window.location.href = 'admin.html';
                } else {
                    errorElem.textContent = data.message || 'Erreur de connexion';
                }
            } catch (err) {
                errorElem.textContent = 'Erreur serveur';
            }
        });
    }

    else if (path === 'admin.html') {
        // Logique pour page admin
        const welcome = document.getElementById('welcome');
        const logoutBtn = document.getElementById('logoutBtn');

        async function checkSession() {
            try {
                const res = await fetch('admin.php?action=check_session');
                const data = await res.json();

                if (!data.authenticated) {
                    window.location.href = 'connexion.html';
                } else {
                    welcome.textContent = `Bienvenue ${data.mail}`;
                }
            } catch {
                window.location.href = 'connexion.html';
            }
        }

        checkSession();

        logoutBtn.addEventListener('click', async () => {
            await fetch('admin.php?action=logout');
            window.location.href = 'connexion.html';
        });
    }
});
*/

// ------------------------------------------------------

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#blog form');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const title = form.title.value.trim();
        const content = form.content.value.trim();
        const imageInput = form.image;
        const destination = form.destination.value;

        if (!title || !content) {
        alert('Merci de remplir le titre et le contenu de l\'article.');
        return;
        }

        // Lecture du fichier image si sélectionné
        let imageData = null;
        if (imageInput.files.length > 0) {
        const file = imageInput.files[0];
        // Vérification basique du type image
        if (!file.type.startsWith('image/')) {
            alert('Le fichier sélectionné n\'est pas une image.');
            return;
        }
        // Lecture du fichier en base64 (pour exemple, ici on le stocke en base64)
        imageData = await new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = (e) => resolve(e.target.result);
            reader.readAsDataURL(file);
        });
        }

        // Exemple : on crée un objet article avec toutes les infos
        const article = {
        title,
        content,
        image: imageData,  // base64 string ou null
        destination,
        date: new Date().toISOString(),
        };

        // Pour l'instant on le sauvegarde dans localStorage (simule la sauvegarde)
        let savedArticles = JSON.parse(localStorage.getItem('blogArticles') || '[]');
        savedArticles.push(article);
        localStorage.setItem('blogArticles', JSON.stringify(savedArticles));

        alert('Article enregistré avec succès !');

        // Reset formulaire
        form.reset();
    });
    });



    function showSection(sectionId) {
    // 1. Cacher toutes les sections principales
    const sections = document.querySelectorAll('section');
    sections.forEach(sec => {
        sec.classList.add('hidden');
    });

    // 2. Afficher la section demandée
    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
        activeSection.classList.remove('hidden');
    }

    // 3. Gérer le style des boutons dans la sidebar
    const buttons = document.querySelectorAll('aside nav button');
    buttons.forEach(btn => {
        // Retirer style "sélectionné"
        btn.classList.remove('selected-section');
    });

    // 4. Trouver le bouton qui correspond à la section active
    const activeBtn = Array.from(buttons).find(btn => {
        const onclickAttr = btn.getAttribute('onclick');
        return onclickAttr && onclickAttr.includes(`'${sectionId}'`);
    });

    if (activeBtn) {
        activeBtn.classList.add('selected-section');
    }
}

