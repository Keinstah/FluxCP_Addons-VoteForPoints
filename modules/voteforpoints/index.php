<?php if (!defined('FLUX_ROOT')) exit;

$this->loginRequired();

require_once("function.php");
$vfp_sites		= Flux::config('FluxTables.vfp_sites');
$vfp_logs		= Flux::config('FluxTables.vfp_logs');
$errorMessage	= NULL;

if (isset($_POST['id']))
{
	$id 		= (int) $params->get('id');
	$ip 		= $_SERVER['REMOTE_ADDR'];
	$account_id = (int) $session->account->account_id;

	$sql = "SELECT * FROM $server->loginDatabase.$vfp_sites WHERE id = ?";
	$sth = $server->connection->getStatement($sql);
	$sth->execute(array($id));
	$res = $sth->fetch();

	// voting site doesn't exists
	if ($sth->rowCount() === 0)
	{
		$errorMessage = Flux::message("VoteDontExists");
	} else

	// voter is using invalid ip
	if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]) || !empty($_SERVER['HTTP_CLIENT_IP']) || !empty($_SERVER['HTTP_X_FORWARDED']))
	{
		$errorMessage = sprintf(Flux::message("UnableToVote"), 1);
	} else {
		// validate for ip address
		if (Flux::config('EnableIPVoteCheck'))
		{
			$sql = "SELECT timestamp_expire FROM $server->loginDatabase.$vfp_logs WHERE ipaddress = ? AND sites_id = ? AND UNIX_TIMESTAMP(timestamp_expire) > ? LIMIT 1";
			$sth = $server->connection->getStatement($sql);
			$bind = array($ip, $id, time());
			$sth->execute($bind);

			if ($sth->rowCount() === 1) $errorMessage = Flux::message("AlreadyVoted");
		}

		// validate for account_id
		if (is_null($errorMessage))
		{
			$sql = "SELECT timestamp_expire FROM $server->loginDatabase.$vfp_logs WHERE account_id = ? AND sites_id = ? AND UNIX_TIMESTAMP(timestamp_expire) > ? LIMIT 1";
			$sth = $server->connection->getStatement($sql);
			$bind = array($account_id, $id, time());
			$sth->execute($bind);

			if ($sth->rowCount() === 1) 
			{
				$errorMessage = Flux::message("AlreadyVoted");
			} else {
				// update the existing row
				$sql = "UPDATE $server->loginDatabase.$vfp_logs SET timestamp_expire = ?, timestamp_voted = ?, ipaddress = ? WHERE account_id = ? AND sites_id = ?";
				$sth = $server->connection->getStatement($sql);
				$bind = array(
					date(Flux::config("DateTimeFormat"), strtotime("+".$res->voteinterval." hours")),
					date(Flux::config("DateTimeFormat")),
					$ip,
					$account_id,
					$id
				);
				$sth->execute($bind);

				if ($sth->rowCount() === 0)
				{
					// insert new row
					$sql = "INSERT INTO $server->loginDatabase.$vfp_logs VALUES (NULL, ?, ?, ?, ?, ?)";
					$sth = $server->connection->getStatement($sql);
					$bind = array(
						$id,
						date(Flux::config("DateTimeFormat"), strtotime("+".$res->voteinterval." hours")),
						date(Flux::config("DateTimeFormat")),
						$ip,
						$account_id
					);
					$sth->execute($bind);

					if ($sth->rowCount() === 0)
					{
						$errorMessage = sprintf(Flux::message("UnableToVote"), 2);
					} else {

						// don't use the credits for vote points
						if (!Flux::config('UseCreditsForPoints'))
						{
							// update votepoints
							$sql = "UPDATE $server->loginDatabase.cp_createlog SET votepoints = votepoints + ? WHERE account_id = ?";
							$sth = $server->connection->getStatement($sql);
							$sth->execute(array((int) $res->votepoints, $account_id));

							if ($sth->rowCount() === 0)
							{
								$errorMessage = sprintf(Flux::message("UnableToVote"), 3);
							}
						} else {

							// update credits row
							$sql = "UPDATE $server->loginDatabase.cp_credits SET balance = balance + ? WHERE account_id = ?";
							$sth = $server->connection->getStatement($sql);
							$sth->execute(array((int) $res->votepoints, $account_id));

							if ($sth->rowCount() === 0)
							{
								// insert new credits row
								$sql = "INSERT INTO $server->loginDatabase.cp_credits VALUES (?, ?, NULL, NULL)";
								$sth = $server->connection->getStatement($sql);
								$sth->execute(array($account, $res->votepoints));

								if ($sth->rowCount() === 0)
								{
									$errorMessage = sprintf(Flux::message("UnableToVote"), 4);
								}
							}
						}
					}
				}
			}
		}
	}
}

// fetch all voting sites
$sql = "SELECT * FROM $server->loginDatabase.$vfp_sites";
$sth = $server->connection->getStatement($sql);
$sth->execute();
$votesites_res = $sth->fetchAll();

?>