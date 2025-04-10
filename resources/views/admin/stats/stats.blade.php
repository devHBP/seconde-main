<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Administrateur</span></p>
                <h2 class="title">
                    Dashboard Stats
                </h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('admin.dashboard') }}" class="">
                    Retour au dashboard
                </a>
            </div>
        </div>
    </x-slot>
    
    <div class="filter-stat-buttons">
        <div id="periode-affichee">
            -
        </div>
        <div>
            <button class="filter-btn active" data-filter="all">Depuis le début</button>
            <button class="filter-btn" data-filter="monthly">Ce mois-ci</button>
            <button class="filter-btn" data-filter="weekly">Cette semaine</button>
        </div>
    </div>

    <div class="layout-container stats mx-auto">
        <h2>👤 Clients</h2>
        <a class="stat-tile">
            <h3>Clients uniques</h3>
            <p id="stat-clients">—</p>
        </a>
    </div>
    <div class="layout-container stats mx-auto">
        <h2>🎟️ Tickets</h2>
        <a class="stat-tile">
            <h3>Tickets</h3>
            <p id="stat-tickets">—</p>
        </a>
        <a class="stat-tile">
            <h3>Bons d'achat</h3>
            <p id="stat-bons">—</p>
        </a>
        <a class="stat-tile">
            <h3>Remboursements</h3>
            <p id="stat-cash">—</p>
        </a>
    </div>
    <div class="layout-container stats mx-auto">
        <h2>🛍️ Paniers</h2>
        <a class="stat-tile">
            <h3>Articles repris</h3>
            <p id="stat-articles">—</p>
        </a>
    </div>
    <div class="layout-container stats mx-auto">
        <h2>♲ SAV</h2>
        <a class="stat-tile">
            <h3>Nombre de Tickets</h3>
            <p id="stat-tickets-sav">—</p>
        </a>
        <a class="stat-tile">
            <h3>Articles repris</h3>
            <p id="stat-articles-sav">—</p>
        </a>
        <a class="stat-tile">
            <h3>Total Remboursement</h3>
            <p id="stat-remboursement-sav">—</p>
        </a>
        <a class="stat-tile">
            <h3>Total Bon Achat</h3>
            <p id="stat-bons-sav">—</p>
        </a>
    </div>

    <script>
        let currentFilter = 'all';
        let stats = {};
        async function fetchStats(){
            try {
                const response = await fetch('/admin/stats/json', {
                });
                if(!response.ok) throw new Error('Erreur API');
                const data = await response.json();
                stats = data;
                updateStats('all');
            } catch (err) {
                console.error('Erreur lors du chargements des stats' , err);
            }
        }
        function updateStats(filter){
            document.getElementById('stat-tickets').textContent = stats.tickets[filter];
            document.getElementById('stat-bons').textContent = stats.total_bon_achat[filter] + ' €';
            document.getElementById('stat-cash').textContent = stats.total_remboursement[filter] + ' €';
            document.getElementById('stat-articles').textContent = stats.articles[filter];
            document.getElementById('stat-clients').textContent = stats.clients[filter];
            document.getElementById('stat-tickets-sav').textContent = stats.sav_tickets[filter];
            document.getElementById('stat-articles-sav').textContent = stats.sav_articles[filter];
            document.getElementById('stat-bons-sav').textContent = stats.sav_bons[filter] + '€';
            document.getElementById('stat-remboursement-sav').textContent = stats.sav_remboursement[filter] +'€';
            document.getElementById('periode-affichee').textContent = formatPeriod(stats.periods[filter]);

            
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`.filter-btn[data-filter="${filter}"]`).classList.add('active');
        }

        function formatPeriod(period) {
        if (typeof period === 'string') {
                return period; // cas de "depuis le début"
            }
            return `Période : ${period.start} au ${period.end}`;
        }

        document.addEventListener('DOMContentLoaded', ()=> {
            fetchStats();
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const filter = btn.getAttribute('data-filter');
                    currentFilter = filter;
                    updateStats(filter);
                });
            });
            setInterval(() => {
                fetchStats();
            }, 2 * 60 * 1000);
        });
    </script>
</x-app-layout>