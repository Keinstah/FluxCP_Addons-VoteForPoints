<?php if (!defined('FLUX_ROOT')) exit;

$this->loginRequired();
$vfp_sites		= Flux::config('FluxTables.vfp_sites');
$vfp_logs		= Flux::config('FluxTables.vfp_logs');
$errorMessage	= NULL;

// delete voting site
if (isset($_POST['id']))
{
	$id = (int) $params->get('id');

	$sql = "DELETE FROM $server->loginDatabase.$vfp_sites WHERE id = ?";
	$sth = $server->connection->getStatement($sql);
	$sth->execute(array($id));

	if ( ! $sth->rowCount())
		$errorMessage = Flux::message("VoteSiteDeleteFailed");
	

	$sql = "DELETE FROM $server->loginDatabase.$vfp_logs WHERE sites_id = ?";
	$sth = $server->connection->getStatement($sql);
	$sth->execute(array($id));

	if (is_null($errorMessage))
		$successMessage = Flux::message("VoteSiteDeleteSuccess");
}

// fetch all voting sites
$sql = "SELECT * FROM $server->loginDatabase.$vfp_sites";
$sth = $server->connection->getStatement($sql);
$sth->execute();
$votesites_res = $sth->fetchAll();

?>