<?php
/**
 * Log browser table
 *
 * @package ElggLogBrowser
 */

$log_entries = $vars['log_entries'];
?>

<table class="elgg-table">
	<tr>
		<th><?php echo elgg_echo('logbrowser:id'); ?></th>
		<th><?php echo elgg_echo('logbrowser:date'); ?></th>
		<th><?php echo elgg_echo('logbrowser:ip_address'); ?></th>
		<th><?php echo elgg_echo('logbrowser:user:name'); ?></th>
		<th><?php echo elgg_echo('logbrowser:user:guid'); ?></th>
	</tr>
<?php
	$alt = '';
	foreach ($log_entries as $entry) {
		if ($entry->ip_address) {
			$ip_address = $entry->ip_address;
		} else {
			$ip_address = '&nbsp;';
		}

		$user_link = '';
		$user_guid_link = '';
		
		$user = get_entity($entry->performed_by_guid);
		if ($user) {
			$user_link = elgg_view('output/url', array(
				'href' => $user->getURL(),
				'text' => $user->name,
				'is_trusted' => true,
			));
			$user_guid_link = elgg_view('output/url', array(
				'href' => "admin/overview/logbrowser?user_guid=$user->guid",
				'text' => $user->getGUID(),
				'is_trusted' => true,
			));
		} else {
			$user_guid_link = $entry->performed_by_guid;
		}

		$object = get_object_from_log_entry($entry->id);
		if (is_callable(array($object, 'getURL'))) {
			$object_link = elgg_view('output/url', array(
				'href' => $object->getURL(),
				'text' => $entry->object_class,
				'is_trusted' => true,
			));
		} else {
			$object_link = $entry->object_class;
		}
?>
	<tr <?php echo $alt; ?>>
		<td class="log-entry-id">
			<?php echo $entry->id; ?>
		</td>
		<td class="log-entry-time">
			<?php echo date('r', $entry->time_created); ?>
		</td>
		<td class="log-entry-ip-address">
			<?php echo $ip_address; ?>
		</td>
		<td class="log-entry-user">
			<?php echo $user_link; ?>
		</td>
		<td class="log-entry-guid">
			<?php echo $user_guid_link; ?>
		</td>
	</tr>
<?php

		$alt = $alt ? '' : 'class="alt"';
	}
?>
</table>