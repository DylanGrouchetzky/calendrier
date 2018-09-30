<?php 
require '../src/bootstrap.php';
require '../src/Calendar/Event.php';
require '../src/Calendar/events.php';
require '../src/Calendar/EventValidator.php';
$pdo = get_pdo();
$events = new Calendar\Events($pdo);
$errors = [];
if(!isset($_GET['id'])){
	e404();
}
try{
	$event = $events->find($_GET['id']);
}catch(\Exception $e){
		e404();
}
$data = [
	'name' => $event->getName(),
	'date' => $event->getStart()->format('Y-m-d'),
	'start' => $event->getStart()->format('H:i'),
	'end' => $event->getEnd()->format('H:i'),
	'description' =>$event->getDescription(),
];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$data = $_POST;
	$validator = new Calendar\EventValidator();
	$errors = $validator->validates($data);
	if(empty($errors)){
		$event->setName($data['name']);
		$event->setDescription($data['description']);
		$event->setStart(DateTime::createFromFormat('Y-m-d H:i', $data['date'].' '.$data['start'])->format('Y-m-d H:i:s'));
		$event->setEnd(DateTime::createFromFormat('Y-m-d H:i', $data['date'].' '.$data['end'])->format('Y-m-d H:i:s'));
		$events->update($event);
		header('Location: index.php?success=1');
		exit();
	}
}

render('header', ['title' => $event->getName()]);
?>

<div class="container">
	<h1>Edité l'évènement <small><?= h($event->getName()); ?></small></h1>

	<form action="" method="post" class="form">
		<?php render ('calendar/form',['data' => $data, 'errors' => $errors]); ?>
		<div class="form-group">
			<button class="btn btn-primary">Modifier l'évènement</button>
		</div>
	</form>
</div>

<?php render('footer'); ?>