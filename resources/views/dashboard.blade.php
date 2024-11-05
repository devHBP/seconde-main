<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Se connecter avec quel poste ?
        </h2>
    </x-slot>

    <div class="py-12 flex flex-col space-y-6 bg-white">
        @foreach($roles as $role)
            <a href="{{ route('role.sublogin', ['role_name' => strToLower($role->name)]) }}">
                <x-role-card :title="$role->name" :description="$role->description" />
            </a>
        @endforeach
    </div>
</x-app-layout>
