<?php

namespace Calendar;

require_once ('Event.php');

class Events extends Event{

	private $pdo;

	public function __construct(\PDO $pdo){
		$this->pdo = $pdo;
	}

	// return array, recupére les evenement entre deux date
	public function getEventsBetween(\DateTime $start, \DateTime $end){
		$sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ORDER BY start ASC";
		$statement = $this->pdo->query($sql);
		$results = $statement->fetchAll();
		return $results;
	}


	// return array, recupére les evenement entre deux date!! indexer par jour
	public function getEventsBetweenByDay(\DateTime $start, \DateTime $end){
		$events = $this->getEventsBetween($start, $end);
		$days= [];
		foreach ($events as $event) {
			$date = explode(' ', $event['start'])[0];
			if(!isset($days[$date])){
				$days[$date] = [$event];
			}else{
				$days[$date][]= $event;
			}
		}
		return $days;
	}

	// recupére un événement
	public function find(int $id){
		require_once ('Event.php');
		$statement = $this->pdo->query('SELECT * FROM events WHERE id = '.$id.' LIMIT 1');
		$statement->setFetchMode(\PDO::FETCH_CLASS,Event::class);
		$result = $statement->fetch();
		if($result === false){
			throw new \Exception("Aucun résultat n\a été trouvé", 1);
		}
		return $result;
	}

	// cree un evenment dans la base de donne 
	public function create($event){
		$statement = $this->pdo->prepare('INSERT INTO events (name, description, start, end)  VALUES (?,?,?,?)');
		return $statement->execute([
			$event->getName(),
			$event->getDescription(),
			$event->getStart()->format('Y-m-d H:i:s'),
			$event->getEnd()->format('Y-m-d H:i:s'),
		]);
	}


	// Met un jour un événement de la base de donne 
	public function update($event){
		$statement = $this->pdo->prepare('UPDATE events SET name = ?, description = ?, start = ?, end = ? WHERE id = ?');
		return $statement->execute([
			$event->getName(),
			$event->getDescription(),
			$event->getStart()->format('Y-m-d H:i:s'),
			$event->getEnd()->format('Y-m-d H:i:s'),
			$event->getId(),
		]);
	}

}