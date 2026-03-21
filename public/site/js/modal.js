// =================================================================
// MODAL.JS - Gestion du modal de vote AVEC KKIAPAY
// =================================================================

console.log('📦 modal.js avec KKiaPay chargé');

// État du modal
let voteModalState = {
    currentCandidate: null,
    voteCount: 1,
    isAnonymous: false,
    kkiapayConfig: null,
    currentVoteData: null,
    isProcessing: false // Pour éviter les doubles clics
};

// =================================================================
// INITIALISER KKIAPAY AU CHARGEMENT
// =================================================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Initialisation KKiaPay...');
    
    // Charger la configuration KKiaPay depuis le backend
    fetch('/api/votes/config')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                voteModalState.kkiapayConfig = data.config;
                console.log('✅ Config KKiaPay chargée:', voteModalState.kkiapayConfig);
                
                // Charger le widget KKiaPay
                loadKKiaPayWidget();
            }
        })
        .catch(err => {
            console.error('❌ Erreur chargement config KKiaPay:', err);
        });
});

// =================================================================
// CHARGER LE WIDGET KKIAPAY
// =================================================================
function loadKKiaPayWidget() {
    if (document.getElementById('kkiapay-sdk')) {
        console.log('✅ KKiaPay SDK déjà chargé');
        return;
    }

    const script = document.createElement('script');
    script.id = 'kkiapay-sdk';
    script.src = 'https://cdn.kkiapay.me/k.js';
    script.onload = () => {
        console.log('✅ KKiaPay SDK chargé avec succès');
    };
    script.onerror = () => {
        console.error('❌ Erreur chargement KKiaPay SDK');
    };
    document.head.appendChild(script);
}

// =================================================================
// FONCTION POUR GÉNÉRER UN TRANSACTION ID UNIQUE
// =================================================================
function generateUniqueTransactionId() {
    const timestamp = Date.now();
    const random = Math.random().toString(36).substring(2, 11);
    const uniqueId = `VOTE_${timestamp}_${random}`;
    console.log('🔑 Transaction ID généré:', uniqueId);
    return uniqueId;
}

// =================================================================
// FONCTION PRINCIPALE - Ouvrir le modal de vote
// =================================================================
window.openVoteModal = function(candidateId) {
    console.log('🗳️ Ouverture modal vote - ID:', candidateId, 'Type:', typeof candidateId);
    
    const numericId = parseInt(candidateId);
    const candidates = window.APP_CONFIG?.candidatesData || [];
    
    const candidate = candidates.find(c => c.id === numericId);
    
    if (!candidate) {
        console.error('❌ Candidat introuvable:', candidateId);
        alert('Erreur: Candidat non trouvé');
        return;
    }

    console.log('✅ Candidat:', candidate.name);

    voteModalState = {
        currentCandidate: candidate,
        voteCount: 1,
        isAnonymous: false,
        kkiapayConfig: voteModalState.kkiapayConfig,
        currentVoteData: null,
        isProcessing: false
    };

    const modalOverlay = document.getElementById('modalOverlay');
    const modalContent = document.getElementById('modalContent');

    if (!modalOverlay || !modalContent) {
        console.error('❌ Éléments modal introuvables');
        alert('Erreur: Le modal n\'est pas disponible');
        return;
    }

    modalContent.innerHTML = generateModalHTML(candidate);
    modalOverlay.style.display = 'flex';
    document.body.style.overflow = 'hidden';

    setTimeout(() => initModalControls(candidate), 50);
};

// =================================================================
// GÉNÉRER LE HTML DU MODAL
// =================================================================
function generateModalHTML(candidate) {
    const primeConfig = window.APP_CONFIG.currentPrime;
    const pricePerVote = primeConfig.pricePerVote;
    const totalPrice = pricePerVote;
    
    const imageUrl = candidate.image 
        ? `/uploads/candidates/${candidate.image}`
        : '/assets/images/test.jpeg';
    
    return `
        <div class="candidate-info-modal">
            <div class="candidate-image-wrapper">
                <img src="${imageUrl}" 
                     alt="${candidate.name}" 
                     class="candidate-image"
                     onerror="this.onerror=null; this.src='/assets/images/test.jpeg';">
            </div>
            <h4>${candidate.name}</h4>
            <p><strong>Code:</strong> ${candidate.code}</p>
            <p><strong>École:</strong> ${candidate.school}</p>
            <p>${candidate.votes} votes (${candidate.percentage}%)</p>
        </div>
        
        <div class="prime-info-modal">
            <h4><i class="fas fa-trophy"></i> ${primeConfig.title}</h4>
            <p>${primeConfig.description}</p>
        </div>
        
        <div class="vote-selector">
            <label class="form-label">Nombre de votes</label>
            <div class="vote-controls">
                <button class="vote-btn-modal" id="decreaseVotes" type="button">-</button>
                <input type="number" id="voteCount" class="vote-input" value="1" min="1">
                <button class="vote-btn-modal" id="increaseVotes" type="button">+</button>
            </div>
            <p class="vote-total">
                ${pricePerVote} FCFA × <span id="selectedVotes">1</span> = 
                <span id="totalPrice">${pricePerVote}</span> FCFA
            </p>
        </div>
        
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-user"></i> Votre nom (optionnel)
            </label>
            <input type="text" id="voterName" class="form-input" 
                   placeholder="Ex: Jean Kouassi">
        </div>
        
        <div class="form-group">
            <label class="form-label required">
                <i class="fas fa-phone"></i> Numéro de téléphone
            </label>
            <input type="tel" id="phoneNumber" class="form-input" 
                   placeholder="Ex: 01 97 00 00 00" required>
            <div class="error-message" id="phoneError" style="display: none;">
                Format invalide. Utilisez 01 6x xx xx xx ou 01 9x xx xx xx
            </div>
            <p class="help-text">Format: 01 6x xx xx xx ou 01 9x xx xx xx (10 chiffres)</p>
        </div>
        
        <div class="checkbox-group">
            <input type="checkbox" id="anonymousVote" class="checkbox-input">
            <label for="anonymousVote" class="checkbox-label">
                <i class="fas fa-lock"></i> Voter en anonyme
            </label>
        </div>
        
        <div class="vote-summary">
            <h4 class="summary-title"><i class="fas fa-clipboard-list"></i> Résumé</h4>
            <div class="summary-item">
                <span class="summary-label">Candidat:</span>
                <span class="summary-value">${candidate.name}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">École:</span>
                <span class="summary-value">${candidate.school}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Votant:</span>
                <span class="summary-value" id="summaryVoter">Non spécifié</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Téléphone:</span>
                <span class="summary-value" id="summaryPhone">Non spécifié</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Votes:</span>
                <span class="summary-value" id="summaryVotes">1</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Total:</span>
                <span class="summary-value" id="summaryTotal">${pricePerVote} FCFA</span>
            </div>
        </div>
        
        <button class="pay-button" id="payButton" type="button" disabled>
            <i class="fas fa-credit-card"></i>
            Payer avec KKiaPay
            <span id="payAmount">${pricePerVote}</span> FCFA
        </button>
        
        <div class="security-info">
            <i class="fas fa-shield-alt"></i>
            <p>Paiement sécurisé via KKiaPay. Supports: MTN Mobile Money, Moov Money, Wave, etc.</p>
        </div>
    `;
}

// =================================================================
// INITIALISER LES CONTRÔLES DU MODAL
// =================================================================
function initModalControls(candidate) {
    console.log('Initialisation des contrôles du modal');
    
    const voteCountInput = document.getElementById('voteCount');
    const decreaseBtn = document.getElementById('decreaseVotes');
    const increaseBtn = document.getElementById('increaseVotes');
    const voterNameInput = document.getElementById('voterName');
    const phoneInput = document.getElementById('phoneNumber');
    const phoneError = document.getElementById('phoneError');
    const anonymousCheckbox = document.getElementById('anonymousVote');
    const payButton = document.getElementById('payButton');

    if (!voteCountInput || !payButton) {
        console.error('❌ Éléments de contrôle manquants');
        return;
    }

    function updateTotal() {
        const votes = parseInt(voteCountInput.value) || 1;
        voteModalState.voteCount = votes;
        const pricePerVote = window.APP_CONFIG?.currentPrime?.pricePerVote || 100;
        const total = votes * pricePerVote;

        document.getElementById('selectedVotes').textContent = votes;
        document.getElementById('totalPrice').textContent = total;
        document.getElementById('payAmount').textContent = total;
        document.getElementById('summaryVotes').textContent = votes;
        document.getElementById('summaryTotal').textContent = `${total} FCFA`;

        updateSummary();
    }

    function updateSummary() {
        voteModalState.isAnonymous = anonymousCheckbox.checked;
        
        const summaryVoter = document.getElementById('summaryVoter');
        const summaryPhone = document.getElementById('summaryPhone');

        if (voteModalState.isAnonymous) {
            summaryVoter.textContent = 'Anonyme';
            summaryPhone.textContent = 'Masqué';
        } else {
            summaryVoter.textContent = voterNameInput.value || 'Non spécifié';
            summaryPhone.textContent = phoneInput.value || 'Non spécifié';
        }
    }

    function validatePhone(phone) {
        if (!phone) return false;
        const cleaned = phone.replace(/[\s\-\(\)\.]/g, '');
        const regex = /^01[69][0-9]{7}$/;
        return regex.test(cleaned);
    }

    function updatePayButton() {
        const isAnonymous = anonymousCheckbox.checked;
        const phoneValid = validatePhone(phoneInput.value);

        if (isAnonymous) {
            payButton.disabled = false;
            phoneError.style.display = 'none';
        } else {
            payButton.disabled = !phoneValid;
            phoneError.style.display = phoneValid ? 'none' : 'block';
        }
    }

    decreaseBtn.addEventListener('click', () => {
        let value = parseInt(voteCountInput.value) || 1;
        if (value > 1) {
            voteCountInput.value = value - 1;
            updateTotal();
        }
    });

    increaseBtn.addEventListener('click', () => {
        let value = parseInt(voteCountInput.value) || 1;
        voteCountInput.value = value + 1;
        updateTotal();
    });

    voteCountInput.addEventListener('input', function() {
        let value = parseInt(this.value) || 1;
        if (value < 1) value = 1;
        this.value = value;
        updateTotal();
    });

    voterNameInput.addEventListener('input', () => {
        if (!anonymousCheckbox.checked) updateSummary();
    });

    phoneInput.addEventListener('input', () => {
        updatePayButton();
        if (!anonymousCheckbox.checked) updateSummary();
    });

    anonymousCheckbox.addEventListener('change', function() {
        voteModalState.isAnonymous = this.checked;
        updateSummary();
        updatePayButton();
        
        voterNameInput.disabled = this.checked;
        phoneInput.disabled = this.checked;
        voterNameInput.style.opacity = this.checked ? '0.5' : '1';
        phoneInput.style.opacity = this.checked ? '0.5' : '1';
        
        if (this.checked) {
            voterNameInput.value = '';
            phoneInput.value = '';
        }
    });

    // ⭐ ÉVÉNEMENT PAIEMENT KKIAPAY
    payButton.addEventListener('click', function() {
        if (this.disabled || voteModalState.isProcessing) return;
        
        // Empêcher les doubles clics
        voteModalState.isProcessing = true;
        this.disabled = true;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement...';
        
        const votes = voteModalState.voteCount;
        const pricePerVote = window.APP_CONFIG?.currentPrime?.pricePerVote || 100;
        const total = votes * pricePerVote;
        const voterName = voteModalState.isAnonymous ? '' : (voterNameInput?.value || '');
        const phone = voteModalState.isAnonymous ? '0197000000' : (phoneInput?.value.replace(/[\s\-]/g, '') || '');

        console.log('💳 Déclenchement paiement KKiaPay:', { candidate: candidate.name, votes, total, phone });
        
        initiateKKiaPayPayment(candidate, votes, total, voterName, phone);
    });

    updateTotal();
    updatePayButton();
    
    console.log('✅ Contrôles initialisés avec succès');
}

// =================================================================
// INITIER LE PAIEMENT KKIAPAY
// =================================================================
function initiateKKiaPayPayment(candidate, voteCount, totalAmount, voterName, voterPhone) {
    if (!voteModalState.kkiapayConfig) {
        alert('Erreur: Configuration KKiaPay non disponible');
        resetPayButton();
        return;
    }

    // ⭐ GÉNÉRER UN NOUVEAU transaction_id À CHAQUE TENTATIVE
    const transactionId = generateUniqueTransactionId();
    
    // Préparer les données du vote
    const voteData = {
        candidate_id: candidate.id,
        vote_count: voteCount,
        voter_name: voterName,
        voter_phone: voterPhone,
        is_anonymous: voteModalState.isAnonymous,
        amount_paid: totalAmount,
        prime_id: window.APP_CONFIG?.currentPrime?.id || 2,
        transaction_id: transactionId
    };

    console.log('📝 Données du vote:', voteData);

    // Enregistrer le vote en status pending
    fetch('/api/votes/create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(voteData)
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            console.log('✅ Vote créé:', data);
            voteModalState.currentVoteData = data.data;
            
            // Ouvrir KKiaPay
            openKKiaPayWidget(totalAmount, transactionId, voterPhone, voterName, voteData);
        } else {
            console.error('❌ Erreur création vote:', data);
            
            // Vérifier si c'est une erreur de duplication
            if (data.errors && data.errors.transaction_id) {
                alert('Erreur: Transaction déjà en cours. Veuillez réessayer.');
            } else {
                alert('Erreur: ' + (data.message || 'Impossible de créer le vote'));
            }
            
            resetPayButton();
        }
    })
    .catch(err => {
        console.error('❌ Erreur réseau:', err);
        alert('Erreur de connexion. Veuillez réessayer.');
        resetPayButton();
    });
}

// =================================================================
// RÉINITIALISER LE BOUTON DE PAIEMENT
// =================================================================
function resetPayButton() {
    voteModalState.isProcessing = false;
    const payButton = document.getElementById('payButton');
    if (payButton) {
        payButton.disabled = false;
        const amount = voteModalState.voteCount * (window.APP_CONFIG?.currentPrime?.pricePerVote || 100);
        payButton.innerHTML = `
            <i class="fas fa-credit-card"></i>
            Payer avec KKiaPay
            <span id="payAmount">${amount}</span> FCFA
        `;
    }
}

// =================================================================
// OUVRIR LE WIDGET KKIAPAY
// =================================================================
function openKKiaPayWidget(amount, transactionId, phone, voterName, voteData) {
    if (typeof openKkiapayWidget === 'undefined') {
        console.error('❌ KKiaPay SDK non chargé');
        alert('Erreur: Le système de paiement n\'est pas disponible');
        resetPayButton();
        return;
    }

    const kkiapayPhone = phone.startsWith('01') ? phone.substring(2) : phone;
    
    const widgetConfig = {
        amount: amount,
        api_key: voteModalState.kkiapayConfig.public_key,
        sandbox: voteModalState.kkiapayConfig.sandbox,
        phone: kkiapayPhone,
        name: voterName || 'Votant',
        // callback: voteModalState.kkiapayConfig.callback_url, // ⚠️ DÉSACTIVÉ pour éviter la redirection
        theme: '#00ff88',
        key: transactionId,
        payment_methods: ['momo', 'card', 'direct_debit'],
    };

    console.log('🚀 Ouverture KKiaPay Widget:', widgetConfig);
    
    openKkiapayWidget(widgetConfig);

    // Écouter les événements KKiaPay
    addKkiapayListener('success', function(response) {
        console.log('✅ Paiement KKiaPay réussi:', response);
        handlePaymentSuccess(transactionId, response);
    });

    addKkiapayListener('failed', function(response) {
        console.error('❌ Paiement échoué:', response);
        handlePaymentFailure(transactionId, response);
        resetPayButton();
    });
}

// =================================================================
// GÉRER LE SUCCÈS DU PAIEMENT
// =================================================================
function handlePaymentSuccess(transactionId, kkiapayResponse) {
    console.log('🎉 Traitement du succès du paiement...');
    console.log('📋 Notre Transaction ID:', transactionId);
    console.log('📋 KKiaPay Response:', kkiapayResponse);

    showPaymentLoader('Enregistrement du vote...');

    fetch('/api/votes/complete-payment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            transaction_id: transactionId,
            kkiapay_transaction_id: kkiapayResponse.transactionId,
            kkiapay_response: kkiapayResponse
        })
    })
    .then(res => {
        console.log('📡 Réponse serveur:', res.status);
        return res.json();
    })
    .then(data => {
        hidePaymentLoader();
        
        console.log('📦 Données retournées:', data);
        
        if (data.success) {
            console.log('✅ Vote enregistré avec succès!');
            showPaymentConfirmation(voteModalState.currentVoteData, transactionId);
        } else {
            console.error('❌ Erreur serveur:', data);
            alert('Erreur: ' + (data.message || 'Impossible d\'enregistrer le vote'));
            resetPayButton();
        }
    })
    .catch(err => {
        hidePaymentLoader();
        console.error('💥 Erreur fatale:', err);
        alert('Votre paiement est enregistré. Rechargez la page pour voir les résultats.');
    });
}

// =================================================================
// GÉRER L'ÉCHEC DU PAIEMENT
// =================================================================
function handlePaymentFailure(transactionId, kkiapayResponse) {
    console.log('❌ Traitement de l\'échec du paiement...');
    
    const errorMessage = kkiapayResponse.reason?.message || 'Erreur inconnue';
    
    let userMessage = 'Le paiement a échoué ou a été annulé.';
    
    switch(errorMessage) {
        case 'processing_error':
            userMessage = 'Erreur de traitement du paiement. Vérifiez votre numéro ou réessayez.';
            break;
        case 'insufficient_balance':
            userMessage = 'Solde insuffisant. Rechargez votre compte et réessayez.';
            break;
        case 'invalid_phone':
            userMessage = 'Numéro de téléphone invalide.';
            break;
        case 'transaction_cancelled':
            userMessage = 'Transaction annulée.';
            break;
        case 'timeout':
            userMessage = 'Délai expiré. Veuillez réessayer.';
            break;
    }
    
    alert(userMessage + '\n\nCode erreur: ' + errorMessage);
}

// =================================================================
// AFFICHER LA CONFIRMATION
// =================================================================
function showPaymentConfirmation(voteData, transactionId) {
    const modalContent = document.getElementById('modalContent');
    if (!modalContent) return;

    const candidate = voteModalState.currentCandidate;

    modalContent.innerHTML = `
        <div class="confirmation-modal">
            <div class="confirmation-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3>Vote enregistré !</h3>
            <p class="confirmation-text">
                Merci pour votre participation à SCHOOL'S VOICE 2025.
            </p>
            
            <div class="confirmation-details">
                <div class="detail-row">
                    <span>Transaction:</span>
                    <strong>${transactionId}</strong>
                </div>
                <div class="detail-row">
                    <span>Candidat:</span>
                    <strong>${candidate.name}</strong>
                </div>
                <div class="detail-row">
                    <span>Votes:</span>
                    <strong>${voteData.vote_count || voteModalState.voteCount}</strong>
                </div>
                <div class="detail-row">
                    <span>Montant:</span>
                    <strong>${voteData.amount || (voteData.amount_paid || 0)} FCFA</strong>
                </div>
            </div>
            
            <div class="confirmation-actions">
                <button class="btn-secondary" id="closeConfirmation" type="button">
                    Fermer
                </button>
                <button class="btn-primary" id="shareConfirmation" type="button">
                    <i class="fas fa-share-alt"></i> Partager
                </button>
            </div>
            
            <div class="security-notice">
                <i class="fas fa-shield-alt"></i>
                <p>Votre vote a été sécurisé et enregistré avec succès.</p>
            </div>
        </div>
    `;

    document.getElementById('closeConfirmation').addEventListener('click', () => {
        closeVoteModal();
        window.location.href = '/'; // Redirection vers l'accueil
    });
    
    document.getElementById('shareConfirmation').addEventListener('click', () => {
        closeVoteModal();
        if (typeof window.openShareModal === 'function') {
            window.openShareModal(candidate.id);
        }
    });
}

// =================================================================
// UTILITAIRES LOADER
// =================================================================
function showPaymentLoader(message = 'Traitement...') {
    const loader = document.createElement('div');
    loader.id = 'paymentLoader';
    loader.className = 'payment-loader-overlay';
    loader.innerHTML = `
        <div class="payment-loader-content">
            <div class="spinner"></div>
            <p>${message}</p>
        </div>
    `;
    document.body.appendChild(loader);
}

function hidePaymentLoader() {
    const loader = document.getElementById('paymentLoader');
    if (loader) loader.remove();
}

// =================================================================
// FERMER LE MODAL
// =================================================================
function closeVoteModal() {
    const modalOverlay = document.getElementById('modalOverlay');
    if (modalOverlay) {
        modalOverlay.style.display = 'none';
        document.body.style.overflow = 'auto';
        voteModalState.currentCandidate = null;
        voteModalState.currentVoteData = null;
        voteModalState.isProcessing = false;
    }
}

// =================================================================
// ÉVÉNEMENTS GLOBAUX
// =================================================================
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        const modalOverlay = document.getElementById('modalOverlay');
        if (modalOverlay && e.target === modalOverlay) {
            closeVoteModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeVoteModal();
    });

    const closeBtn = document.getElementById('closeModal');
    if (closeBtn) {
        closeBtn.addEventListener('click', closeVoteModal);
    }

    console.log('✅ Modal avec KKiaPay initialisé');
});

// =================================================================
// STYLES POUR LE LOADER
// =================================================================
const loaderStyles = document.createElement('style');
loaderStyles.textContent = `
    .payment-loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 99999;
    }
    
    .payment-loader-content {
        text-align: center;
        color: white;
    }
    
    .spinner {
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid #00ff88;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        margin: 0 auto 1rem;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
`;
document.head.appendChild(loaderStyles);