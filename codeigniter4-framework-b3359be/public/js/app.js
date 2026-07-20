// ══════════════════════════════════
//  FORMULAIRE LOGIN
// ══════════════════════════════════
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', async function(event) {
        event.preventDefault();

        const useremail = this.querySelector('input[name="email"]');
        const userpwd   = this.querySelector('input[name="mdp"]');
        const generalErrorDiv  = document.getElementById('js-error-message');
        const generalErrorSpan = generalErrorDiv.querySelector('.msg-content');

        let isValid = true;
        generalErrorDiv.style.display = 'none';
        [useremail, userpwd].forEach(i => i.classList.remove('input-error'));

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(useremail.value)) {
            useremail.classList.add('input-error');
            isValid = false;
        }
        if (userpwd.value.length < 6) {
            userpwd.classList.add('input-error');
            isValid = false;
        }
        if (!isValid) {
            generalErrorSpan.innerText = "Veuillez corriger les erreurs.";
            generalErrorDiv.style.display = 'block';
            return;
        }

        try {
            const response = await fetch(this.getAttribute('data-url'), {
                method: 'POST',
                body: new FormData(this),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const result = await response.json();

            if (response.ok && result.success) {
                window.location.href = result.redirect;
            } else {
                generalErrorSpan.innerText = result.message || 'Identifiants incorrects.';
                generalErrorDiv.style.display = 'block';
                userpwd.classList.add('input-error');
            }
        } catch (err) {
            generalErrorSpan.innerText = "Serveur injoignable.";
            generalErrorDiv.style.display = 'block';
        }
    });
}

// ══════════════════════════════════
//  FORMULAIRE INSCRIPTION
// ══════════════════════════════════
const inscriptionForm = document.getElementById('inscriptionForm');
if (inscriptionForm) {
    inscriptionForm.addEventListener('submit', async function(event) {
        event.preventDefault();

        // Reset erreurs
        ['nomError', 'emailError', 'mdpError'].forEach(id => {
            document.getElementById(id).innerText = '';
        });

        const nom   = document.getElementById('nom').value.trim();
        const email = document.getElementById('email').value.trim();
        const mdp   = document.getElementById('mdp').value;

        let isValid = true;

        if (!nom) {
            document.getElementById('nomError').innerText = 'Le nom est requis.';
            isValid = false;
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            document.getElementById('emailError').innerText = 'Email invalide.';
            isValid = false;
        }
        if (mdp.length < 6) {
            document.getElementById('mdpError').innerText = '6 caractères minimum.';
            isValid = false;
        }
        if (!isValid) return;

        try {
            const response = await fetch(this.getAttribute('data-url'), {
                method: 'POST',
                body: new FormData(this),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const result = await response.json();

            if (response.ok && result.success) {
                window.location.href = result.redirect;
            } else {
                document.getElementById('mdpError').innerText = result.message || 'Erreur inscription.';
            }
        } catch (err) {
            document.getElementById('mdpError').innerText = 'Serveur injoignable.';
        }
    });
}