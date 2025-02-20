<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraisons</title>
    <style>
        /* Style global */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Style pour le conteneur principal */
        .container {
            width: 80%;
            max-width: 800px;
            background: #ffffff;
            padding: 20px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Style pour le titre */
        .title {
            font-size: 2rem;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Style de la liste */
        .films-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .films-list li {
            background: #fafafa;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .films-list li:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Style pour le titre du film */
        .film-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #555;
        }

        /* Style pour le statut */
        .film-status {
            font-size: 1rem;
            color: #2196F3;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">🎥 Films en Cours de Livraison</h1>
        <ul class="films-list" id="films-list">
        </ul>
    </div>

    <!-- <script>
        // Appel au webservice pour récupérer les films
        fetch('http://localhost:8080/toad/rental/films-en-cours')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de la récupération des films.');
                }
                return response.json();
            })
            .then(data => {
                const filmsList = document.getElementById('films-list');

                // Ajouter les films à la liste
                data.forEach(film => {
                    const li = document.createElement('li');

                    li.innerHTML = `
                        <span class="film-title">${film.inventory_id}</span>
                        <span class="film-status">${film.statutLivraison}</span>
                    `;

                    filmsList.appendChild(li);
                });
            })
            .catch(error => console.error(error));
    </script> -->
    @if (isset($films) && count($films) > 0)
        <ol role="list" class="film-grid">
            @foreach ($films as $film)
                <li>
                    <div>
                        <strong>Titre :</strong> 
                        <a href="{{ route('detail', ['filmId' => $film['filmId']]) }}">
                            {{ $film['title'] ?? 'Titre inconnu' }}
                            {{ $film['statutLivraison'] ?? 'Statut de livraison inconnu' }}
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
</body>
</html>
