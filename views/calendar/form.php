<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="name">Titre</label>
					<input type="text" required name="name" id="name" class="form-control" value="<?= isset($data['name']) ? h($data['name']) : ''; ?>">
					<?php if(isset($errors['name'])):	?>
						<small class="form-text text-muted"><?= $errors['name']; ?></small>
					<?php endif; ?>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label for="date">Date</label>
					<input type="date" required name="date" id="date" class="form-control" value="<?= isset($data['date']) ? h($data['date']) : ''; ?>">
					<?php if(isset($errors['date'])):	?>
						<small class="form-text text-muted"><?= $errors['date']; ?></small>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="start">Démarrage</label>
					<input type="time" required name="start" id="start" class="form-control" placeholder="HH:MM" value="<?= isset($data['start']) ? h($data['start']) : ''; ?>">
					<?php if(isset($errors['start'])):	?>
						<small class="form-text text-muted"><?= $errors['start']; ?></small>
					<?php endif; ?>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label for="end">Fin</label>
					<input type="time" required name="end" id="end" class="form-control" placeholder="HH:MM" value="<?= isset($data['end']) ? h($data['end']) : ''; ?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="description"></label>
			<textarea id="description" name="description" class="form-control"><?= isset($data['description']) ? h($data['description']) : ''; ?></textarea>
		</div>