<!-- resources/views/detail.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('DVD') }} {{$film['filmId'] ?? 'Erreur Id'}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (isset($film))
                        <center><h3 class="text-2xl">{{ $film['title'] ?? 'Titre inconnu' }}</h3></center><br>
                        <p><strong>Description :</strong> {{ $film['description'] ?? 'Description inconnue' }}</p>
                        <p><strong>Note :</strong> {{ $film['rating'] ?? 'Note incconue' }}</p>
                        <p><strong>Année de sortie :</strong> {{ $film['releaseYear'] ?? 'Année inconnue' }}</p>
                        <!-- <div>
                            <form action="method="POST">
                                <button type="submit" class="styled">Ajouter au panier</button>
                            </form>
                             <input class="styled" type="button" value="Ajouter" />
                        </div> -->
                    @elseif (isset($error))
                        <p class="text-red-500">{{ $error }}</p>
                    @else
                        <p>Aucune information disponible pour ce film.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
.styled {
  border: 0;
  line-height: 2.5;
  padding: 0 20px;
  margin-left: 75%;
  font-size: 1rem;
  text-align: center;
  color: #fff;
  text-shadow: 1px 1px 1px #000;
  border-radius: 50px;
  background-color: rgba(0, 0, 0, 1);
  background-image: linear-gradient(
    to top left,
    rgba(0, 0, 0, 0.2),
    rgba(0, 0, 0, 0.2) 30%,
    rgba(0, 0, 0, 0)
  );
  box-shadow:
    inset 2px 2px 3px rgba(255, 255, 255, 0.6),
    inset -2px -2px 3px rgba(0, 0, 0, 0.5);
}

.styled:hover {
  background-color: rgba(255, 0, 0, 1);
}

.styled:active {
  box-shadow:
    inset -2px -2px 3px rgba(255, 255, 255, 0.6),
    inset 2px 2px 3px rgba(0, 0, 0, 0.6);
}
</style>
