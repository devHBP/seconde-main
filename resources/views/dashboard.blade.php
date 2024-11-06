<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Se connecter avec quel poste ?
        </h2>
    </x-slot>

    <div class="py-12 flex flex-col space-y-6 bg-white">
        @foreach($roles as $role)
        <form action={{ route('role.sublogin')}} method="POST">
            @csrf
            <input type="hidden" name="role_name" value="{{ $role->name }}">
            <button type="submit" class="role-card w-full flex justify-center">
                <x-role-card :title="$role->name" :description="$role->description" />
            </button>
        </form>
        @endforeach
    </div>
</x-app-layout>
