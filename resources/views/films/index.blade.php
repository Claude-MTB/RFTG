<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Liste DVD') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Barre de recherche -->
                <div class="search-container max-w-md mx-auto">
                    <input 
                        type="search" 
                        id="searchQuery"
                        name="query"
                        class="search-input" 
                        placeholder="Rechercher"
                        required
                    >
                    <button type="submit" class="search-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </div>

            <!-- Liste des films -->
            @if (isset($films) && count($films) > 0)
                <ol role="list" class="film-grid">
                    @foreach ($films as $index => $film)
                        <li class="film-card">
                            <!-- Menu contextuel -->
                            <div class="menu-container">
                                <button 
                                    onclick="toggleMenu({{ $film['filmId'] }})" 
                                    class="menu-button"
                                >
                                    ☰
                                </button>
                                <ul id="dropdownMenu-{{ $film['filmId'] }}" class="dropdown-menu">
                                    <li>
                                    <a href="{{ route('films.edit', $film['filmId']) }}" class="dropdown-item">
                                        Modifier
                                    </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('films.destroy', $film['filmId']) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-red-600">
                                                Supprimer
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            <!-- Numéro du film -->
                            <div class="film-number">{{ $index + 1 }}</div>

                            <!-- Titre du film -->
                            <div class="film-title">
                                <strong>Titre :</strong> 
                                <a href="{{ route('detail', ['filmId' => $film['filmId']]) }}" class="film-link">
                                    {{ $film['title'] ?? 'Titre inconnu' }}
                                </a>
                            </div>

                        </li>
                    @endforeach
                </ol>
            @else
                <p class="text-center text-gray-500">Aucun film disponible.</p>
            @endif
        </div>
    </div>

    <style>
        .film-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .film-card {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            position: relative;
        }

        .film-number {
            width: 2.5rem;
            height: 2.5rem;
            background: black;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .film-title {
            margin-bottom: 1rem;
        }

        .film-link {
            color: #2563eb;
            text-decoration: none;
        }

        .film-link:hover {
            text-decoration: underline;
        }

        .add-button {
            display: block;
            width: auto;
            margin-left: auto;
            padding: 0.5rem 1.5rem;
            background: black;
            color: white;
            border: none;
            border-radius: 9999px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .add-button:hover {
            background: #dc2626;
        }

        .menu-container {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .menu-button {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }

        .menu-button:hover {
            background: #f3f4f6;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            min-width: 8rem;
            z-index: 50;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-item {
            display: block;
            padding: 0.5rem 1rem;
            color: #374151;
            text-decoration: none;
            cursor: pointer;
            width: 100%;
            text-align: left;
            border: none;
            background: none;
        }

        .dropdown-item:hover {
            background: #f3f4f6;
        }

        .search-container {
            display: flex;
            align-items: center;
            border: 1px solid #e5e7eb;
            border-radius: 9999px;
            overflow: hidden;
            background: white;
        }

        .search-input {
            flex: 1;
            border: none;
            padding: 0.75rem 1rem;
            outline: none;
        }

        .search-button {
            padding: 0.75rem;
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
        }

        .search-icon {
            width: 1.25rem;
            height: 1.25rem;
        }
    </style>

    <script>
        function toggleMenu(filmId) {
            // Ferme tous les menus ouverts
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu.id !== `dropdownMenu-${filmId}`) {
                    menu.classList.remove('active');
                }
            });

            // Bascule le menu actuel
            const menu = document.getElementById(`dropdownMenu-${filmId}`);
            menu.classList.toggle('active');
        }

        // Ferme les menus si on clique en dehors
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.menu-container')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('active');
                });
            }
        });
    </script>
</x-app-layout>