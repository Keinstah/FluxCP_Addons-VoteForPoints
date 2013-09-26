<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(sprintf(Flux::message('VoteHeading'), $server->serverName)) ?></h2>
<p class='message'><?php echo htmlspecialchars(Flux::message("VoteNotice")) ?></p>
<?php if (!empty($errorMessage)): ?>
	<p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php elseif (!empty($successMessage)): ?>
	<p class="green"><?php echo htmlspecialchars($successMessage) ?></p>
<?php endif ?>

<?php if (Flux::config('PointsType') == 'cash'): ?>
	<p><?php echo sprintf(Flux::message('CurrentCashPoints'), number_format(getCashPoints($session->account->account_id, $server))) ?></p>
<?php endif ?>

<?php if (count($votesites_res) !== 0): ?>
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
				<button type="submit" <?php echo (isVoted($row->id, $server) !== FALSE ? "disabled='disabled' ": "") ?>value="<?php echo (int) $row->id ?>" name="id" class="vote-button" style="background:none;border:none;<?php echo (isVoted($row->id, $server) !== FALSE ? "cursor:not-allowed;": "cursor:pointer;") ?>">
					<img <?php echo (isVoted($row->id, $server) !== FALSE ? "style='opacity:0.3;filter:alpha(opacity=30)' ": "") ?>title='<?php echo htmlspecialchars($row->votename) ?>' src="<?php echo (is_null($row->imgurl) ? $this->themePath('img/').Flux::config('ImageUploadPath').'/'.$row->imgname : $row->imgurl) ?>" />
				</button>
			</td>
			<td style="text-align:center"><?php echo number_format($row->votepoints) ?></td>
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
				vote_sites[<?php echo $row->id ?>] = "<?php echo htmlspecialchars($row->voteurl) ?>";
			<?php endforeach ?>

			window.open(vote_sites[id]);
		});
	});
</script>
<?php else: ?>
	<p class='red'><?php echo htmlspecialchars(Flux::message("NoVotingSiteYet2")) ?></p>
<?php endif ?>