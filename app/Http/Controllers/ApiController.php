<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    public function getFilms()
    {
        $apiUrl = 'http://localhost:8080/toad/film/all';
        
        try {
            // Récupérer la réponse JSON du webservice
            $response = file_get_contents($apiUrl);
        
            // Vérifier si la réponse est valide
            if ($response === false) {
                throw new Exception("Erreur lors de l'appel de l'API.");
            }
        
            // Décoder la réponse JSON en tableau associatif PHP
            $films = json_decode($response, true);
            
        
            // Vérifier si le JSON est bien décodé
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Erreur de décodage JSON : " . json_last_error_msg());
            }

            // Transmet les données à la vue 'films'
            return view('films.index', compact('films'));
        
        } catch (Exception $e) {
            // En cas d'erreur, retournez un message d'erreur à la vue
            return view('films.index', ['error' => $e->getMessage()]);
        }
    }

    public function getFilmDetail($id)
    {
        $apiUrl = 'http://localhost:8080/toad/film/getById?id=' . $id;
    
        try {
            $response = file_get_contents($apiUrl);
    
            if ($response === false) {
                throw new Exception("Erreur lors de l'appel de l'API pour le film.");
            }
    
            $film = json_decode($response, true);
    
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Erreur de décodage JSON : " . json_last_error_msg());
            }
    
            return view('films.detail', compact('film'));
    
        } catch (Exception $e) {
            return view('films.detail', ['error' => $e->getMessage()]);
        }
    }
    public function edit($id) {
        $apiUrl = 'http://localhost:8080/toad/film/getById?id=' . $id;
        try {
            $response = file_get_contents($apiUrl);
            if ($response === false) {
                throw new Exception("Erreur lors de l'appel de l'API pour le film.");
            }
            $film = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Erreur de décodage JSON : " . json_last_error_msg());
            }
            return view('films.edit', compact('film')); 
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage()); 
        }
    }

    public function update(Request $request, $id) {
        $apiUrl = 'http://localhost:8080/toad/film/update';
    
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->put($apiUrl, [
                'json' => [
                    'filmId' => $id,
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'releaseYear' => $request->input('releaseYear'),
                    'rentalDuration' => $request->input('rentalDuration'),
                    'rentalRate' => $request->input('rentalRate'),
                ]
            ]);
    
            if ($response->getStatusCode() === 200) {
                return redirect()->route('films.index')->with('success', 'Film mis à jour avec succès.');
            } else {
                return redirect()->route('films.index')->with('error', 'Erreur lors de la mise à jour du film.');
            }
        } catch (\Exception $e) {
            return redirect()->route('films.index')->with('error', 'Erreur: ' . $e->getMessage());
        }
    }



    public function getFilmUpdate($id)
    {
        $apiUrl = 'http://localhost:8080/toad/film/getById?id=' . $id;
    
        try {
            $response = file_get_contents($apiUrl);
    
            if ($response === false) {
                throw new Exception("Erreur lors de l'appel de l'API pour le film.");
            }
    
            $film = json_decode($response, true);
    
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Erreur de décodage JSON : " . json_last_error_msg());
            }
    
            return view('films.detail', compact('film'));
    
        } catch (Exception $e) {
            return view('films.detail', ['error' => $e->getMessage()]);
        }
    }

    public function getFilmDelete($id)
    {
        $apiUrl = 'http://localhost:8080/toad/film/getById?id=' . $id;
    
        try {
            $response = file_get_contents($apiUrl);
    
            if ($response === false) {
                throw new Exception("Erreur lors de l'appel de l'API pour le film.");
            }
    
            $film = json_decode($response, true);
    
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Erreur de décodage JSON : " . json_last_error_msg());
            }
    
            return view('films.detail', compact('film'));
    
        } catch (Exception $e) {
            return view('films.detail', ['error' => $e->getMessage()]);
        }
    }

    public function getRentalLivraison($id)
    {
        $apiUrl = 'http://localhost:8080/toad/rental/films-en-cours';
    
        try {
            $response = file_get_contents($apiUrl);
    
            if ($response === false) {
                throw new Exception("Erreur lors de l'appel de l'API pour le film.");
            }
    
            $film = json_decode($response, true);
    
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Erreur de décodage JSON : " . json_last_error_msg());
            }
    
            return view('livraison', compact('film'));
    
        } catch (Exception $e) {
            return view('livraison', ['error' => $e->getMessage()]);
        }
    }

    public function getStockDetail($id)
{
    $apiUrl = 'http://localhost:8080/toad/inventory/getById?id=' . $id; // L'URL de l'API pour un stock spécifique
    
    try {
        // Récupérer la réponse JSON du webservice
        $response = file_get_contents($apiUrl);

        // Vérifier si la réponse est valide
        if ($response === false) {
            throw new Exception("Erreur lors de l'appel de l'API pour le stock.");
        }

        // Décoder la réponse JSON en tableau associatif PHP
        $stock = json_decode($response, true);

        // Vérifier si le JSON est bien décodé
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Erreur de décodage JSON : " . json_last_error_msg());
        }

        // Transmet les données à la vue 'stock_detail'
        return view('stock_detail', compact('stock'));
    
    } catch (Exception $e) {
        return view('stock', ['error' => $e->getMessage()]);
    }
}

public function getStockUpdate($id)
{
    $apiUrl = 'http://localhost:8080/toad/inventory/getById?id=' . $id; // L'URL de l'API pour un stock spécifique
    
    try {
        // Récupérer la réponse JSON du webservice
        $response = file_get_contents($apiUrl);

        // Vérifier si la réponse est valide
        if ($response === false) {
            throw new Exception("Erreur lors de l'appel de l'API pour le stock.");
        }

        // Décoder la réponse JSON en tableau associatif PHP
        $stock = json_decode($response, true);

        // Vérifier si le JSON est bien décodé
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Erreur de décodage JSON : " . json_last_error_msg());
        }

        // Transmet les données à la vue 'stock_update' pour mise à jour
        return view('stock_update', compact('stock'));
    
    } catch (Exception $e) {
        // En cas d'erreur, retournez un message d'erreur à la vue
        return view('stock_update', ['error' => $e->getMessage()]);
    }
}

public function getAllStocks()
{
    $apiUrl = 'http://localhost:8080/toad/inventory/all'; // L'URL de l'API pour récupérer les stocks
    
    try {
        // Récupérer la réponse JSON du webservice
        $response = file_get_contents($apiUrl);

        // Vérifier si la réponse est valide
        if ($response === false) {
            throw new Exception("Erreur lors de l'appel de l'API pour les stocks.");
        }

        // Décoder la réponse JSON en tableau associatif PHP
        $stocks = json_decode($response, true);

        // Vérifier si le JSON est bien décodé
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Erreur de décodage JSON : " . json_last_error_msg());
        }

        // Transmet les données à la vue 'stocks'
        return view('stocks', compact('stocks'));
    
    } catch (Exception $e) {
        // En cas d'erreur, retournez un message d'erreur à la vue
        return view('stocks', ['error' => $e->getMessage()]);
    }
}
public function getStockDelete($id)
{
    $apiUrl = 'http://localhost:8080/toad/inventory/delete/' . $id; // L'URL de l'API pour supprimer un stock spécifique
    
    try {
        // Récupérer la réponse JSON du webservice (ici on s'attend à un status de réussite)
        $response = file_get_contents($apiUrl);

        // Vérifier si la réponse est valide
        if ($response === false) {
            throw new Exception("Erreur lors de l'appel de l'API pour supprimer le stock.");
        }

        // Vérifier si le JSON est bien décodé
        $status = json_decode($response, true);

        // Si une erreur est renvoyée, lever une exception
        if ($status['error']) {
            throw new Exception($status['error']);
        }

        // Transmet la réussite de la suppression à la vue
        return redirect()->route('stocks.index')->with('success', 'Stock supprimé avec succès');
    
    } catch (Exception $e) {
        // En cas d'erreur, retournez un message d'erreur à la vue
        return redirect()->route('stocks.index')->with('error', $e->getMessage());
    }
}


}
