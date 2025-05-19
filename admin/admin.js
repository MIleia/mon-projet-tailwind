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
