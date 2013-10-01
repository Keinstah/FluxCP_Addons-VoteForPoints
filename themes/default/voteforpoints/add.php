<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(sprintf(Flux::message('AddVoteHeading'), $server->serverName)) ?></h2>
<?php if (!empty($errorMessage)): ?>
	<p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php elseif (!empty($successMessage)): ?>
	<p class="green"><?php echo htmlspecialchars($successMessage) ?></p>
<?php endif ?>
<form action="<?php echo $this->urlWithQs ?>" method="post" class="generic-form" enctype="multipart/form-data">
	<table class="generic-form-table">
		<tr>
			<th><label for="votename"><?php echo htmlspecialchars(Flux::message('VoteNameLabel')) ?></label></th>
			<td><input type="text" name="votename" id="votename" value="<?php echo htmlspecialchars($params->get('votename')) ?>" /></td>
		</tr>
		<tr>
			<th><label for="voteurl"><?php echo htmlspecialchars(Flux::message('VoteUrlLabel')) ?></label></th>
			<td><input type="text" name="voteurl" id="voteurl" value="<?php echo htmlspecialchars($params->get('voteurl')) ?>" /> <span><?php echo htmlspecialchars(Flux::message('VoteUrlNote')) ?></span></td>
		</tr>
		<tr>
			<th><label for="voteinterval"><?php echo htmlspecialchars(Flux::message('VoteIntervalLabel')) ?></label></th>
			<td><input type="number" name="voteinterval" id="voteinterval" value="<?php echo ((int)$params->get('voteinterval') === 0 ? Flux::config('DefaultIntervalVoting') : htmlspecialchars($params->get('voteinterval'))) ?>" /> <span><?php echo htmlspecialchars(Flux::message('VoteIntervalNote')) ?></span></td>
		</tr>
		<tr>
			<th><label for="votepoints">Reward <?php echo htmlspecialchars(Flux::message('VotePointsLabel').'/'.Flux::message('CashPointsLabel')) ?>/Amount</label></th>
			<td><input type="number" name="votepoints" id="votepoints" value="<?php echo ((int)$params->get('votepoints') === 0 ? Flux::config('DefaultVotePoints') : htmlspecialchars($params->get('votepoints'))) ?>" /></td>
		</tr>
		<tr>
			<th><label for="imageurl"><?php echo htmlspecialchars(Flux::message('ImageUrlLabel')) ?></label></th>
			<td><input type="text" name="imageurl" placeholder="optional" id="imageurl" value="<?php echo htmlspecialchars($params->get('imageurl')) ?>" /> <span><?php echo htmlspecialchars(Flux::message('ImageUrlNote')) ?></span></td>
		</tr>
		<tr>
			<th><label for="uploadimg"><?php echo htmlspecialchars(Flux::message('UploadImageLabel')) ?></label></th>
			<td><input type="file" name="uploadimg" id="uploadimg"> <span><?php echo htmlspecialchars(Flux::message('UploadImageNote')) ?></span></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" value="<?php echo htmlspecialchars(Flux::message('VoteAddButton')) ?>" />
			</td>
		</tr>
	</table>
</form>