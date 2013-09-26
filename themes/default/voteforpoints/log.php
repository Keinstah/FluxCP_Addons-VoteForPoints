<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('VotersLogHeading')) ?></h2>
<?php if (!empty($errorMessage)): ?>
	<p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php elseif (!empty($successMessage)): ?>
	<p class="green"><?php echo htmlspecialchars($successMessage) ?></p>
<?php endif ?>

<?php if (count($votersLog) === 0): ?>
	<p class='message'><?php echo Flux::message('NoOneHasVotedYet') ?></p>
<?php else: ?>
	<form action='<?php echo $this->urlWithQs ?>' method='POST'>
		<input type='submit' name='delete_all' onclick="return confirm('Are you sure about this?')" value='Delete All'>
	<?php echo $paginator->infoText()  ?>
	<table class='horizontal-table'>
		<thead>
			<tr>
				<th>#</th>
				<th>Site ID</th>
				<th>Account ID</th>
				<th>IP Address</th>
				<th>Timestamp Voted</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($votersLog as $row): ?>
			<tr>
				<td><?php echo $row->id ?></td>
				<td><?php echo $row->sites_id ?></td>
				<td><?php echo $this->linkToAccountSearch(array('id' => $row->account_id), $row->account_id) ?></td>
				<td><?php echo $row->ipaddress ?></td>
				<td><?php echo $row->timestamp_voted ?></td>
				<td><button name='delete' onclick="return confirm('Are you sure about this?')" value='<?php echo (int) $row->id ?>'>Delete</button></td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	</form>
	<?php echo $paginator->getHTML()  ?>
<?php endif ?>