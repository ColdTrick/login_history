<?php
/**
 * Elgg statistics screen showing online users.
 *
 * @package Elgg
 * @subpackage Core
 */

$user = elgg_get_page_owner_entity();

$log = get_system_log($user->guid, "login", "", 'user', '', 20);


?>
<div class="elgg-module elgg-module-info">
	<div class="elgg-head">
		<h3><?php echo elgg_echo('login_history:statistics:history'); ?></h3>
	</div>
	<div class="elgg-body">
		<table class="elgg-table-alt">
			<thead>
				<tr>
					<th><?php echo elgg_echo('logbrowser:ip_address'); ?></th>
					<th><?php echo elgg_echo('logbrowser:date'); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			if($log) {
				foreach($log as $entry) {
					if ($entry->ip_address) {
						$ip_address = $entry->ip_address;
					} else {
						$ip_address = '&nbsp;';
					}
				?>
				<tr class="odd">
					<td class="column-one"><?php echo $ip_address; ?></td>
					<td><?php echo date('r', $entry->time_created); ?></td>
				</tr>
				<?php 
				}
			}?>
		</tbody>
		</table>
	</div>
</div>