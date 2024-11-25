<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-primary">
            <h2>
                Se connecter avec quel poste ?
            </h2>
        </div>
    </x-slot>

    <div class="py-12 flex flex-col space-y-6">
        <form action={{ route('role.sublogin')}} method="POST">
            @csrf
            <input type="hidden" name="role_name" value="encaissement">
            <div class="card-container">
                <button type="submit" class="role-card flex justify-center">
                    <x-role-card />
                </button>
            </div>
        </form>
        <form action={{ route('role.sublogin')}} method="POST">
            @csrf
            <input type="hidden" name="role_name" value="reception">
            <div class="card-container">
                <button type="submit" class="role-card flex justify-center">
                    <x-role-card-reception />
                </button>
            </div>
        </form>
        <form action={{ route('role.sublogin')}} method="POST">
            @csrf
            <div class="card-container">
                <input type="hidden" name="role_name" value="administrateur">
                <button type="submit" class="role-card flex justify-center">
                    <x-role-card-admin />
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
