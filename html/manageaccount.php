<!DOCTYPE html>
<header>
<title>Servatrice Administrator</title>
</header>
<body>
	<?php
		require '.auth_usersession';
		require '.config_commonfunctions';
		global $configfile;
		if ($_POST)
		{
			$current_username = $_REQUEST['username'];
			$user_info_array[3] = $_REQUEST['useremail'];
			
			if (empty($current_username))
			{
				$current_username = locate_username_byemail($user_info_array[3]);
			}
		}
		else
		{
			$current_username = $_SESSION['username'];
		}

		$user_info_array = array(dont_allow_blank(get_user_data($current_username,'admin')), dont_allow_blank(get_user_data($current_username,'realname')), dont_allow_blank(get_user_data($current_username,'gender')), dont_allow_blank(get_user_data($current_username,'email')), dont_allow_blank(get_user_data($current_username,'country')), dont_allow_blank(get_user_data($current_username,'avatar_bmp')), dont_allow_blank(get_user_data($current_username,'active')), get_user_data($current_username,'adminnotes'));
	?>
	<form action="updateaccount.php" method="post">
		<table align="center" border="1" cellpadding="5" width="450">
			<tr>
				<?php
					if ($_SESSION['admin'] > 0){
						echo '<td align="center"><a href="portal_manageaccounts.php">Account Management Menu</a></td><td align="center"><a href="logout.php">Logout</a></td>';
					} else {
						echo '<td align="center"><a href="user_portal.php">Main Menu</a></td><td align="center"><a href="logout.php">Logout</a></td>';
					}
				?>
			</tr>
			<?php
				if ($_SESSION['admin'] > 0){
					echo '<tr>';
					echo '<td>Active:</td>';
					echo '<td>';
					echo '<select name="active">';
					if ($user_info_array[6] == 0){ echo '<option value=0 selected>No</option>'; } else { echo '<option value=0>No</option>'; }
					if ($user_info_array[6] == 1){ echo '<option value=1 selected>Yes</option>'; } else { echo '<option value=1>Yes</option>'; }
					echo '</select>';
					echo '</td>';
					echo '</tr>';
				}
			?>
			<tr>
				<td>Username:</td>
				<?php
					if ($_SESSION['admin'] > 0){
						echo '<td><input type="text" value="' . $current_username . '" name="name" size="35" maxlength="35" /></td>';
					} else {
						echo '<td><input type="text" value="' . $current_username . '" name="name" size="35" maxlength="35" readonly/></td>';
					}
				?>
			</tr>
			<?php
				if ($_SESSION['admin'] == 1)
				{
					echo '<tr>'.
						'<td>Privilage Level:</td>'.
					 	'<td>'.
						'<select name="admin">';
						if ($user_info_array[0] == 0){ echo '<option value=0 selected>User</option>'; } else { echo '<option value=0>User</option>'; }
						if ($user_info_array[0] == 1){ echo '<option value=1 selected>Admin</option>'; } else { echo '<option value=1>Admin</option>'; }
						if ($user_info_array[0] == 2){ echo '<option value=2 selected>Moderator</option>'; } else { echo '<option value=2>Moderator</option>'; }
					echo '</select>'.
						'</td>';
				} else {
					// avoid showing select menu to allow privilege change
				}
			?>
			<tr>
				<td>Realname:</td>
				<td><input type="text" value="<?=$user_info_array[1]?>" name="realname" size="35" maxlength="35" /></td>
			</tr>
			<tr>
				<td>Gender:</td>
				<td>
					<select name="gender">
					<?php
					$gender_option_array = array(array("", "Unspecified"), array("m", "Masculine"), array("f", "Feminine"), array("n", "Neutral"));
					for ($i = 0; $i < count($gender_option_array); $i++)
					{
						if ($user_info_array[2] == $gender_option_array[$i][0])
							echo "<option value='{$gender_option_array[$i][0]}' selected>{$gender_option_array[$i][1]}</option>\n";
						else
							echo "<option value='{$gender_option_array[$i][0]}'>{$gender_option_array[$i][1]}</option>\n";
					}
					?>

					</select>
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" value= "" name="password_sha512" size="35" maxlength="120" /></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" value="<?=$user_info_array[3]?>" name="email" size="35" maxlength="255" /></td>
			</tr>
			<tr>
				<td>Country:</td>
				<td>
					<select name="country">
				<?php
					$all_countries_short_array = array("","af","ax","al","dz","as","ad","ao","ai","aq","ag","ar","am","aw","au","at","az","bs","bh","bd","bb","by","be","bz","bj","bm","bt","bo","ba","bq","bw","bv","br","io","bn","bg","bf","bi","kh","cm","ca","cv","ky","cf","td","cl","cn","cx","cc","co","km","cg","cd","ck","cr","ci","hr","cu","cw","cy","cz","dk","dj","dm","do","ec","eg","sv","gq","er","ee","et","fk","fo","fj","fi","fr","gf","pf","tf","ga","gm","ge","de","gh","gi","gr","gl","gd","gp","gu","gt","gg","gn","gw","gy","ht","hm","va","hn","hk","hu","is","in","id","ir","iq","ie","im","il","it","jm","jp","je","jo","kz","ke","ki","kp","kr","kw","kg","la","lv","lb","ls","lr","ly","li","lt","lu","mo","mk","mg","mw","my","mv","ml","mt","mh","mq","mr","mu","yt","mx","fm","md","mc","mn","me","ms","ma","mz","mm","na","nr","np","nl","nc","nz","ni","ne","ng","nu","nf","mp","no","om","pk","pw","ps","pa","pg","py","pe","ph","pn","pl","pt","pr","qa","re","ro","ru","rw","bl","sh","kn","lc","mf","pm","vc","ws","sm","st","sa","sn","rs","sc","sl","sg","sx","sk","si","sb","so","za","gs","ss","es","lk","sd","sr","sj","sz","se","ch","sy","tw","tj","tz","th","tl","tg","tk","to","tt","tn","tr","tm","tc","tv","ug","ua","ae","gb","us","um","uy","uz","vu","ve","vn","vg","vi","wf","eh","ye","zm","zw");
					$all_countries_long_array = array("","Afghanistan","Åland Islands","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia (Plurinational State of)","Bosnia and Herzegovina","Bonaire, Sint Eustatius and Saba","Botswana","Bouvet Island","Brazil","British Indian Ocean Territory","Brunei Darussalam","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Christmas Island","Cocos (Keeling) Islands","Colombia","Comoros","Congo","Congo (Democratic Republic of the)","Cook Islands","Costa Rica","Cote D'ivoire","Croatia","Cuba","Curaçao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands (Malvinas)","Faroe Islands","Fiji","Finland","France","French Guiana","French Polynesia","French Southern Territories","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guernsey","Guinea","Guinea-bissau","Guyana","Haiti","Heard Island and Mcdonald Islands","Holy See (Vatican City State)","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran (Islamic Republic of)","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Korea (Democratic People's Republic of)","Korea (Republic of)","Kuwait","Kyrgyzstan","Lao People's Democratic Republic","Latvia","Lebanon","Lesotho","Liberia","Libyan Arab Jamahiriya","Liechtenstein","Lithuania","Luxembourg","Macao","Macedonia (the former Yugoslav Republic of)","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Mexico","Micronesia (Federated States of)","Moldova (Republic of)","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","Northern Mariana Islands","Norway","Oman","Pakistan","Palau","Palestine, State of","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn","Poland","Portugal","Puerto Rico","Qatar","Réunion","Romania","Russian Federation","Rwanda","Saint Barthélemy","Saint Helena","Saint Kitts and Nevis","Saint Lucia","Saint Martin (French part)","Saint Pierre and Miquelon","Saint Vincent and The Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Sint Maarten (Dutch part)","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Georgia and The South Sandwich Islands","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Svalbard and Jan Mayen","Swaziland","Sweden","Switzerland","Syrian Arab Republic","Taiwan, Province of China","Tajikistan","Tanzania, United Republic of","Thailand","Timor-leste","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","United States Minor Outlying Islands","Uruguay","Uzbekistan","Vanuatu","Venezuela","Viet Nam","Virgin Islands, British","Virgin Islands, U.S.","Wallis and Futuna","Western Sahara","Yemen","Zambia","Zimbabwe");

					for ($i = 0; $i < count($all_countries_short_array); $i++)
					{
						if ($user_info_array[4] == $all_countries_short_array[$i])
							echo "<option value='{$all_countries_short_array[$i]}' selected>{$all_countries_long_array[$i]}</option>\n";
						else
							echo "<option value='{$all_countries_short_array[$i]}'>{$all_countries_long_array[$i]}</option>\n";
					}
				?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Current Avatar:</td>
				<td><?='<img src="data:image/png;base64,' . base64_encode($user_info_array[5]) . '"/>';?></td>
			</tr>
			<tr>
				<td>Delete Avatar:</td>
				<td><input type="checkbox" value="" name="deleteavatar" /></td>
			</tr>
			<?php
				if ($_SESSION['admin'] > 0)
				{
					echo '<tr>'.
						'<td>Admin Notes:</td>'.
						'<td>'.
					 	'<textarea name="adminnotes" rows="8" cols="35" />' . $user_info_array[7] . '</textarea>'.
						'</td>'.
					 	'</tr>';
				}
			?>	
			<tr><td colspan="2" align="center"><input type="submit" value="Update" /></td></tr>
		<table>
	</form>
	<form enctype="multipart/form-data" action="upload.php" method="POST">
		<table align="center" border="1" cellpadding="5" width="450">
			<tr>
				<td>Upload Avatar</td>
			</tr>
			<tr>
				<td>
					<?php 
						echo '<input type="hidden" name="name" value="' . $current_username . '" />';
					 ?>
			                <input type="hidden" name="MAX_FILE_SIZE" value="65536" />
			                Maximum filesize is 64KB. <br>
			                For best results, your avatar pictures should be in aspect ratio 5:2! <br>
			                <input name="userfile" type="file" />
				        <input type="submit" value="Send File" />
				</td>
			</tr>
		</table>
		<!-- Confirmation (will work on later)-->
			<input type="hidden" name="id_check" value="">
			<input type="hidden" name="admin_check" value="">
			<input type="hidden" name="name_check" value="">
			<input type="hidden" name="realname_check" value="">
			<input type="hidden" name="gender_check" value="">
			<input type="hidden" name="email_check" value="">
			<input type="hidden" name="country_check" value="">
			<input type="hidden" name="avatar_bmp_check" value="">
			<input type="hidden" name="registrationDate_check" value="">
			<input type="hidden" name="token_check" value="">
			<input type="hidden" name="adminnotes_check" value="">
		
        </form>
	<?php
		if ($_SESSION['admin'] > 0)
		{
			echo '<table align="center" border="1" cellpadding="5" width="450">'.
				'<tr>'.
                '<td>'.
                '<form action="resendemailverification.php" method="post" />'.
                '<input type="hidden" name="name" value="' . $current_username . '" />'.
                '<center><input type="submit" value="Resend Email Verification" /></center>'.
                '</form>'.
                '</td>'.
                '</tr>'.
				'</table>';
		}
        ?>
</body>
</html>