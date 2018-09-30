<?php

namespace Calendar;

require 'Validator.php';

class EventValidator extends Validator{

	// retour un tableaux ou un boolean
	public function validates(array $data){
		parent::validates($data);
		$this->validate('name', 'minLength', 3);
		$this->validate('date', 'date');
		$this->validate('start', 'beforeTime', 'end');
		return $this->errors;
	}
}