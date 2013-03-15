<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(sprintf(Flux::message('VoteHeading'), $server->serverName)) ?></h2>
<?php if (!empty($errorMessage)): ?>
	<p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php elseif (!empty($successMessage)): ?>
	<p class="green"><?php echo htmlspecialchars($successMessage) ?></p>
<?php endif ?>
<form action="<?php echo $this->urlWithQs ?>" method="post" class="generic-form">
	<table class="horizontal-table vote-table">
		<tr>
			<th>Voting Site</td>
			<th>Points</th>
			<th>Vote Time Interval</th>
			<th>Time Left</th>
		</tr>
		<?php foreach ($votesites_res as $row): ?>
		<tr>
			<td style="text-align:center">
				<button type="submit" <?php echo (isVoted($row->id, $server) !== FALSE ? "disabled='disabled' ": "") ?>value="<?= (int) $row->id ?>" name="id" class="vote-button" style="background:none;border:none;<?php echo (isVoted($row->id, $server) !== FALSE ? "cursor:not-allowed;": "cursor:pointer;") ?>">
					<img <?php echo (isVoted($row->id, $server) !== FALSE ? "style='opacity:0.3;filter:alpha(opacity=30)' ": "") ?>title='<?= htmlspecialchars($row->votename) ?>' src="<?php echo (is_null($row->imgurl) ? $this->themePath('img/').Flux::config('ImageUploadPath').'/'.$row->imgname : $row->imgurl) ?>" />
				</button>
			</td>
			<td style="text-align:center"><?= number_format($row->votepoints) ?></td>
			<td style="text-align:center"><?php echo $row->voteinterval." ".((int) $row->voteinterval > 1 ? "Hours" : "Hour") ?></td>
			<td style="text-align:center"><?php echo (isVoted($row->id, $server) !== FALSE ? getTimeLeft(isVoted($row->id, $server)) : Flux::message('VoteNow')) ?></td>
		</tr>
		<?php endforeach ?>
	</table>
</form>
<script type="text/javascript">
	$(function() {
		$('.vote-button').click(function() {
			var id = $(this).val();
			var vote_sites = new Array();

			<?php foreach ($votesites_res as $row): ?>
				vote_sites[<?= $row->id ?>] = "<?= htmlspecialchars($row->voteurl) ?>";
			<?php endforeach ?>

			window.open(vote_sites[id]);
		});
	});
</script>