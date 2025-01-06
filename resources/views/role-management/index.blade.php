<x-app-layout>
    @slot('title', 'Role Management')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Role Management
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200 dark:border-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Nama
                        </th>
                        <th class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Role
                        </th>
                        <th class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Permission
                        </th>
                        <th class="border border-gray-300 dark:border-gray-600 px-2 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Action Role
                        </th>
                        <th class="border border-gray-300 dark:border-gray-600 px-2 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Action Permission
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($users as $user)
                    <tr>
                        <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-medium">
                                        {{ $user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $user->email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="border text-center border-gray-300 dark:border-gray-600 px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            @foreach ($roles as $role)
                                @if ($user->roles->contains('id', $role->id))
                                    <span class="bg-green-200 text-green-800 font-semibold px-2 py-1 rounded">
                                        {{ $role->name }}
                                    </span>
                                @endif
                            @endforeach
                        </td>
                        <td class="border text-wrap border-gray-300 dark:border-gray-600 px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            @foreach ($permissions as $permission)
                                @if ($user->permissions->contains('id', $permission->id))
                                    <span class="text-green-800 font-semibold px-2 py-1 rounded">
                                        {{ $permission->name }}
                                    </span>
                                @endif
                            @endforeach
                        </td>

                        {{-- Form untuk Update Role --}}
                        <td class="border text-center border-gray-300 dark:border-gray-600 px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            <form action="{{ route('role-management.update-role', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="role_id" class="bg-green-200 border border-gray-300 dark:bg-gray-800 dark:text-gray-300 rounded">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                                    Update
                                </button>
                            </form>
                        </td>

                        {{-- Form untuk Tambah atau Hapus Permission --}}
                        <td class="border text-center border-gray-300 dark:border-gray-600 px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            {{-- Tambah Permission --}}
                            <form action="{{ route('role-management.add-permission', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <select name="permission_id" class="bg-green-200 border border-gray-300 dark:bg-gray-800 dark:text-gray-300 rounded">
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                                    Tambah
                                </button>
                            </form>

                            {{-- Hapus Permission --}}
                            <form action="{{ route('role-management.remove-permission', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <select name="permission_id" class="bg-red-200 border border-gray-300 dark:bg-gray-800 dark:text-gray-300 rounded">
                                    @foreach($user->permissions as $permission)
                                        @if ($user->permissions->contains('id', $permission->id))
                                            <option value="{{ $permission->id }}" selected>
                                                {{ $permission->name }}
                                            </option>
                                            
                                        @endif
                                    @endforeach
                                </select>
                                <button type="submit" class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
