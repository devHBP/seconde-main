<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-primary">
            <h2>Entrer vos identifiants</h2>
        </div>
    </x-slot>
    <div class="form-container">
        <div class="title">
            <h2>{{ $role->name }}</h2>
        </div>
        <div class="login-box">
            <form method="POST" action="{{ route('role.authenticate', ['role_name' => strToLower($role->name)]) }}">
                @csrf
                <input type="hidden" name="role_id" value="{{ $role->id }}">
            
                <div>
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" name="username" required>
                </div>
            
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="" required>
                </div>
            
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </div>
</x-app-layout>