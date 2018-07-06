@extends ('age-layouts.kids')

@section('title', 'Wunschliste' )

@section('main')
    @if(!empty($products))
        <section class="grid-container margin-top-kids margin-bottom-small">
            <div class="grid-x flex-center">
                <a href="{{ route('kids-send-wishlist') }}" class="button">Versende deine Wunschliste</a>
            </div>
        </section>

        <section class="grid-container">
            <div class="grid-x grid-padding-x grid-padding-y">
                @foreach($products as $product)
                    <kids-book-preview key="{{$product['item']['id']}}"
                                       class="cell small-6 medium-3 large-3"
                                       book-id="{{$product['item']['id']}}"
                                       img="{{$product['item']['image'][0]['img']}}"
                    ></kids-book-preview>
                @endforeach
            </div>
        </section>
    @else
        <section class="grid-y" style="height: 35vh">
            <div class="grid-x flex-center">
                <p class="cell small-6 medium-cell-block placeholder">Sie haben noch keine Produkte in Ihrer Wunschliste gespeichert.</p>
            </div>
        </section>
    @endif
@stop