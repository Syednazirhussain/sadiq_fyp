<?php

class category extends pdocrudhandler
{
	public function getNavCategories ($total = 0, $category_ids = []) {
		if (!empty($category_ids)) {

			$ids = implode(',', $category_ids);
			$query = 'select * from category where id in ('.$ids.') ';
			if ($total != 0) {
				$query .= ' limit '.$total;
			}

			return $this->customSelect($query);
		}

		if ($total != 0) {

			return $this->customSelect('select * from category limit '.$total);
		}

		return $this->select('category', ['*']);
	}

	public function getParentCategories ($parent_id = 0) {
		
		return $this->select('category', ['*'], 'where parent_id = ?', [$parent_id]);	
	}
}


?>