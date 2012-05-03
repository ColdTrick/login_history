<?php

	elgg_register_event_handler('init', 'system', 'login_history_init');

	function login_history_init() {
		elgg_register_admin_menu_item('administer', 'login_history', 'users', 600);

		elgg_extend_view('core/settings/statistics', 'login_history/settings/statistics/login_history');
	}