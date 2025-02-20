<x-app-layout>
    <x-slot name="header">
            <div class="dashboard-header">
                <div>
                    <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Administrateur</span></p>
                    <h2 class="title">
                        Client n°{{ $client->id}} 
                    </h2>
                </div>
                <div class="header-right-button">
                    <a href="{{ route('admin.clients') }}" class="">
                        Retour
                    </a>
                </div>
            </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-8">
        <!-- Infos Client -->
        <div class="mb-6 client-layout">
            <h3 class="text-lg font-semibold">Informations du Client</h3>
            
            <div class="space-y-2 client-fields">
                <div class="flex items-center gap-2 client-field">
                    <div>
                        <span class="font-semibold">Nom :</span> 
                        <span class="editable" data-field="lastname">{{ $client->lastname }}</span>
                    </div>
                    <button class="edit-btn" data-field="lastname">✏️</button>
                </div>

                <div class="flex items-center gap-2 client-field">
                    <div>
                        <span class="font-semibold">Prénom :</span> 
                        <span class="editable" data-field="firstname">{{ $client->firstname }}</span>
                    </div>
                    <button class="edit-btn" data-field="firstname">✏️</button>
                </div>

                <div class="flex items-center gap-2 client-field">
                    <div>
                        <span class="font-semibold">Email :</span> 
                        <span class="editable" data-field="email">{{ $client->email ?? 'Non renseigné' }}</span>
                    </div>
                    <button class="edit-btn" data-field="email">✏️</button>
                </div>

                <div class="flex items-center gap-2 client-field">
                    <div>
                        <span class="font-semibold">Téléphone :</span> 
                        <span class="editable" data-field="phone">{{ $client->phone ?? 'Non renseigné' }}</span>
                    </div>
                    <button class="edit-btn" data-field="phone">✏️</button>
                </div>
            </div>
        </div>

        <!-- Liste des Tickets Associés -->
        <h3 class="text-lg font-semibold mb-4">Tickets Associés</h3>
        <div class="rounded-md overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200">
                    <tr class="text-left border-b border-gray-300">
                        <th class="px-4 py-2">N° Ticket</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Statut</th>
                        <th class="px-4 py-2">Date de création</th>
                        <th class="px-4 py-2">Date de d'utilisation</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($client->tickets->count() > 0)
                        @foreach ($client->tickets as $ticket)
                        <tr class="border-b">
                            <td class="px-4 py-3">
                                {{ $ticket->uuid }}
                            </td>
                            <td class="px-4 py-3">{{ ucfirst($ticket->type_utilisation) }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-white 
                                    {{ $ticket->statut === 'périmé' ? 'bg-red-500' : ($ticket->statut === 'consommé' ? 'bg-gray-500' : 'bg-green-500') }}">
                                    {{ ucfirst($ticket->statut) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3">{{ $ticket->deactivation_date ? $ticket->deactivation_date->format('d/m/Y H:i') : "Pas encore utilisé"}}</td>
                            <td class="px-4 py-3 link">
                                <a href="{{ route('admin.ticket.show', ['ticket_id' => $ticket->uuid]) }}">
                                    <span>👁️</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center py-6">
                                Aucun ticket associé à ce client.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<!-- Script JS -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editButtons = document.querySelectorAll('.edit-btn');

        editButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                let field = this.getAttribute('data-field');
                let span = document.querySelector(`.editable[data-field="${field}"]`);

                //remplace le texte par une input au click
                let input = document.createElement('input');
                input.type = 'text';
                input.value = span.textContent.trim();
                input.classList.add('border', 'px-2', 'py-1', 'rounded');

                // Boutton de validation
                let saveBtn = document.createElement('button');
                saveBtn.textContent = "✅";
                saveBtn.classList.add('ml-2', 'px-2', 'py-1', 'rounded');

                // Remplacement du texte par l'input
                span.replaceWith(input);
                this.replaceWith(saveBtn);
                //Sauvegarde en DB via Fetch
                saveBtn.addEventListener('click', async function() {
                    let newValue = input.value;
                    let clientId = "{{ $client->id }}";
                    let response = await fetch(`/administrateur/clients/${clientId}/update`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body:JSON.stringify({
                            field: field,
                            value: newValue
                        })
                    });
                    let result = await response.json();

                    if(response.ok){
                        input.replaceWith(span);
                        saveBtn.replaceWith(btn);
                        span.textContent = newValue;
                    } else {
                        alert('Erreur lors de la mise à jour du champ.')
                    }
                })
            })
        });
    })
</script>
