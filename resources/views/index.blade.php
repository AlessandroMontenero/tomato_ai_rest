@foreach ($prodotti as $prodotto)
    {{$prodotto->nome}} ||
    @foreach ($prodotto->articoli as $articolo)
        {{$articolo->formato}}
    @endforeach
    <br>
@endforeach
