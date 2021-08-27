<div class="col-12">
    <b class="font-weight-bold">{{ count($results) }} résultat(s) trouvé(e)</b>
</div>
@foreach ($results as $store_produit)    
    <div class="col-lg-3">
        <div class="card z-depth-0">
            <div style="height: 150px; overflow: hidden;">
                <img class="card-img-top" src="{{ URL::asset($store_produit->fichier) }}" alt="">
            </div>
            <div class="card-body pb-2 pt-2 pl-0 pr-0">
                
                <a href="{{ route('usersCubeStoreCommander', [$store_produit->nom, $store_produit->id]) }}" class="blue-grey-text">
                    {{ $store_produit->nom }}
                </a>

                <h6 class="text-left mb-2 mt-1 font-size-14"><b>Auteur : </b>{{ $store_produit->nom_auteur }}</h6>
                <h6 class="text-left mb-2 mt-1 font-size-14"><b>Maison d'édition ou compte d'auteur</b><br />{{ $store_produit->maison_edition }}</h6>

                <p class="card-text">
                    <a href="{{ route('usersCubeStoreCommander', [$store_produit->nom, $store_produit->id]) }}" class="orange-text">
                        <b>Voir & commander</b>
                    </a>
                </p>
            </div>
        </div>
    </div>
@endforeach