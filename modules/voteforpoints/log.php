<?php if (!defined('FLUX_ROOT')) exit;

$this->loginRequired();

require_once("function.php");
$vfp_sites		= Flux::config('FluxTables.vfp_sites');
$vfp_logs		= Flux::config('FluxTables.vfp_logs');
$errorMessage	= NULL;

if (isset($_POST['delete']))
{
	$id = (int) $params->get('delete');

	$sth = $server->connection->getStatement("DELETE FROM $vfp_logs WHERE id = ?");
	$sth->execute(array($id));

	$successMessage = Flux::message('VotersLogDeleted');
}

if (isset($_POST['delete_all']))
{
	$sth = $server->connection->getStatement("TRUNCATE $vfp_logs");
	$sth->execute();

	if ($sth->rowCount())
		$successMessage = Flux::message('VotersLogAllDeleted');
	else
		$errorMessage = Flux::message('VotersLogAllDeleteFail');
}

// get list
$sth = $server->connection->getStatement("SELECT COUNT(id) AS total FROM $vfp_logs");
$sth->execute();

$paginator = $this->getPaginator($sth->fetch()->total);
$paginator->setSortableColumns(array('timestamp_voted', 'DESC'));

$sql  = $paginator->getSQL("SELECT * FROM $vfp_logs");
$sth  = $server->connection->getStatement($sql);
$sth->execute();
$votersLog = $sth->fetchAll();

?>