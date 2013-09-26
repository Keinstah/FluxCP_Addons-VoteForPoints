<?php if (!defined('FLUX_ROOT')) exit;
return array(
	'modules' => array(
		'voteforpoints' => array(
			'index' => AccountLevel::NORMAL,
			'add' => AccountLevel::ADMIN,
			'list' => AccountLevel::ADMIN,
			'log' => AccountLevel::ADMIN,
		)
	)
);
?>