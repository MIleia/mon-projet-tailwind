// Scroll to top button
function scrollToTop(){
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
} const btn = document.getElementById('scrollToTopBtn');

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        btn.classList.remove('hidden');
        btn.classList.add('flex');
    } else {
        btn.classList.add('hidden');
        btn.classList.remove('flex');
    }
});
        
// --------------
const contents = {
    promotion: {
        title: "Promotion médicale",
        text: `
        <p class="text-gray-700 mb-4">
            Nos équipes interviennent directement auprès des professionnels de santé pour valoriser vos produits de manière scientifique, rigoureuse et respectueuse des pratiques éthiques.
        </p>
        <p class="text-gray-700 mb-4">
            Nous assurons une <strong>présence terrain régulière</strong>, avec des outils de communication adaptés, pour garantir une visibilité optimale de vos spécialités pharmaceutiques.
        </p>
        <ul class="list-disc pl-6 text-gray-700">
            <li>Visites médicales personnalisées</li>
            <li>Matériel promotionnel sur mesure</li>
            <li>Suivi des retours terrain et reporting précis</li>
        </ul>
        `
    },
    encadrement: {
        title: "Encadrement force de vente",
        text: `
        <p class="text-gray-700 mb-4">
            Une équipe commerciale performante repose sur un encadrement solide et structurant. Chez Pharmacol, nous mettons en place un management de proximité pour maximiser la motivation et l'efficacité des délégués médicaux.
        </p>
        <p class="text-gray-700 mb-4">
            Nous vous accompagnons dans :
        </p>
        <ul class="list-disc pl-6 text-gray-700">
            <li>Le recrutement, la formation et l'intégration de vos forces de vente</li>
            <li>Le pilotage des performances via des KPIs clairs</li>
            <li>La mise en œuvre de plans d’action commerciaux cohérents</li>
        </ul>
        `
    },
    representation: {
        title: "Représentation pharmaceutique",
        text: `
        <p class="text-gray-700 mb-4">
            Représenter un laboratoire pharmaceutique, c’est porter ses valeurs, défendre ses produits et établir un lien de confiance avec les parties prenantes locales.
        </p>
        <p class="text-gray-700 mb-4">
            Pharmacol agit en tant qu'interlocuteur privilégié auprès des autorités sanitaires, distributeurs, pharmacies et autres partenaires stratégiques.
        </p>
        <ul class="list-disc pl-6 text-gray-700">
            <li>Création et développement de filiales ou structures locales</li>
            <li>Interface réglementaire et administrative</li>
            <li>Promotion de l’image du laboratoire sur le territoire</li>
        </ul>
        `
    },
    autorisation: {
        title: "Autorisation sur le marché",
        text: `
        <p class="text-gray-700 mb-4">
            L'accès au marché d’un médicament ou dispositif médical exige une parfaite maîtrise du cadre réglementaire. Nous vous accompagnons à chaque étape de l’enregistrement et du maintien de vos AMM.
        </p>
        <ol class="list-decimal pl-6 text-gray-700 mb-4">
            <li>Préparation et dépôt des dossiers</li>
            <li>Interface avec les autorités locales (ANRP, OMS, etc.)</li>
            <li>Veille réglementaire continue et suivi des renouvellements</li>
        </ol>
        <p class="text-gray-700">
            Grâce à notre expérience du terrain et à notre réseau institutionnel, nous accélérons vos démarches et sécurisons vos mises sur le marché.
        </p>
        `
    },
    marketing: {
        title: "Marketing communication",
        text: `
        <p class="text-gray-700 mb-4">
            Une stratégie marketing bien pensée est indispensable pour assurer le bon positionnement de vos produits. Nous concevons des campagnes percutantes adaptées aux réalités locales.
        </p>
        <ul class="list-disc pl-6 text-gray-700 mb-4">
            <li>Études de marché et analyse concurrentielle</li>
            <li>Conception de plans de communication multicanal</li>
            <li>Élaboration de supports marketing (brochures, affiches, contenu digital)</li>
        </ul>
        <p class="text-gray-700">
            Notre objectif : transformer l’intérêt en engagement, et l’engagement en prescriptions durables.
        </p>
        `
    },
    consulting: {
        title: "Consulting",
        text: `
        <p class="text-gray-700 mb-4">
            Vous souhaitez pénétrer un nouveau marché ? Optimiser votre stratégie locale ? Restructurer votre force de vente ?
        </p>
        <p class="text-gray-700 mb-4">
            Pharmacol vous propose un accompagnement sur mesure fondé sur une expertise terrain, des données fiables et une vision stratégique du secteur pharmaceutique africain.
        </p>
        <ul class="list-disc pl-6 text-gray-700">
            <li>Audits de performance et recommandations opérationnelles</li>
            <li>Stratégies d’implantation locale</li>
            <li>Conseil en conformité réglementaire et éthique</li>
        </ul>
        `
    }
};

function showContent(key) {
    const content = contents[key];
    const area = document.getElementById('content-area');
    area.innerHTML = `
        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4">${content.title}</h2>
        <p class="text-gray-700">${content.text}</p>
    `;
    document.querySelectorAll('.service-btn').forEach(btn => {
        btn.classList.remove('bg-[#3f73a3]', 'text-white');
        btn.classList.add('bg-white', 'text-[#3f73a3]');
    });
    const activeBtn = document.querySelector(`.service-btn[data-key="${key}"]`);
    activeBtn.classList.add('bg-[#3f73a3]', 'text-white');
    activeBtn.classList.remove('bg-white', 'text-[#3f73a3]');
}

//----------------------

function toggleAccordion(button) {
    const content = button.nextElementSibling;
    const plus = button.querySelector('.plus');
    const minus = button.querySelector('.minus');
    content.classList.toggle('open');
    if (content.classList.contains('open')){
        content.style.maxHeight = content.scrollHeight + "px";
        plus.classList.add('hidden');
        minus.classList.remove('hidden');
    } else{
        content.style.maxHeight = null;
        plus.classList.remove('hidden');
        minus.classList.add('hidden');
    }
}

window.addEventListener("load", () => {
    document.querySelectorAll('.accordion-content').forEach(c => {
        c.style.maxHeight = null;
    });
});



//----------------------
function searchCards(){
    const input = document.getElementById("searchInput").value.toLowerCase();
    const cards = document.getElementsByClassName("prestation");
    for (let card of cards){
        const title = card.getElementsByTagName("h3")[0].innerText.toLowerCase();
        const description = card.getElementsByTagName("p")[0].innerText.toLowerCase();

        if (title.includes(input) || description.includes(input)){
            card.style.display = "block";
        } else{
            card.style.display = "none";
        }
    }
}


