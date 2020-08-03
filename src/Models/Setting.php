<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	public function get_the($name) {

				$field = $this->where('name',$name)->first();
				if(isset($field)){
					return $field->content;
				}
				else {
					return '';
				}
	}
}
