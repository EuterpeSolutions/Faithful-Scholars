<?php
include('./MailChimp.php');

$MailChimp = new MailChimp('api-key-goes-here');

//Subscribe someone to a list (with a post to the lists/{listID}/members method):
$list_id = 'list-id-goes-here';

$result = $MailChimp->post("lists/$list_id/members", [
				'email_address' => 'davy@example.com',
				'status'        => 'subscribed',
			]);

print_r($result);

?>
