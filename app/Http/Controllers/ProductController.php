<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

	/**
	 * Display a listing of the newest bestseller
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getNewBestsellers() {
		$bestsellers = Product::where('bestseller', 1)
		                      ->orderBy('created_at', 'desc')
		                      ->take(12)
			                  ->with('image')
			                  ->with('author')
			                  ->where('ebook', 0)
		                      ->get();
		return $bestsellers;
    }

    /**
	 * Display a listing of the newest bestseller
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getNewBestsellersForKids() {
		$bestsellers = Product::where('bestseller', 1)
		                      ->orderBy('created_at', 'desc')
		                      ->take(12)
		                      ->where('category_id', 3)
			                  ->with('image')
			                  ->with('author')
			                  ->where('ebook', 0)
		                      ->get();
		return $bestsellers;
    }

	/**
	 * Display a listing of the novelties
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function getNovelties(  ) {
	    $novelties = Product::where('ebook', 0)
	                          ->orderBy('created_at', 'desc')
	                          ->take(6)
	                          ->with('image')
	                          ->with('author')
	                          ->get();
	    return $novelties;
    }

	/**
	 * Display a listing of the novelties for kids
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getKidsNovelties(  ) {
		$novelties = Product::where('ebook', 0)
		                    ->orderBy('created_at', 'desc')
							->where('category_id', 3)
		                    ->take(8)
		                    ->with('image')
		                    ->get();
		return $novelties;
	}

	/**
	 * Get products of genre
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getProductsOfGenre($id) {
		$products_of_genre = Product::where('genre_id', $id)
		                    ->orderBy('created_at', 'desc')
		                    ->with('image')
		                    ->get();
		return $products_of_genre;
	}

	/**
	 * Get products of author
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getProductsOfAuthor($id) {
		$products_of_author = Product::where('author_id', $id)
		                            ->orderBy('created_at', 'desc')
		                            ->with('image')
		                            ->get();
		return $products_of_author;
	}

	/**
	 * Get products of author
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function filterProducts(Request $request) {
		$genre_id = $request->genreId;
		$author_id = $request->authorId;

		$filtered_products = Product::where('author_id', $author_id)
		                             ->where('genre_id', $genre_id)
		                             ->orderBy('created_at', 'desc')
		                             ->with('image')
		                             ->get();
		return $filtered_products;
	}

	public function getProductsOfCategory($id) {
		$products_of_category = Product::where('category_id', $id)
		                            ->orderBy('created_at', 'desc')
		                            ->with('image')
		                            ->get();
		return $products_of_category;
	}
}
