// =================================================================
// SHARE.JS - Gestion du partage
// =================================================================

console.log("📦 share.js chargé");

// =================================================================
// FONCTION PRINCIPALE - Ouvrir le modal de partage
// =================================================================
window.openShareModal = function (candidateId) {
    console.log(
        "📤 Ouverture modal partage - ID:",
        candidateId,
        "Type:",
        typeof candidateId
    );

    const shareOverlay = document.getElementById("shareOverlay");

    // Si le modal existe
    if (shareOverlay) {
        shareOverlay.style.display = "flex";
        document.body.style.overflow = "hidden";
        shareOverlay.dataset.candidateId = candidateId;
        console.log("✅ Modal de partage affiché");
        return;
    }

    // Sinon, utiliser l'API native ou une solution simple
    console.log(
        "⚠️ Modal shareOverlay non trouvé, utilisation du partage natif"
    );
    shareWithNativeAPI(candidateId);
};

// =================================================================
// PARTAGE AVEC L'API NATIVE (FALLBACK)
// =================================================================
function shareWithNativeAPI(candidateId) {
    // Convertir en nombre
    const numericId = parseInt(candidateId);
    const candidates = window.APP_CONFIG?.candidatesData || [];

    const candidate = candidates.find((c) => c.id === numericId);

    if (!candidate) {
        console.error("❌ Candidat introuvable:", candidateId);
        console.log(
            "📋 IDs disponibles:",
            candidates.map((c) => c.id)
        );
        return;
    }

    const shareText = `🎤✨ Salut la famille !  

Je suis *${candidate.name}* et je participe à SCHOOL'S VOICE 2025 ! 🏆  

J’ai besoin de vous pour briller sur scène ! 🌟🙏  

💰 *1 vote = 100 FCFA*  
🔥 Vote autant de fois que tu veux !  

Chaque vote compte énormément pour moi 💪🎶  

🎯 *Code vote : ${candidate.code}*  

Merci infiniment pour votre soutien ❤️`;

    const shareUrl = window.location.href;

    // Utiliser l'API Web Share si disponible
    if (navigator.share) {
        navigator
            .share({
                title: "SCHOOL'S VOICE 2025",
                text: shareText,
                url: shareUrl,
            })
            .then(() => console.log("✅ Partage réussi"))
            .catch((err) => console.log("Partage annulé:", err.message));
    } else {
        // Fallback: copier dans le presse-papier
        copyToClipboard(`${shareText}\n${shareUrl}`);
    }
}

// =================================================================
// FERMER LE MODAL DE PARTAGE
// =================================================================
function closeShareModal() {
    const shareOverlay = document.getElementById("shareOverlay");
    if (shareOverlay) {
        shareOverlay.style.display = "none";
        document.body.style.overflow = "auto";
        delete shareOverlay.dataset.candidateId;
        console.log("✅ Modal de partage fermé");
    }
}

// =================================================================
// GÉRER LE PARTAGE SELON LA PLATEFORME
// =================================================================
function handleShare(platform, candidateId) {
    console.log("📤 Partage sur", platform, "- ID:", candidateId);

    const candidate = window.getCandidateById
        ? window.getCandidateById(candidateId)
        : (window.APP_CONFIG?.candidatesData || []).find(
              (c) => c.id == candidateId
          );

    if (!candidate) {
        console.error("❌ Candidat introuvable");
        return;
    }

    const shareUrl = `${window.location.origin}${window.location.pathname}?candidate=${candidateId}`;

    const shareText = `🎤✨ Salut la famille !  

Je suis *${candidate.name}* et je participe à SCHOOL'S VOICE 2025 ! 🏆  

J’ai besoin de vous pour briller sur scène ! 🌟🙏  

💰 *1 vote = 100 FCFA*  
🔥 Vote autant de fois que tu veux !  

Chaque vote compte énormément pour moi 💪🎶  

🎯 *Code vote : ${candidate.code}*  

Merci infiniment pour votre soutien ❤️`;

    switch (platform) {
        case "whatsapp":
            shareOnWhatsApp(shareText, shareUrl);
            break;
        case "facebook":
            shareOnFacebook(shareUrl, shareText);
            break;
        case "twitter":
            shareOnTwitter(shareText, shareUrl);
            break;
        case "copy":
            copyToClipboard(`${shareText}\n\n${shareUrl}`);
            break;
        default:
            console.warn("⚠️ Plateforme inconnue:", platform);
    }

    closeShareModal();
}

// =================================================================
// MÉTHODES DE PARTAGE PAR PLATEFORME
// =================================================================
function shareOnWhatsApp(text, url) {
    const whatsappUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(
        text + "\n\n" + url
    )}`;
    window.open(whatsappUrl, "_blank");
}

function shareOnFacebook(url, text) {
    const fbUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
        url
    )}&quote=${encodeURIComponent(text)}`;
    openPopup(fbUrl, 600, 400);
}

function shareOnTwitter(text, url) {
    const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(
        text
    )}&url=${encodeURIComponent(url)}`;
    openPopup(twitterUrl, 600, 400);
}

function openPopup(url, width, height) {
    const left = (window.screen.width - width) / 2;
    const top = (window.screen.height - height) / 2;
    const options =
        `width=${width},height=${height},top=${top},left=${left},` +
        `toolbar=0,location=0,menubar=0,scrollbars=1,resizable=1`;

    const popup = window.open(url, "share-popup", options);
    if (!popup) {
        window.open(url, "_blank");
    }
}

// =================================================================
// COPIER DANS LE PRESSE-PAPIER
// =================================================================
function copyToClipboard(text) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard
            .writeText(text)
            .then(() => {
                showNotification("✅ Lien copié dans le presse-papier!");
                console.log("✅ Copié:", text);
            })
            .catch((err) => {
                console.error("❌ Erreur clipboard:", err);
                fallbackCopy(text);
            });
    } else {
        fallbackCopy(text);
    }
}

function fallbackCopy(text) {
    const textarea = document.createElement("textarea");
    textarea.value = text;
    textarea.style.position = "fixed";
    textarea.style.left = "-9999px";
    document.body.appendChild(textarea);
    textarea.select();

    try {
        document.execCommand("copy");
        showNotification("✅ Lien copié!");
        console.log("✅ Copié (fallback)");
    } catch (err) {
        console.error("❌ Erreur copie:", err);
        showNotification("❌ Impossible de copier", true);
    }

    document.body.removeChild(textarea);
}

// =================================================================
// AFFICHER UNE NOTIFICATION
// =================================================================
function showNotification(message, isError = false) {
    const notification = document.createElement("div");
    notification.className = `share-notification ${
        isError ? "error" : "success"
    }`;

    notification.innerHTML = `
        <i class="fas ${isError ? "fa-times-circle" : "fa-check-circle"}"></i>
        <span>${message}</span>
    `;

    document.body.appendChild(notification);

    setTimeout(() => notification.classList.add("show"), 10);

    setTimeout(() => {
        notification.classList.remove("show");
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// =================================================================
// STYLES DES NOTIFICATIONS
// =================================================================
function addNotificationStyles() {
    if (document.getElementById("share-notification-styles")) return;

    const style = document.createElement("style");
    style.id = "share-notification-styles";

    style.textContent = `
        .share-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #1a1a2e;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            z-index: 10000;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            max-width: 350px;
        }

        .share-notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        .share-notification.success {
            border-left: 4px solid #00ff88;
        }

        .share-notification.error {
            border-left: 4px solid #ff3366;
        }

        .share-notification i {
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .share-notification.success i {
            color: #00ff88;
        }

        .share-notification.error i {
            color: #ff3366;
        }

        .share-notification span {
            color: #ffffff;
            font-weight: 600;
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            .share-notification {
                bottom: 10px;
                right: 10px;
                left: 10px;
                max-width: none;
            }
        }
    `;

    document.head.appendChild(style);
}

// =================================================================
// INITIALISATION
// =================================================================
document.addEventListener("DOMContentLoaded", function () {
    console.log("🎨 Initialisation share.js...");

    // Ajouter les styles
    addNotificationStyles();

    // Gérer les clics sur les options de partage
    document.addEventListener("click", function (e) {
        const shareOption = e.target.closest(".share-option");
        if (shareOption) {
            const platform = shareOption.dataset.platform;
            const shareOverlay = document.getElementById("shareOverlay");
            const candidateId = shareOverlay?.dataset.candidateId;

            if (candidateId) {
                handleShare(platform, candidateId);
            } else {
                console.error("❌ ID candidat manquant");
            }
        }

        const shareOverlay = document.getElementById("shareOverlay");
        if (shareOverlay && e.target === shareOverlay) {
            closeShareModal();
        }
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            const shareOverlay = document.getElementById("shareOverlay");
            if (shareOverlay && shareOverlay.style.display === "flex") {
                closeShareModal();
            }
        }
    });

    const closeBtn = document.getElementById("closeShare");
    if (closeBtn) {
        closeBtn.addEventListener("click", closeShareModal);
    }

    console.log("✅ Share initialisé");
});
