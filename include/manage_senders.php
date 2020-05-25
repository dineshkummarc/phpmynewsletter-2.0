<?php
echo "<header><h4>".tr("SENDERS_MANAGEMENT")."</h4></header>";
switch($viewms){
	case 'manage':
		if(empty($account)) {
			echo '<div class="row"><div class="col-md-12">
			<div class="alert alert-danger">Erreur sur le choix du compte à modifier.</div>
			</div></div>';
		} else {
			if(!$row=getOneSenderFull($cnx,$row_config_globale['table_senders'],$account)) {
				echo '<div class="row"><div class="col-md-12">
				<div class="alert alert-danger">Erreur sur recherche du compte à modifier : <b>'.$account.'</b></div>
				</div></div>';
			} else {
				echo '<div class="row" style="margin-bottom:9px;"><div class="col-md-12">
				<ul class="nav navbar-nav navbar-left"><li>
				<button class="btn btn-primary">
				<a href="?page=manage_senders&token=' . $token . '&list_id=' . $list_id 
					.'&viewms=list" data-toggle="tooltip" title="Afficher la liste des comptes émetteurs de mails"><i class="glyphicon glyphicon-list"></i> Liste des émetteurs</a>
				</button>
				</li><li>
				&nbsp;<button class="btn btn-primary">
				<a href="?page=manage_senders&token=' . $token . '&list_id=' . $list_id 
					.'&viewms=add" data-toggle="tooltip" title="Ajouter et paramétrer un compte émetteur de mails"><i class="glyphicon glyphicon-pencil"></i> Ajouter un compte émetteur</a>
				</button>
				</li></ul>
				</div></div>
				<div class="row">
				<div class="col-md-12">
				<h3>Modification d\'un compte émetteur</h3>
				</div>
				<form method="post" name="global_senders" action="" enctype="multipart/form-data">
				<div class="col-md-12">
				<div class="module_content">
				<h4>Paramètres généraux</h4>
				</div>
				<div class="form-group"><label>Nom du compte email</label>
				<input type="text" name="msname" class="form-control" value="'.$row[0]['id_sender'].'" readonly></div>
				<div class="form-group"><label>Nom / société / organisation</label>
				<input type="text" name="msorg" class="form-control" value="'.$row[0]['name_organisation'].'"></div>
				<div class="form-group"><label>Adresse email</label>
				<input type="text" name="msmail" class="form-control" value="'.$row[0]['email'].'"></div>
				<div class="form-group"><label>Adresse mail de réponse</label>
				<input type="text" name="msreply" class="form-control" value="'.$row[0]['email_reply'].'"></div>
				<h4>Paramètres du serveur SMTP</h4>
				<div class="form-group"><label>Serveur de messagerie sortant</label>
				<input type="text" name="mssmtp" class="form-control" value="'.$row[0]['smtp'].'"></div>
				<div class="row"><div class="col-md-6"><div class="form-group"><label>Port de connexion</label>
				<input type="text" name="mssmtpport" class="form-control" value="'.$row[0]['smtp_port'].'"></div></div>
				<div class="col-md-6"><div class="form-group"><label>Option du service : none, tls, notls, ssl, ssl/novalidate-cert. (Défaut : notls) :</label>
				<input type="text" name="mssmtpoption" class="form-control" value="'.$row[0]['smtp_option'].'"></div></div></div>
				<div class="form-group"><label>Le serveur SMTP requiert une authentification</label><br>';
				if($row[0]['smtp_auth']=='N'){
					echo "<input type='radio' name='mssmtpauth' value='N' id='sano' checked='checked'>" . tr("NO") . "&nbsp;
					      <input type='radio' name='mssmtpauth' value='Y' id='sayes'>" . tr("YES");
				}elseif($row[0]['smtp_auth']=='Y'){
					echo "<input type='radio' name='mssmtpauth' value='N' id='sano'>" . tr("NO") . "&nbsp;
					      <input type='radio' name='mssmtpauth' value='Y' id='sayes' checked='checked'>" . tr("YES");
				}
				echo '</div>
				<div id="msauthform">
				<h5>Informations de connexion</h5>
				<div class="col-md-2"></div>
				<div class="col-md-10"><div class="form-group"><label>Identifiant</label>
				<input type="text" name="mssmtpidentifiant" class="form-control idmsauth" value="'.$row[0]['smtp_user'].'"></div></div>
				<div class="col-md-2"></div>
				<div class="col-md-10"><div class="form-group"><label>Mot de passe</label>
				<input type="text" name="mssmtppassword" class="form-control idmsauth" value="'.$row[0]['smtp_password'].'"></div></div>
				</div>
				<script>
				$(document).ready(function () {
					$("#sano").click(function () {
						$(".idmsauth").val("");
						$("#msauthform").hide("");
						
					});
					$("#sayes").click(function () {
						$("#msauthform").show("");
					});
				});
				</script>
				<h4>Paramètres de traitements des mails en bounce (retours mails non délivrés)</h4>
				<div id="msauthform">
				<div class="col-md-2"></div>
				<div class="col-md-10"><div class="form-group"><label>Adresse mail de bounce</label>
				<input type="text" name="msbouncemail" class="form-control" value="'.$row[0]['bounce_email'].'"></div></div>
				<div class="col-md-2"></div>
				<div class="col-md-10"><div class="form-group"><label>Adresse du serveur de bounce</label>
				<input type="text" name="msbounceserveur" class="form-control" value="'.$row[0]['bounce_server'].'"></div></div>
				<div class="col-md-2"></div>
				<div class="col-md-10"><div class="form-group"><label>Identifiant de connexion</label>
				<input type="text" name="msbounceid" class="form-control" value="'.$row[0]['bounce_user'].'"></div></div>
				<div class="col-md-2"></div>
				<div class="col-md-10"><div class="form-group"><label>Mot de passe de connexion</label>
				<input type="text" name="msbouncepass" class="form-control" value="'.$row[0]['bounce_password'].'"></div></div>
				<div class="col-md-2"></div>
				<div class="col-md-5"><div class="form-group"><label>Service (POP3 ou IMAP)</label>
				<input type="text" name="msbounceservice" class="form-control" value="'.$row[0]['bounce_service'].'"></div></div>
				<div class="col-md-5"><div class="form-group"><label>Port de connexion</label>
				<input type="text" name="msbounceport" class="form-control" value="'.$row[0]['bounce_port'].'"></div></div>
				<div class="col-md-2"></div>
				<div class="col-md-10"><div class="form-group"><label>Option du service : none, tls, notls, ssl, ssl/novalidate-cert. (Défaut : notls) :</label>
				<input type="text" name="msbounceoption" class="form-control" value="'.$row[0]['bounce_option'].'"></div></div>
				</div>
				</div>
				<div class="row"><div class="col-md-4"></div>
				<div class="col-md-4"><input type="submit" value="Modifier ce compte" class="form-control btn btn-success" /></div>
				<input type="hidden" name="page" value="manage_senders">
				<input type="hidden" name="viewms" value="list">
				<input type="hidden" name="op" value="modifySender">
				<input type="hidden" name="list_id" value="'.$list_id.'">
				<input type="hidden" name="token" value="'.$token.'">
				<div class="col-md-4"></div></div>
				</form>';
			}
		}
	break;
	
	case 'add':
		echo '<div class="row" style="margin-bottom:9px;"><div class="col-md-12">
		<ul class="nav navbar-nav navbar-left"><li>
		<button class="btn btn-primary">
		<a href="?page=manage_senders&token=' . $token . '&list_id=' . $list_id 
		.'&viewms=list" data-toggle="tooltip" title="Afficher la liste des comptes émetteurs de mails"><i class="glyphicon glyphicon-list"></i> Liste des émetteurs</a>
		</button>
		</li></ul>
		</div></div>
		<div class="row">
		<div class="col-md-12">
		<h3>Ajout et paramètrage d\'un compte émetteur</h3>
		</div>
		<form method="post" name="global_senders" enctype="multipart/form-data">
		<div class="col-md-12">
		<div class="module_content">
		<h4>Paramètres généraux</h4>
		</div>
		<div class="form-group"><label>Nom du compte email</label>
		<input type="text" name="msname" class="form-control"></div>
		<div class="form-group"><label>Nom / société / organisation</label>
		<input type="text" name="msorg" class="form-control"></div>
		<div class="form-group"><label>Adresse email</label>
		<input type="text" name="msmail" class="form-control"></div>
		<div class="form-group"><label>Adresse mail de réponse</label>
		<input type="text" name="msreply" class="form-control"></div>
		<h4>Paramètres du serveur SMTP</h4>
		<div class="form-group"><label>Serveur de messagerie sortant</label>
		<input type="text" name="mssmtp" class="form-control"></div>
		<div class="row"><div class="col-md-6"><div class="form-group"><label>Port de connexion</label>
		<input type="text" name="mssmtpport" class="form-control"></div></div>
		<div class="col-md-6"><div class="form-group"><label>Option du service : none, tls, notls, ssl, ssl/novalidate-cert. (Défaut : notls) :</label>
		<input type="text" name="mssmtpoption" class="form-control"></div></div></div>
		<div class="form-group"><label>Le serveur SMTP requiert une authentification</label><br>';
		if($row_config_globale['smtp_auth']=='0'){
			echo "<input type='radio' name='mssmtpauth' value='N' id='sano' checked='checked'>" . tr("NO") . "&nbsp;
			      <input type='radio' name='mssmtpauth' value='Y' id='sayes'>" . tr("YES");
		}elseif($row_config_globale['end_task']=='1'){
			echo "<input type='radio' name='mssmtpauth' value='N' id='sano'>" . tr("NO") . "&nbsp;
			      <input type='radio' name='mssmtpauth' value='Y' id='sayes' checked='checked'>" . tr("YES");
		}
		echo '</div>
		<div id="msauthform">
		<h5>Informations de connexion</h5>
		<div class="col-md-2"></div>
		<div class="col-md-10"><div class="form-group"><label>Identifiant</label>
		<input type="text" name="mssmtpidentifiant" class="form-control" id="idmsauth"></div></div>
		<div class="col-md-2"></div>
		<div class="col-md-10"><div class="form-group"><label>Mot de passe</label>
		<input type="text" name="mssmtppassword" class="form-control"></div></div>
		</div>
		<script>
		$(document).ready(function () {
			$("#sano").click(function () {
				$("#msauthform").hide("slow");
				$("#idmspass").val("");
				$("#idmsauth").val("");
			});
			$("#sayes").click(function () {
				$("#msauthform").show("slow");
			});
		});
		</script>
		<h4>Paramètres de traitements des mails en bounce (retours mails non délivrés)</h4>
		<div id="msauthform">
		<div class="col-md-2"></div>
		<div class="col-md-10"><div class="form-group"><label>Adresse mail de bounce</label>
		<input type="text" name="msbouncemail" class="form-control" id="idmsauth"></div></div>
		<div class="col-md-2"></div>
		<div class="col-md-10"><div class="form-group"><label>Adresse du serveur de bounce</label>
		<input type="text" name="msbounceserveur" class="form-control"></div></div>
		<div class="col-md-2"></div>
		<div class="col-md-10"><div class="form-group"><label>Identifiant de connexion</label>
		<input type="text" name="msbounceid" class="form-control"></div></div>
		<div class="col-md-2"></div>
		<div class="col-md-10"><div class="form-group"><label>Mot de passe de connexion</label>
		<input type="text" name="msbouncepass" class="form-control"></div></div>
		<div class="col-md-2"></div>
		<div class="col-md-5"><div class="form-group"><label>Service (POP3 ou IMAP)</label>
		<input type="text" name="msbounceservice" class="form-control"></div></div>
		<div class="col-md-5"><div class="form-group"><label>Port de connexion</label>
		<input type="text" name="msbounceport" class="form-control"></div></div>
		<div class="col-md-2"></div>
		<div class="col-md-10"><div class="form-group"><label>Option du service : none, tls, notls, ssl, ssl/novalidate-cert. (Défaut : notls) :</label>
		<input type="text" name="msbounceoption" class="form-control"></div></div>
		</div>
		</div>
		<div class="row"><div class="col-md-4"></div>
		<div class="col-md-4"><input type="submit" value="Ajouter ce compte" class="form-control btn btn-success" /></div>
		<input type="hidden" name="page" value="manage_senders">
		<input type="hidden" name="viewms" value="list">
		<input type="hidden" name="op" value="addSender">
		<input type="hidden" name="list_id" value="'.$list_id.'">
		<input type="hidden" name="token" value="'.$token.'">
		<div class="col-md-4"></div></div>
		</form>';
		
	break;
	default:
	case 'list':
		if($op=='modifySender'){
			$sqlModifySender = 'UPDATE '.$row_config_globale['table_senders'].' SET
						name_organisation = '.escape_string(CleanInput($_POST['msorg'])).',
						email = '.escape_string(CleanInput($_POST['msmail'])).',
						email_reply = '.escape_string(CleanInput($_POST['msreply'])).',
						smtp = '.escape_string(CleanInput($_POST['mssmtp'])).',
						smtp_port = '.escape_string(CleanInput($_POST['mssmtpport'])).',
						smtp_option = '.escape_string(CleanInput($_POST['mssmtpoption'])).',
						smtp_auth = '.escape_string(CleanInput($_POST['mssmtpauth'])).',
						smtp_user = '.escape_string(CleanInput($_POST['mssmtpidentifiant'])).',
						smtp_password = '.escape_string(CleanInput($_POST['mssmtppassword'])).',
						bounce_email = '.escape_string(CleanInput($_POST['msbouncemail'])).',
						bounce_server = '.escape_string(CleanInput($_POST['msbounceserveur'])).',
						bounce_user = '.escape_string(CleanInput($_POST['msbounceid'])).',
						bounce_password = '.escape_string(CleanInput($_POST['msbouncepass'])).',
						bounce_service = '.escape_string(CleanInput($_POST['msbounceservice'])).',
						bounce_port = '.escape_string(CleanInput($_POST['msbounceport'])).',
						bounce_option = '.escape_string(CleanInput($_POST['msbounceoption'])).'
					WHERE id_sender = '.escape_string(CleanInput($_POST['msname']));
			if (!$cnx->query($sqlModifySender)) {
				echo '<div class="row"><div class="col-md-12">
				<div class="alert alert-danger">Erreur sur modification du compte : <b>'.CleanInput($_POST['msname']).'</b>.</div>
				</div></div>';
			} else {
				echo '<div class="row"><div class="col-md-12">
				<div class="alert alert-success">Compte <b>'.CleanInput($_POST['msname']).'</b> mis à jour correctement.</b></div>
				</div></div>';
			}		
		}
		if($op=='addSender'){
			$sqlAddSender = 'INSERT INTO '.$row_config_globale['table_senders'].' 
				(id_sender, name_organisation, email, email_reply, smtp, smtp_port, smtp_option, 
				smtp_auth, smtp_user, smtp_password, bounce_email, bounce_server, bounce_user, 
				bounce_password, bounce_service,bounce_port, bounce_option)
				VALUES ('.escape_string(CleanInput($_POST['msname'])).',
					'.escape_string(CleanInput($_POST['msorg'])).',
					'.escape_string(CleanInput($_POST['msmail'])).',
					'.escape_string(CleanInput($_POST['msreply'])).',
					'.escape_string(CleanInput($_POST['mssmtp'])).',
					'.escape_string(CleanInput($_POST['mssmtpport'])).',
					'.escape_string(CleanInput($_POST['mssmtpoption'])).',
					'.escape_string(CleanInput($_POST['mssmtpauth'])).',
					'.escape_string(CleanInput($_POST['mssmtpidentifiant'])).',
					'.escape_string(CleanInput($_POST['mssmtppassword'])).',
					'.escape_string(CleanInput($_POST['msbouncemail'])).',
					'.escape_string(CleanInput($_POST['msbounceserveur'])).',
					'.escape_string(CleanInput($_POST['msbounceid'])).',
					'.escape_string(CleanInput($_POST['msbouncepass'])).',
					'.escape_string(CleanInput($_POST['msbounceservice'])).',
					'.escape_string(CleanInput($_POST['msbounceport'])).',
					'.escape_string(CleanInput($_POST['msbounceoption'])).'
				)';
			if (!$cnx->query($sqlAddSender)) {
				echo '<div class="row"><div class="col-md-12">';
				echo '<div class="alert alert-danger">Erreur sur création du compte : <b>'.CleanInput($_POST['msname']).'</b>.</div>';
				echo '</div></div>';
			} else {
				echo '<div class="row"><div class="col-md-12">';
				echo '<div class="alert alert-success">Création du compte <b>'.CleanInput($_POST['msname']).'</b> correcte.</b></div>';
				echo '</div></div>';
			}		
		}
		if($op=='delSender'){
			$sqlDelSender = 'DELETE FROM '.$row_config_globale['table_senders'].'
					WHERE id_sender = '.escape_string(CleanInput($account));
			if (!$cnx->query($sqlDelSender)) {
				echo '<div class="row"><div class="col-md-12">';
				echo '<div class="alert alert-danger">Erreur sur suppression du compte : <b>'.CleanInput($account).'</b>.</div>';
				echo '</div></div>';
			} else {
				echo '<div class="row"><div class="col-md-12">';
				echo '<div class="alert alert-success">Compte <b>'.CleanInput($account).'</b> supprimé correctement</b></div>';
				echo '</div></div>';
			}		
		}
		echo '<div class="row" style="margin-bottom:9px;"><div class="col-md-12">
		<ul class="nav navbar-nav navbar-left"><li>
		<button class="btn btn-primary">
		<a href="?page=manage_senders&token=' . $token . '&list_id=' . $list_id 
		.'&viewms=add" data-toggle="tooltip" title="Ajouter et paramétrer un compte émetteur de mails"><i class="glyphicon glyphicon-pencil"></i> Ajouter un compte émetteur</a>
		</button>
		</li></ul>
		</div></div>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
			<thead> 
			    <tr> 
			        <th style="text-align:left">Compte</th>
			        <th style="text-align:center">Adresse Email</th>
			        <th style="text-align:center">Serveur SMTP</th>
			        <th style="text-align:center">Dernière campagne</th>
			        <th style="text-align:center">Gérer</th>
			    </tr> 
			</thead>
			<tfoot> 
			    <tr> 
			        <th style="text-align:left">Compte</th>
			        <th style="text-align:center">Adresse Email</th>
			        <th style="text-align:center">Serveur SMTP</th>
			        <th style="text-align:center">Dernière campagne</th>
			        <th style="text-align:center">Gérer</th>
			    </tr> 
			</tfoot>
			<tbody>';
		$row=getSendersFull($cnx,$row_config_globale['table_senders'],$row_config_globale['table_archives']);
		foreach  ($row as $item){
			echo '<tr> 
			        <td style="text-align:left">'.$item['id_sender'].($item['name_organisation']!=''?' ('.$item['name_organisation'].')':'').'</td>
			        <td style="text-align:center">'.$item['email'].'</td>
			        <td style="text-align:center">'.$item['smtp'].'</td>
			        <td style="text-align:center">'.
			        	($item['subject']!=''?
			        		'<a data-toggle="modal" data-target="#modalPmnl" data-tooltip="tooltip" href="tracklinks.php?id_mail='.$item['id'].'&list_id='.$list_id.'&token='
                     .$token.'" title="'. tr( "TRACKING_DETAILLED_CLICKED_LINKS" ) .'">'.$item['subject'].'</a>':'En attente de campagne')
			        .'</td>
			        <td style="text-align:center">
			        <a href="?page=manage_senders&token=' . $token 
			        . '&list_id=' . $list_id . '&account='.$item['email'].'&viewms=manage" 
			        data-toggle="tooltip" title="Modifier ce compte">
			        <button type="button" class="btn btn-default btn-sm">
			        <span class="glyphicon glyphicon-pencil"></span></button></a>';
			if(count($row>1)) {
				echo '<a href="?page=manage_senders&token=' . $token 
				        . '&list_id=' . $list_id . '&account='.$item['id_sender'].'&viewms=list&op=delSender" 
				        data-toggle="tooltip" title="Supprimer cet expéditeur ?" onclick="return confirm(\'Supprimer cet expéditeur ?\')">
				        <button type="button" class="btn btn-default btn-sm">
				        <span class="glyphicon glyphicon-remove"></span></button></a>';
			}
			echo '</td>
			    </tr> ';
		}
		echo '</tbody></table>';
	break;
}