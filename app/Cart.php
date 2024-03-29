<?php

namespace App;

use Illuminate\Support\Facades\Session;

class Cart
{
	public $items = null;
	public $totalQuantity = 0;
	public $totalPrice = 0;

	public function __construct($oldCart) {
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQuantity = $oldCart->totalQuantity;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id) {
		$storedItem = ['quantity' => 0, 'price' => $item->price, 'item' => $item];

		if($this->items){
			if(array_key_exists($id, $this->items)){
				$storedItem = $this->items[$id];
			}
		}

		$storedItem['quantity']++;
		$storedItem['price'] = $item->price * $storedItem['quantity'];
		$this->items[$id] = $storedItem;
		$this->totalQuantity++;
		$this->totalPrice += $item->price;
	}

	public function delete($product, $id) {
		if(array_key_exists($id, $this->items)){
			$quantity = $this->items[$id]['quantity'];
			unset($this->items[$id]);
		}

		$this->totalQuantity -= $quantity;

		$this->totalPrice -= ($product->price * $quantity);

		if($this->totalQuantity < 1){
			Session::forget('cart');
		}
	}

	public function decrease($product, $id) {
		if(array_key_exists($id, $this->items)){
			$this->items[$id]['quantity']--;

			if($this->items[$id]['quantity'] <= 0){
				unset($this->items[$id]);
			}
		}

		$this->totalQuantity--;
		$this->totalPrice -= $product->price;

		if($this->totalQuantity < 1){
			Session::forget('cart');
		}
	}
}