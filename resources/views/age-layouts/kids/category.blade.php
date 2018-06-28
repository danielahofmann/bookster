@extends ('age-layouts.kids')

@section('title', 'Kategorie' )

@section('main')
    <div>
        <h2 class="margin-top">{{$category->name}}</h2>

        <filter-category
                :category-genres="{{$genres}}"
                :category-authors="{{$authors}}"
                :category-id="{{$category->id}}"
                :size="1.25"
                @filter="filterGenre"
                @nofilter="noFilter"
        ></filter-category>

        <kids-preview
                :category-id="{{$category->id}}"
                :fontsize="1.25"
                :parent-products="products"
                @update="updateProducts"
        ></kids-preview>
    </div>
@stop