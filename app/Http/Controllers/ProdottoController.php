<?php

namespace App\Http\Controllers;

use App\Models\Articolo;
use App\Models\Prodotto;
use Illuminate\Http\Request;

class ProdottoController extends Controller
{
    public function index(Request $request)
    {
        /* Recupero tutti i query param inviati dal client. */
        $data= $request->all();

        /* Query SQL che mi restituisce tutti gli articoli presenti nel mio listino acquisti */
        $articoli = Articolo::
        where('formato', 'LIKE', '%'.$data['formato'].'%')
        ->where('unita_di_misura_formato', 'LIKE', '%'.$data['unita_di_misura_formato'].'%')
        ->where('prezzo_unitario', 'LIKE', $data['prezzo_unitario'])
        ->where('fornitore', 'LIKE', $data['fornitore'])
        ->get();

        /* Creo un array 'response' che mi aiuterà a formattare meglio la risposta alla chiamata */
        $response = [];
        /* Per ogni articolo recuperato dalla query precedente */
        foreach($articoli as $articolo){
            /* recupero l'oggetto dal database */
            $prodotto = Prodotto::where('id', 'LIKE', $articolo->id_materia)->first();

            /* controllo che non sia null */
            if ($prodotto != null){

                /* creo una variabile per sapere se l'articolo è già presente nella mia risposta */
                $already_exist = 0;

                /* ciclo per tutti i prodotti già presenti nella risposta */
                foreach($response as $response_product){
                    /* se il prodotto c'è già nella risposta setto la variabile = TRUE */
                    if ($prodotto->id == $response_product['id']){
                        $already_exist = 1;
                    }
                }

                /* Se la variabile è ancora = FALSE, aggiungo il prodotto alla risposta */
                if ($already_exist == 0){
                    $prodotto = [
                        'id' => $prodotto->id,
                        'descrizione' => $prodotto->nome,
                        'unita_di_misura_formato' => $prodotto->um,
                        'quantita_approvigionata' => 1,
                        'costo_prodotto' => $prodotto->costo
                    ];
                    array_push($response, $prodotto);
                }

                /* Altrimenti ritrovo l'indice di quel prodotto nella mia risposta, e modifico la sua quantita_approvigionata */
                else {

                    $index = 0; /* indice dell'array response */
                    foreach($response as $response_product){
                        if ($prodotto->id == $response_product['id']){
                            /* aumento quantita_approvigionata */
                            $response[$index]['quantita_approvigionata'] += 1;
                        }
                        else {
                            /* aumento l'index */
                            $index ++;
                        }
                    }
                }
            }
        }
        /* ritorno la risposta in formato json */
        return json_encode($response);

    }

}
