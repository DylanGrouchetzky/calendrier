<?php

namespace Calendar;

class Month{

	public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
	private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	public $month;
	public $year;

	//$month Le mois compris entre 1 et 12;
	//$year L'anné
	public function __construct($month=null, $year=null){
		if ($month === null || $month < 1 || $month > 12){
			$month = intval(date('m'));
		}
		if($year === null){
			$year = intval(date('Y'));
		}
		$this->month = $month;
		$this->year = $year;
	}

	// Return un DateTime; renvoi le 1er jour du mois
	public function getStartingDay(){
		return new \DateTime("{$this->year}-{$this->month}-01");
	}

	// Return le moi sen toute lettre ex:Mars 2018
	public function toString(){
		return $this->months[$this->month - 1]. ' ' . $this->year;
	}

	// Return un entier; renvoi le nombre de semain dans le mois 
	public function getWeeks(){
		$start = $this->getStartingDay();
		$end = (clone $start)->modify('+1 month -1 day ');
		$startWeek = intval($start->format('W'));
		$endWeek = intval($end->format('W'));
		if($endWeek === 1){
			$endWeek = intval((clone $end)->modify('- 7 days')->format('W')) + 1;
		}
		$weeks =  $endWeek - $startWeek + 1;
		if($weeks < 0){
			$weeks = intval($end->format('W'));
		}
		return $weeks;
	}

	// es ce que le jour est dans le mois en cours
	public function withinMonth(\DateTime $date){
		return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
	}

	// renvoi le mois suivant
	public function nextMonth(){
		$month = $this->month + 1;
		$year = $this->year;
		if($month > 12){
			$month = 1;
			$year += 1;
		}

		return new Month($month, $year);
	}

	// renvoi le mois précent
	public function previousMonth(){
		$month = $this->month - 1;
		$year = $this->year;
		if($month < 1){
			$month = 12;
			$year -= 1;
		}

		return new Month($month, $year);
	}
}