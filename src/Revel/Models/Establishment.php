<?php namespace Revel\Models;

/**
 * An establishment.
 *
 * @property-read int $id
 * @property-read string $title
 * @property-read string $name
 * @property-read string $email
 * @property-read string $phone
 * @property-read bool $active
 *
 * @author Marty Wallace
 */
class Establishment extends Model {

	protected function fields() {
		return [
			'id' => $this->raw('id'),
			'title' => $this->raw('about_title'),
			'name' => $this->raw('name'),
			'email' => $this->raw('email'),
			'phone' => $this->raw('phone'),
			'active' => $this->raw('active', false)
		];
	}

	/**
	 * @return Category[]
	 */
	public function categories() {
		return array_values(array_filter($this->revel->categories()->all(), function(Category $category) {
			return $category->establishment()->id === $this->id;
		}));
	}

	/**
	 * @return Product[]
	 */
	public function products() {
		return array_values(array_filter($this->revel->products()->all(), function(Product $product) {
			return $product->establishment()->id === $this->id;
		}));
	}

}