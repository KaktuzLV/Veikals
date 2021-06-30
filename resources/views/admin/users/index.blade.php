<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <table class="table-auto w-full">
                <thead>
                    <tr class = "border-b border-green-400">
                        <th class="text-left ">{{__('ID')}}</th>
                        <th class="text-left">{{__('Name')}}</th>
                        <th class="text-left">{{__('Email')}}</th>
                        <th class="text-left">{{__('Role')}}</th>
                        <th class="text-right">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="text-left">{{ $user->id }}</td>
                            <td class="text-left">{{ $user->name }}</td>
                            <td class="text-left">{{ $user->email }}</td>
                            <td class="text-left">{{ $user->role }}</td>
                            <td>
                                <div class="flex gap-2 justify-end">
                                    <x-button-link href="{{ route('admin.users.edit', $user) }}">{{ __('Edit') }}</x-button-link>
                                    <form method="post" action="{{ route('admin.users.destroy', $user) }}">
                                        @csrf
                                        @method('delete')
                                        <x-button>{{ __('Delete') }}</x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">{{ __('No Users') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
