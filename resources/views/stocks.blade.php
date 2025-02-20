<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Stock DVD') }}
        </h2>
    </x-slot>
    <br>

    <div class="search-container">
        <input type="search" class="search-input" placeholder="Rechercher">
        <button class="search-button">
             <img src="{{ asset('img/loupe.png') }}" alt="Search" class="search-icon">
        </button>
    </div>
    
    <script>
    function performSearch() {
        const query = document.getElementById('searchQuery').value;
        if (query) {
            window.location.href = `/search?query=${encodeURIComponent(query)}`;
        } else {
            alert('Veuillez entrer une recherche.');
        }
    }
</script>
    
    <br>
    
    <div class="wrapper" style="position: relative;">


    <!-- Liste des films -->
    @if (isset($films) && count($films) > 0)
        <ol role="list" class="film-grid">
            @foreach ($films as $film)
                <li>
                    <div>
                        <strong>Titre :</strong> 
                        <a href="{{ route('stocks', ['filmId' => $film['filmId']]) }}">
                            {{ $film['title'] ?? 'Titre inconnu' }}
                         </a>
                    </div>
                    <div>
                        <input class="styled" type="button" value="Ajouter" />
                    </div>
                </li>
            @endforeach
        </ol>
    @else
        <p>Aucun film disponible.</p>
    @endif
</div>

<script>
    // Fonction pour afficher/masquer le menu déroulant
    function toggleMenu() {
        const menu = document.getElementById('dropdownMenu');
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    }
</script>
</x-app-layout>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: "Open Sans", sans-serif;
        margin: 0;
        padding: 1rem;
    }

    .wrapper {
        max-width: 1200px;
        margin: 0 auto;
    }

    ol.film-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem; 
        list-style: none;
        padding: 0;
    }

    li {
        background: aliceblue;
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0.25rem 0.25rem 0.75rem rgb(0 0 0 / 0.1);
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    li::before {
        counter-increment: list-item;
        content: counter(list-item);
        font-size: 2rem;
        font-weight: 700;
        width: 2em;
        height: 2em;
        background: black;
        border-radius: 50%;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 1rem;
    }

    li:nth-child(even) {
        background: lavender;
    }

    a {
        color: #0077cc;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        ol.film-grid {
            grid-template-columns: 1fr; /* responsive */
        }
    }
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

label {
  display: block;
  font:
    1rem 'Fira Sans',
    sans-serif;
}

.search-container {
    display: flex;
    align-items: center;
    max-width: 300px;
    /* margin: 0 auto; */
    border: 1px solid #ccc;
    border-radius: 30px;
    overflow: hidden;
    background-color: #fff;
}

.search-input {
    flex: 1;
    border: none;
    padding: 10px;
    font-size: 1rem;
    outline: none;
    border-radius: 0;
}

.search-button {
    border: none;
    background: none;
    padding: 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-icon {
    width: 20px;
    height: 20px;
}

</style>
