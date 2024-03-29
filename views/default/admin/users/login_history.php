<?php
/**
 * Elgg log browser admin page
 *
 * @note The ElggObject this creates for each entry is temporary
 * 
 * @package ElggLogBrowser
 */

$limit = get_input('limit', 20);
$offset = get_input('offset');

$search_username = get_input('search_username');
if ($search_username) {
	$user = get_user_by_username($search_username);
	if ($user) {
		$user_guid = $user->guid;
	}
} else {
	$user_guid = get_input('user_guid', null);
	if ($user_guid) {
		$user_guid = (int) $user_guid;
	} else {
		$user_guid = null;
	}
}

$timelower = get_input('timelower');
if ($timelower) {
	$timelower = strtotime($timelower);
}

$timeupper = get_input('timeupper');
if ($timeupper) {
	$timeupper = strtotime($timeupper);
}

$ip_address = get_input('ip_address');

$refine = elgg_view('logbrowser/refine', array(
	'user_guid' => $user_guid,
	'timeupper' => $timeupper,
	'timelower' => $timelower,
));

// Get log entries
$log = get_system_log($user_guid, "login", "", "","", $limit, $offset, false, $timeupper, $timelower,
		0, $ip_address);
$count = get_system_log($user_guid, "login", "", "","", $limit, $offset, true, $timeupper, $timelower,
		0, $ip_address);

$table = elgg_view('login_history/table', array('log_entries' => $log));

$nav = elgg_view('navigation/pagination',array(
	'offset' => $offset,
	'count' => $count,
	'limit' => $limit,
));

// display admin body
$body = <<<__HTML
$refine
$nav
$table
$nav
__HTML;

echo $body;
