<?php

class product extends pdocrudhandler
{
	public function getProducts ($category_id = 0) {
		
		if ($category_id != 0) {

			return $this->select('products', ['*'], 'where category_id = ?', [$category_id]);	
		}

		return $this->select('products', ['*']);
	}

	public function getProductById ($params = []) {

		$product_id = $params['product_id'];
		return $this->select('products', ['*'], 'where id = ?', [$product_id]);
	}

}


?>