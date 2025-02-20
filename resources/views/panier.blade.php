<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Votre Panier</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(count($panier) > 0)
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border p-2">Titre</th>
                        <th class="border p-2">Prix</th>
                        <th class="border p-2">Quantité</th>
                        <th class="border p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($panier as $id => $film)
                        <tr>
                            <td class="border p-2">{{ $film['titre'] }}</td>
                            <td class="border p-2">{{ $film['prix'] }}€</td>
                            <td class="border p-2">{{ $film['quantite'] }}</td>
                            <td class="border p-2">
                                <form action="{{ route('panier.supprimer', $id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <form action="{{ route('panier.vider') }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded">
                    Vider le panier
                </button>
            </form>
        @else
            <p>Votre panier est vide.</p>
        @endif
    </div>
@endsection
</x-app-layout> -->
