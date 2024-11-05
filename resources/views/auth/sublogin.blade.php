<x-app-layout>
    <div class="title">
        <h2>{{ $role->name }}</h2>
    </div>
    <div class="login-box">
        <form method="POST" action="">
            @csrf
            <input type="hidden" name="role_id" value="{{ $role->id }}">
        
            <div>
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" required>
            </div>
        
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" required>
            </div>
        
            <button type="submit">Se connecter</button>
        </form>
    </div>
</x-app-layout>