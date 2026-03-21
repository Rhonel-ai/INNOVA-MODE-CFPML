// =================================================================
// MAIN.JS - Logique principale de l'application
// =================================================================

// Configuration globale - sera remplie par le Blade
window.APP_CONFIG = window.APP_CONFIG || {
    candidatesData: [],
    currentPrime: null,
    isReady: false,
};

// =================================================================
// 1. INITIALISATION
// =================================================================
document.addEventListener("DOMContentLoaded", function () {
    console.log("🚀 Initialisation de l'application...");

    initMobileMenu();
    updateStatistics();
    initSearch();
    attachButtonEvents();

    window.APP_CONFIG.isReady = true;
    console.log("✅ Application prête");
});

// =================================================================
// 2. MENU MOBILE
// =================================================================
function initMobileMenu() {
    const mobileMenuBtn = document.querySelector(".mobile-menu");
    const nav = document.querySelector(".nav");

    if (mobileMenuBtn && nav) {
        mobileMenuBtn.addEventListener("click", function () {
            nav.classList.toggle("active");
            const icon = this.querySelector("i");
            if (icon) {
                icon.classList.toggle("fa-bars");
                icon.classList.toggle("fa-times");
            }
        });
    }
}

// =================================================================
// 3. MISE À JOUR DES STATISTIQUES
// =================================================================
function updateStatistics() {
    const candidatesData = window.APP_CONFIG.candidatesData || [];
    const totalVotes = candidatesData.reduce(
        (sum, c) => sum + (c.votes || 0),
        0
    );
    const totalCandidates = candidatesData.length;

    // Mettre à jour tous les éléments de statistiques
    const statsElements = {
        totalVotes: totalVotes,
        currentTotalVotes: `${totalVotes} votes totaux`,
        totalCandidates: totalCandidates,
        currentTotalCandidates: `${totalCandidates} candidats`,
    };

    Object.keys(statsElements).forEach((id) => {
        const element = document.getElementById(id);
        if (element) {
            element.textContent = statsElements[id];
        }
    });

    console.log("📊 Stats:", { totalVotes, totalCandidates });
}

// =================================================================
// 4. RECHERCHE DE CANDIDATS
// =================================================================
function initSearch() {
    const searchInput = document.getElementById("searchCandidate");
    const candidatesContainer = document.getElementById("candidatesContainer");

    if (!searchInput || !candidatesContainer) {
        console.warn("⚠️ Éléments de recherche non trouvés");
        return;
    }

    const allCards = Array.from(
        candidatesContainer.querySelectorAll(".candidate-card")
    );

    searchInput.addEventListener("input", function () {
        const searchTerm = this.value.toLowerCase().trim();

        allCards.forEach((card) => {
            const name = (card.dataset.searchName || "").toLowerCase();
            const school = (card.dataset.searchSchool || "").toLowerCase();
            const code = (card.dataset.searchCode || "").toLowerCase();

            const isMatch =
                name.includes(searchTerm) ||
                school.includes(searchTerm) ||
                code.includes(searchTerm);

            card.style.display = isMatch ? "" : "none";
        });
    });

    console.log("🔍 Recherche initialisée pour", allCards.length, "candidats");
}

// =================================================================
// 5. ATTACHER LES ÉVÉNEMENTS AUX BOUTONS (ESSENTIEL)
// =================================================================
function attachButtonEvents() {
    console.log("🔗 Attachement des événements aux boutons...");

    let voteCount = 0;
    let shareCount = 0;

    // Boutons VOTER
    document.querySelectorAll(".vote-btn").forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const candidateId = this.dataset.candidateId;

            console.log("🗳️ Clic vote - ID:", candidateId);

            if (!candidateId) {
                console.error("❌ ID candidat manquant sur le bouton vote");
                return;
            }

            // Appeler la fonction du modal.js
            if (typeof window.openVoteModal === "function") {
                window.openVoteModal(candidateId);
            } else {
                console.error("❌ openVoteModal non disponible");
                alert("Le système de vote se charge...");
            }
        });
        voteCount++;
    });

    // Boutons PARTAGER
    document.querySelectorAll(".share-btn").forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const candidateId = this.dataset.candidateId;

            console.log("📤 Clic partage - ID:", candidateId);

            if (!candidateId) {
                console.error("❌ ID candidat manquant sur le bouton partage");
                return;
            }

            // Appeler la fonction du share.js
            if (typeof window.openShareModal === "function") {
                window.openShareModal(candidateId);
            } else {
                console.error("❌ openShareModal non disponible");
                alert("Le système de partage se charge...");
            }
        });
        shareCount++;
    });

    console.log(
        `✅ Événements attachés: ${voteCount} votes, ${shareCount} partages`
    );
}

// =================================================================
// 6. FONCTIONS UTILITAIRES
// =================================================================

// Récupérer un candidat par ID
window.getCandidateById = function (candidateId) {
    const candidates = window.APP_CONFIG.candidatesData || [];
    return candidates.find((c) => c.id == candidateId);
};

// Recharger les événements (si besoin après un update dynamique)
window.refreshButtonEvents = function () {
    console.log("🔄 Rechargement des événements...");
    attachButtonEvents();
};
