<?php
if ( !defined( '_CONFIG' ) ) {
	define('_CONFIG', 1);
	$db_type              = 'mysql';
	$hostname             = 'localhost';
	$login                = 'root';
	$pass                 = '';
	$database             = 'phpMyNewsletter2';
	$type_serveur         = 'dedicated';
	$type_env             = 'prod';
	$timezone             = 'Europe/Paris';
	$nb_backup            = '5';
	$prefix               = 'pmn2_';
	$code_mailtester      = '';
	$key_dkim             = '';
	$timer_ajax           = 10;
	$timer_cron           = 4;
	$end_task             = 0;
	$loader               = 0;
	$menu                 = 'hz';
	$free_id              = '';
	$free_pass            = '';
	$end_task_sms         = 0;
	$sub_validation_sms   = 0;
	$unsub_validation_sms = 0;
	$alert_unsub          = 1;
	$table_global_config  = 'pmn2_config';
	$exec_available       = true;
	$pmnl_version         = '2.0.5';
}