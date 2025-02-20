<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*class PanierController extends Controller
{
    // Afficher le panier
    public function index()
    {
        // Récupérer les films du panier depuis la session
        $panier = session()->get('panier', []);
        return view('panier', compact('panier'));
    }

    // Ajouter un film au panier
    public function ajouter(Request $request)
    {
        $filmId = $request->input('id');
        $filmTitre = $request->input('titre');
        $filmPrix = $request->input('prix');

        // Récupérer le panier depuis la session
        $panier = session()->get('panier', []);

        // Vérifier si le film est déjà dans le panier
        if (isset($panier[$filmId])) {
            $panier[$filmId]['quantite'] += 1;
        } else {
            $panier[$filmId] = [
                'titre' => $filmTitre,
                'prix' => $filmPrix,
                'quantite' => 1
            ];
        }

        // Enregistrer le panier mis à jour en session
        session()->put('panier', $panier);

        return redirect()->route('panier.index')->with('success', 'DVD ajouté au panier !');
    }

    // Supprimer un film du panier
    public function supprimer($id)
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            unset($panier[$id]);
            session()->put('panier', $panier);
        }

        return redirect()->route('panier.index')->with('success', 'DVD supprimé du panier !');
    }

    // Vider complètement le panier
    public function vider()
    {
        session()->forget('panier');
        return redirect()->route('panier.index')->with('success', 'Panier vidé !');
    }
}
*/