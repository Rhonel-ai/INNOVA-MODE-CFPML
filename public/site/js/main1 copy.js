// main.js - Logique principale de l'application

// Données des candidats - Déclaration globale
window.candidatesData = [
    {
        id: 1,
        name: "Stell ALLAGBE",
        parish: "Saint Albert le Grand Calavi",
        code: "0005",
        votes: 88,
        percentage: 22.39,
        isLeader: true,
        image: "assets/candidates/candidate1.jpg"
    },
    {
        id: 2,
        name: "Stévie AMALIN",
        parish: "Saint Antoine de Padoue Calavi",
        code: "0002",
        votes: 87,
        percentage: 22.14,
        isLeader: false,
        image: "assets/candidates/candidate2.jpg"
    },
    {
        id: 3,
        name: "Laroche KOUHODE",
        parish: "Saint Antoine de Padoue Calavi",
        code: "0004",
        votes: 81,
        percentage: 20.61,
        isLeader: false,
        image: "assets/candidates/candidate3.jpg"
    },
    {
        id: 4,
        name: "Juliana NONWANON",
        parish: "Saint Antoine de Padoue Calavi",
        code: "0001",
        votes: 79,
        percentage: 20.1,
        isLeader: false,
        image: "assets/candidates/candidate4.jpg"
    },
    {
        id: 5,
        name: "Maria YEBALA OGBONI",
        parish: "Saint Michel Archange de GBODJO",
        code: "0010",
        votes: 36,
        percentage: 9.16,
        isLeader: false,
        image: "assets/candidates/candidate5.jpg"
    },
    {
        id: 6,
        name: "Cathy SODJINOU",
        parish: "Saint Paul TANGBO",
        code: "0007",
        votes: 11,
        percentage: 2.8,
        isLeader: false,
        image: "assets/candidates/candidate6.jpg"
    },
    {
        id: 7,
        name: "Peace ASSOGBA",
        parish: "Saint Antoine de Padoue Calavi",
        code: "0006",
        votes: 5,
        percentage: 1.27,
        isLeader: false,
        image: "assets/candidates/candidate7.jpg"
    },
    {
        id: 8,
        name: "Jamnova Ryuna",
        parish: "Sainte Thérèse d'Ávila de Gankon",
        code: "0008",
        votes: 5,
        percentage: 1.27,
        isLeader: false,
        image: "assets/candidates/candidate8.jpg"
    },
    {
        id: 9,
        name: "Charlène CHODATON",
        parish: "Sainte Trinite Zopah",
        code: "0003",
        votes: 1,
        percentage: 0.25,
        isLeader: false,
        image: "assets/candidates/candidate9.jpg"
    },
    {
        id: 10,
        name: "Marvérique BOCO",
        parish: "Saint Paul d'adjarra Adovié",
        code: "0009",
        votes: 0,
        percentage: 0,
        isLeader: false,
        image: "assets/candidates/candidate10.jpg"
    }
];

// Données de la prime actuelle - Déclaration globale
window.currentPrime = {
    id: 2,
    title: "Phase 2",
    description: "seconde phase prestation publique",
    startDate: "29/11/2025",
    endDate: "06/12/2025",
    pricePerVote: 100,
    candidatesCount: 10,
    totalVotes: 393,
    leader: "Stell ALLAGBE",
    leaderVotes: 88,
    leaderCode: "0005"
};

// Fonctions globales
window.openVoteModal = function(candidateId) {
    // Cette fonction sera définie dans modal.js
    if (window.openVoteModalHandler) {
        window.openVoteModalHandler(candidateId);
    }
};

window.openShareModal = function(candidateId) {
    // Cette fonction sera définie dans share.js
    if (window.openShareModalHandler) {
        window.openShareModalHandler(candidateId);
    }
};

// Initialisation de l'application
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM chargé - Initialisation de main.js');
    
    // Initialiser la navigation mobile
    initMobileMenu();
    
    // Initialiser la page d'accueil
    if (document.getElementById('candidatesContainer')) {
        initHomePage();
    }
    
    // Initialiser la recherche
    initSearch();
});

// Navigation mobile
function initMobileMenu() {
    const mobileMenuBtn = document.querySelector('.mobile-menu');
    const nav = document.querySelector('.nav');
    
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            nav.classList.toggle('active');
            const icon = this.querySelector('i');
            if (icon.classList.contains('fa-bars')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }
}

// Page d'accueil
function initHomePage() {
    console.log('Initialisation page d\'accueil');
    const candidatesContainer = document.getElementById('candidatesContainer');
    const totalVotesElement = document.getElementById('totalVotes');
    const currentTotalVotesElement = document.getElementById('currentTotalVotes');
    
    // Calculer le total des votes
    const totalVotes = candidatesData.reduce((sum, candidate) => sum + candidate.votes, 0);
    
    // Mettre à jour les totaux
    if (totalVotesElement) {
        totalVotesElement.textContent = totalVotes;
    }
    
    if (currentTotalVotesElement) {
        currentTotalVotesElement.textContent = `${totalVotes} votes totaux`;
    }
    
    // Afficher les candidats
    renderCandidates(candidatesData);
}

// Afficher les candidats
function renderCandidates(candidates) {
    const container = document.getElementById('candidatesContainer');
    if (!container) return;
    
    container.innerHTML = '';
    
    candidates.forEach((candidate, index) => {
        const rank = index + 1;
        
        const candidateCard = document.createElement('div');
        candidateCard.className = `candidate-card ${candidate.isLeader ? 'leader' : ''}`;
        candidateCard.dataset.id = candidate.id;
        
        // Image placeholder si aucune image n'est disponible
        // NOTE: Les chemins d'images sont relatifs à la structure de votre projet
        const imageUrl = candidate.image || 'assets/images/test.jpeg';
        
        candidateCard.innerHTML = `
            <div class="candidate-header">
                <div class="candidate-rank">${rank}</div>
                <div class="candidate-image-container">
                    <img src="${imageUrl}" alt="${candidate.name}" class="candidate-image" onerror="this.onerror=null; this.src='assets/images/test.jpeg';">
                </div>
                <div class="candidate-info">
                    <h3 class="candidate-name">${candidate.name}</h3>
                    <p class="candidate-parish">${candidate.parish}</p>
                    <p class="candidate-code">CODE ${candidate.code}</p>
                </div>
            </div>
            
            <div class="candidate-votes">
                <div class="votes-number">${candidate.votes}</div>
                <div class="votes-percentage">${candidate.percentage}%</div>
            </div>
            
            <div class="progress-bar">
                <div class="progress-fill" style="width: ${candidate.percentage}%"></div>
            </div>
            
            <div class="candidate-actions">
                <button class="share-btn" data-candidate-id="${candidate.id}">
                    <i class="fas fa-share-alt"></i>
                    PARTAGER
                </button>
                <button class="vote-btn" data-candidate-id="${candidate.id}">
                    <i class="fas fa-vote-yea"></i>
                    VOTER MAINTENANT
                </button>
            </div>
        `;
        
        container.appendChild(candidateCard);
    });
    
    // Attacher les événements aux boutons
    attachCandidateEvents();
}

// Attacher les événements aux boutons des candidats
function attachCandidateEvents() {
    // Boutons de partage
    document.querySelectorAll('.share-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const candidateId = this.dataset.candidateId;
            console.log('Partager candidat:', candidateId);
            openShareModal(candidateId);
        });
    });
    
    // Boutons de vote
    document.querySelectorAll('.vote-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const candidateId = this.dataset.candidateId;
            console.log('Voter pour candidat:', candidateId);
            openVoteModal(candidateId);
        });
    });
}

// Recherche
function initSearch() {
    const searchInput = document.getElementById('searchCandidate');
    if (!searchInput) return;
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        if (searchTerm === '') {
            renderCandidates(candidatesData);
            return;
        }
        
        const filteredCandidates = candidatesData.filter(candidate => 
            candidate.name.toLowerCase().includes(searchTerm) ||
            candidate.parish.toLowerCase().includes(searchTerm) ||
            candidate.code.toLowerCase().includes(searchTerm)
        );
        
        renderCandidates(filteredCandidates);
    });
}