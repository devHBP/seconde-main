<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Se connecter avec quel poste ?
        </h2>
    </x-slot>

    <div class="py-12 flex flex-col items-center space-y-6 bg-white">
        @foreach($roles as $role)
            <x-role-card :title="$role->name" :description="$role->description" />
        @endforeach
    </div>
</x-app-layout>
