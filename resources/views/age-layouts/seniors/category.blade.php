@extends ('age-layouts.seniors')

@section('title', 'Kategorie' )

@section('main')
    <div>
        {{ Breadcrumbs::render('seniors-category', $category->name) }}

        <h2>{{$category->name}}</h2>

        <filter-category
                :category-genres="{{$genres}}"
                :category-authors="{{$authors}}"
                :category-id="{{$category->id}}"
                :size="1.25"
                @filter="filterGenre"
                @nofilter="noFilter"
        ></filter-category>

        <book-preview-section
                :category-id="{{$category->id}}"
                :fontsize="1.25"
                :parent-products="products"
                @update="updateProducts"
        ></book-preview-section>
    </div>
@stop