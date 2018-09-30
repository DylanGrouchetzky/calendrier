<?php

namespace Calendar;

class Validator{

	private $data;
	protected $errors = [];

	public function validates(array $data){
		$this->errors = [];
		$this->data = $data;
	}

	public function validate($field, $method, ...$parameters){
		if(!isset($this->data[$field])){
			$this->errors[$field] = "Le champ ".$field." n'est pas remplit";
		}else{
			call_user_func([$this, $method], $field, ...$parameters);
		}
	}

	public function minLength($field, $length){
		if(mb_strlen($field) < $length){
			$this->errors[$field] = "Le champ doit avoir plus de ".$length. " caractères";
			return false;
		}
		return true;
	}

	public function date($field){
		if (\DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false){
			$this->errors[$field] = "La date ne semble pas valide";
			return false;
		}
		return true;
	}

	public function time($field){
		if (\DateTime::createFromFormat('H:i', $this->data[$field]) === false){
			$this->errors[$field] = "La temps ne semble pas valide";
			return false;
		}
		return true;
	}

	public function beforeTime($startField, $endField){
		if($this->time($startField)  && $this->time($endField)){
			$start = \DateTime::createFromFormat('H:i', $this->data[$startField]);
			$end = \DateTime::createFromFormat('H:i', $this->data[$endField]);
			if($start->getTimestamp() > $end->getTimestamp()){
				$this->errors[$startField] = "Le temps doit être inférieur au temps de fin";
				return false;
			}
			return true;
		}
		return true;
	}
}