<?php
if(!sizeof($list)){
    $l='c';
}
switch($l){
    case 'l':
        if($page != "config"){
            echo '<article class="module width_full">';
            echo '<header><h3>'.tr("LIST_OF_LISTS").'</h3></header>';
			echo '<form action="" method="post">';
            echo '<table class="tablesorter" cellspacing="0"> 
                <thead> 
                    <tr> 
                        <th style="text-align:center">'.tr("LIST_NUMBER").'</th>
                        <th style="text-align:center">'.tr("LIST_NAME").'</th>
                        <th style="text-align:center">'.tr("LIST_COUNT_SUSCRIBERS").'</th>
						<th style="text-align:center">'.tr("LIST_LAST_CAMPAIGN").'</th>
						<th style="text-align:center">&nbsp; </th>
						<th style="text-align:center">'.tr("LIST_MIX_TITLE").'</th>
                        <th style="text-align:center">'.tr("DELETE").'</th> 
                    </tr> 
                </thead> 
                <tbody>';
            foreach  ($list as $item){
                echo '<tr>';
                echo '<td style="text-align:center">'. ($item['list_id']==$list_id?"<b>$list_id</b>":$item['list_id']) .'</td>';
                echo ($item['list_id']==$list_id?
                    '<td style="text-align:center"><a href="?list_id='.$item['list_id'].'&token='.$token.'" style="padding-left:4px;padding-right:6px;color:rgb(255,255,255);background-color:rgb(22,167,101);font:12px arial,sans-serif;" class="tooltip" title="'.tr("LIST_SELECTED").'"
                    >'.$item['newsletter_name'].'</a></td>':
                    '<td style="text-align:center"><a href="?list_id='.$item['list_id'].'&token='.$token.'" class="tooltip" title="'.tr("CHOOSE_THIS_LIST").'">'.$item['newsletter_name'].'</a></td>');
                echo '<td style="text-align:center">'. getSubscribersNumbers($cnx,$row_config_globale['table_email'],$item['list_id']).'</td>';
				echo '<td style="text-align:center">'. list_newsletter_last_id_send($cnx,$row_config_globale['table_send'],$item['list_id']).'</td>';
				echo '<td style="text-align:center"><a href="?page=listes&l=l&action=duplicate&list_id='.$item['list_id'].'&token='.$token.'" class="tooltip" title="'.tr("LIST_DUPLICATE").' ?" onclick="return confirm(\''.tr("LIST_DUPLICATE").' ?\')"><img src="css/icn_copy.png" /></a></td>';
				echo '<td style="text-align:center"><input type="checkbox" class="tooltip mx" title="'.tr("LIST_MIX_DETAIL").'" name="mix_list_id[]" value="'.$item['list_id'].'" /></td>';
                echo '<td style="text-align:center"><a href="?page=listes&l=l&action=delete&list_id='.$item['list_id'].'&token='.$token.'" class="tooltip" title="'.tr("DELETE_THIS_LIST").' ?" onclick="return confirm(\''.tr("WARNING_DELETE_LIST").' ?\')"><img src="css/icn_trash.png" /></a></td>';
                echo '</tr>';
            }
            echo '</table>';
			?>
            <script>$('input[type=checkbox].mx').change(function(){if($('input.mx:checked').size()>1){$("div#submitMix").show("slow");$("input#sbmix").removeAttr('disabled');}else{$('div#submitMix').hide("slow");}})</script>
            <?php
			echo '<div id="submitMix" style="display:none;margin-bottom:10px;margin-top:10px;" align="center">';
			echo '<input type="submit" id="sbmix" value="'.tr("LIST_MIX_TITLE").'" disabled>';
			echo '<input type="hidden" name="action" value="mix">';
			echo '<input type="hidden" name="l" value="l">';
			echo '<input type="hidden" name="page" value="listes">';
			echo '<input type="hidden" name="token" value="'.$token.'">';
			echo '</div></form>';
        } elseif($list_name == -1) {
            $error_list = true;
        } elseif(empty($list) && $page != "newsletterconf" && $page != "config") {
            echo "<div align='center' class='tooltip critical'>".tr("ERROR_NO_NEWSLETTER_CREATE_ONE")."</div>";
            $error_list = true;
            exit();
        } else {
            // dummy !
        }
        echo '</article>';
    break;
    case 'c':
        echo "<form action='' method='post'>
        <article class='module width_3_quarter'><header><h3>".tr("NEWSLETTER_CREATE")."</h3></header>
        <div class='module_content'>
        <input type='hidden' name='op' value='createConfig' /><input type='hidden' name='token' value='$token' />
        <fieldset><label>".tr("NEWSLETTER_NAME")." : </label>
        <input type='text' name='newsletter_name' value='' /></fieldset>
        <fieldset><label>".tr("NEWSLETTER_FROM_NAME")." : </label>
        <input type='text' name='from_name' value='".htmlspecialchars($row_config_globale['admin_name'])."' /></fieldset>
        <fieldset><label>".tr("NEWSLETTER_FROM_ADDR")." : </label>
        <input type='text' name='from' value='".$row_config_globale['admin_email']."' /></fieldset>
        <fieldset><label>Adresse électronique pour preview : </label>
        <input type='text' name='preview_addr' value='".$row_config_globale['admin_email']."' /></fieldset>
        <fieldset><label>".tr("NEWSLETTER_SUBJECT")." : </label>
        <input type='text' name='subject' value='' /></fieldset>
        <fieldset><label>".tr("NEWSLETTER_HEADER")." : </label>
        <br><textarea class='editme' name='header' rows='15' id='NEWSLETTER_DEFAULT_HEADER'>".tr("NEWSLETTER_DEFAULT_HEADER")."</textarea></fieldset>
        <fieldset><label>".tr("NEWSLETTER_FOOTER")." : </label>
        <br><textarea class='editme' name='footer' rows='15' id='NEWSLETTER_DEFAULT_FOOTER'>".tr("NEWSLETTER_DEFAULT_FOOTER")."</textarea></fieldset>
        <fieldset><label>".tr("NEWSLETTER_SUB_MSG_SUBJECT")." : </label>
        <input type='text' name='subscription_subject' value='".htmlspecialchars(tr("NEWSLETTER_SUB_DEFAULT_SUBJECT"))."' /></fieldset>
        <fieldset><label>".tr("NEWSLETTER_SUB_MSG_BODY")." : </label>
        <br><textarea class='editme' name='subscription_body' rows='15' id='NEWSLETTER_SUB_DEFAULT_BODY'>".tr("NEWSLETTER_SUB_DEFAULT_BODY")."</textarea></fieldset>
        <fieldset><label>".tr("NEWSLETTER_WELCOME_MSG_SUBJECT")." : </label>
        <input type='text' name=' welcome_subject' value='".htmlspecialchars(tr("NEWSLETTER_WELCOME_DEFAULT_SUBJECT")) ."' /></fieldset>
        <fieldset><label>".tr("NEWSLETTER_WELCOME_MSG_BODY")." : </label>
        <br><textarea class='editme' name='welcome_body' rows='15' id='NEWSLETTER_WELCOME_DEFAULT_BODY'>".tr("NEWSLETTER_WELCOME_DEFAULT_BODY"). "</textarea></fieldset>
        <fieldset><label>".tr("NEWSLETTER_UNSUB_MSG_SUBJECT")." : </label>
        <input type='text' name=' quit_subject' value='".htmlspecialchars(tr("NEWSLETTER_UNSUB_DEFAULT_SUBJECT"))."' /></fieldset>
        <fieldset><label>".tr("NEWSLETTER_UNSUB_MSG_BODY")." : </label>
        <br><textarea class='editme' name='quit_body' rows='15' id='NEWSLETTER_UNSUB_DEFAULT_BODY'>".tr("NEWSLETTER_UNSUB_DEFAULT_BODY")."</textarea></fieldset>
        </div>
        <script src='js/tinymce/tinymce.min.js'></script>
        <script>tinymce.init({
            selector: 'textarea.editme', theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen textcolor emoticons',
                'insertdatetime media table contextmenu paste filemanager colorpicker'
            ],
            toolbar1: 'insertfile undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
            toolbar2: 'styleselect | fontselect fontsizeselect | emoticons | link image | filemanager',
            style_formats: [
               {title: 'Open Sans', inline: 'span', styles:{ 'font-family':'Open Sans'}},
               {title: 'Arial', inline: 'span', styles:{ 'font-family':'arial'}},
               {title: 'Book Antiqua', inline: 'span', styles:{ 'font-family':'book antiqua'}},
               {title: 'Comic Sans MS', inline: 'span', styles:{ 'font-family':'comic sans ms,sans-serif'}},
               {title: 'Courier New', inline: 'span', styles:{ 'font-family':'courier new,courier'}},
               {title: 'Georgia', inline: 'span', styles:{ 'font-family':'georgia,palatino'}},
               {title: 'Helvetica', inline: 'span', styles:{ 'font-family':'helvetica'}},
               {title: 'Impact', inline: 'span', styles:{ 'font-family':'impact,chicago'}},
               {title: 'Symbol', inline: 'span', styles:{ 'font-family':'symbol'}},
               {title: 'Tahoma', inline: 'span', styles:{ 'font-family':'tahoma'}},
               {title: 'Terminal', inline: 'span', styles:{ 'font-family':'terminal,monaco'}},
               {title: 'Times New Roman', inline: 'span', styles:{ 'font-family':'times new roman,times'}},
               {title: 'Verdana', inline: 'span', styles:{ 'font-family':'Verdana'}}
            ],
            relative_urls: false,
            remove_script_host: false,
            language : 'fr_FR',
            image_advtab: true ,
            external_filemanager_path:'/".$row_config_globale['path']."js/tinymce/plugins/filemanager/',
            filemanager_title:'Responsive Filemanager' ,
            external_plugins:{ 'filemanager' : '/".$row_config_globale['path']."js/tinymce/plugins/filemanager/plugin.min.js'}});
        </script>";
        echo '</article>';
        echo '<article class="module width_quarter"><div class="sticky-scroll-box">';
        echo '<header><h3>Actions :</h3></header><div align="center">';
        echo "<br>
            <input type='submit' value=\"".tr("NEWSLETTER_SAVE_NEW")."\" />
            <input type='hidden' name='page' value='listes' />
            <input type='hidden' name='token' value='$token' />
            <div class='spacer'></div>";
        echo '</div></article></div></form>';
    break;
}
echo '</article>';



