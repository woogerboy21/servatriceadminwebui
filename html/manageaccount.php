<!DOCTYPE html>
<header>
<title>Servatrice Administrator</title>
</header>
<body>
	<?php
		require '.auth_usersession';
		require '.config_commonfunctions';
		global $configfile;
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$current_username = $_POST['username'];
			$current_email = $_POST['useremail'];
			if (empty($current_username)){
				$current_username = locate_username_byemail($current_email);
			}
		} else {
			$current_username = $_SESSION['username'];
		}
		$current_privlevel = get_user_data($current_username,'admin');
		$current_realname = get_user_data($current_username,'realname');
		$current_gender = get_user_data($current_username,'gender');
		$current_email = get_user_data($current_username,'email');
		$current_country = get_user_data($current_username,'country');
		$current_avatar = get_user_data($current_username,'avatar_bmp');
		$current_active = get_user_data($current_username,'active');
		$current_adminnotes = get_user_data($current_username,'adminnotes');

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
					if ($current_active == 0){ echo '<option value=0 selected>No</option>'; } else { echo '<option value=0>No</option>'; }
					if ($current_active == 1){ echo '<option value=1 selected>Yes</option>'; } else { echo '<option value=1>Yes</option>'; }
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
				if ($_SESSION['admin'] == 1){
					echo '<tr>';
					echo '<td>Privilage Level:</td>';
					echo '<td>';
					echo '<select name="admin">';
					if ($current_privlevel == 0){ echo '<option value=0 selected>User</option>'; } else { echo '<option value=0>User</option>'; }
					if ($current_privlevel == 1){ echo '<option value=1 selected>Admin</option>'; } else { echo '<option value=1>Admin</option>'; }
					if ($current_privlevel == 2){ echo '<option value=2 selected>Moderator</option>'; } else { echo '<option value=2>Moderator</option>'; }
					echo '</select>';
                                        echo '</td>';
				} else {
					// avoid showing select menu to allow privilege change
				}
			?>
			<tr>
				<td>Realname:</td>
				<td><input type="text" value="<?php echo $current_realname; ?>" name="realname" size="35" maxlength="35" /></td>
			</tr>
			<tr>
				<td>Gender:</td>
				<td><input type="text" value="<?php echo $current_gender; ?>" name="gender" size="35" maxlength="1" /></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" value="<?php echo $current_password; ?>" name="password_sha512" size="35" maxlength="120" /></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" value="<?php echo $current_email; ?>" name="email" size="35" maxlength="255" /></td>
			</tr>
			<tr>
				<td>Country:</td>
				<td>
					<select id="country" name="country">
						<option value="">Country</option>
						<option<?=$current_country == 'af' ? ' selected="selected"' : '' ;?> value="af">Afghanistan</option>
						<option<?=$current_country == 'ax' ? ' selected="selected"' : '' ;?> value="ax">Åland Islands</option>
						<option<?=$current_country == 'al' ? ' selected="selected"' : '' ;?> value="al">Albania</option>
						<option<?=$current_country == 'dz' ? ' selected="selected"' : '' ;?> value="dz">Algeria</option>
						<option<?=$current_country == 'as' ? ' selected="selected"' : '' ;?> value="as">American Samoa</option>
						<option<?=$current_country == 'ad' ? ' selected="selected"' : '' ;?> value="ad">Andorra</option>
						<option<?=$current_country == 'ao' ? ' selected="selected"' : '' ;?> value="ao">Angola</option>
						<option<?=$current_country == 'ai' ? ' selected="selected"' : '' ;?> value="ai">Anguilla</option>
						<option<?=$current_country == 'aq' ? ' selected="selected"' : '' ;?> value="aq">Antarctica</option>
						<option<?=$current_country == 'ag' ? ' selected="selected"' : '' ;?> value="ag">Antigua and Barbuda</option>
						<option<?=$current_country == 'ar' ? ' selected="selected"' : '' ;?> value="ar">Argentina</option>
						<option<?=$current_country == 'am' ? ' selected="selected"' : '' ;?> value="am">Armenia</option>
						<option<?=$current_country == 'aw' ? ' selected="selected"' : '' ;?> value="aw">Aruba</option>
						<option<?=$current_country == 'au' ? ' selected="selected"' : '' ;?> value="au">Australia</option>
						<option<?=$current_country == 'at' ? ' selected="selected"' : '' ;?> value="at">Austria</option>
						<option<?=$current_country == 'az' ? ' selected="selected"' : '' ;?> value="az">Azerbaijan</option>
						<option<?=$current_country == 'bs' ? ' selected="selected"' : '' ;?> value="bs">Bahamas</option>
						<option<?=$current_country == 'bh' ? ' selected="selected"' : '' ;?> value="bh">Bahrain</option>
						<option<?=$current_country == 'bd' ? ' selected="selected"' : '' ;?> value="bd">Bangladesh</option>
						<option<?=$current_country == 'bb' ? ' selected="selected"' : '' ;?> value="bb">Barbados</option>
						<option<?=$current_country == 'by' ? ' selected="selected"' : '' ;?> value="by">Belarus</option>
						<option<?=$current_country == 'be' ? ' selected="selected"' : '' ;?> value="be">Belgium</option>
						<option<?=$current_country == 'bz' ? ' selected="selected"' : '' ;?> value="bz">Belize</option>
						<option<?=$current_country == 'bj' ? ' selected="selected"' : '' ;?> value="bj">Benin</option>
						<option<?=$current_country == 'bm' ? ' selected="selected"' : '' ;?> value="bm">Bermuda</option>
						<option<?=$current_country == 'bt' ? ' selected="selected"' : '' ;?> value="bt">Bhutan</option>
						<option<?=$current_country == 'bo' ? ' selected="selected"' : '' ;?> value="bo">Bolivia (Plurinational State of)</option>
						<option<?=$current_country == 'ba' ? ' selected="selected"' : '' ;?> value="ba">Bosnia and Herzegovina</option>
						<option<?=$current_country == 'bq' ? ' selected="selected"' : '' ;?> value="bq">Bonaire, Sint Eustatius and Saba</option>
						<option<?=$current_country == 'bw' ? ' selected="selected"' : '' ;?> value="bw">Botswana</option>
						<option<?=$current_country == 'bv' ? ' selected="selected"' : '' ;?> value="bv">Bouvet Island</option>
						<option<?=$current_country == 'br' ? ' selected="selected"' : '' ;?> value="br">Brazil</option>
						<option<?=$current_country == 'io' ? ' selected="selected"' : '' ;?> value="io">British Indian Ocean Territory</option>
						<option<?=$current_country == 'bn' ? ' selected="selected"' : '' ;?> value="bn">Brunei Darussalam</option>
						<option<?=$current_country == 'bg' ? ' selected="selected"' : '' ;?> value="bg">Bulgaria</option>
						<option<?=$current_country == 'bf' ? ' selected="selected"' : '' ;?> value="bf">Burkina Faso</option>
						<option<?=$current_country == 'bi' ? ' selected="selected"' : '' ;?> value="bi">Burundi</option>
						<option<?=$current_country == 'kh' ? ' selected="selected"' : '' ;?> value="kh">Cambodia</option>
						<option<?=$current_country == 'cm' ? ' selected="selected"' : '' ;?> value="cm">Cameroon</option>
						<option<?=$current_country == 'ca' ? ' selected="selected"' : '' ;?> value="ca">Canada</option>
						<option<?=$current_country == 'cv' ? ' selected="selected"' : '' ;?> value="cv">Cape Verde</option>
						<option<?=$current_country == 'ky' ? ' selected="selected"' : '' ;?> value="ky">Cayman Islands</option>
						<option<?=$current_country == 'cf' ? ' selected="selected"' : '' ;?> value="cf">Central African Republic</option>
						<option<?=$current_country == 'td' ? ' selected="selected"' : '' ;?> value="td">Chad</option>
						<option<?=$current_country == 'cl' ? ' selected="selected"' : '' ;?> value="cl">Chile</option>
						<option<?=$current_country == 'cn' ? ' selected="selected"' : '' ;?> value="cn">China</option>
						<option<?=$current_country == 'cx' ? ' selected="selected"' : '' ;?> value="cx">Christmas Island</option>
						<option<?=$current_country == 'cc' ? ' selected="selected"' : '' ;?> value="cc">Cocos (Keeling) Islands</option>
						<option<?=$current_country == 'co' ? ' selected="selected"' : '' ;?> value="co">Colombia</option>
						<option<?=$current_country == 'km' ? ' selected="selected"' : '' ;?> value="km">Comoros</option>
						<option<?=$current_country == 'cg' ? ' selected="selected"' : '' ;?> value="cg">Congo</option>
						<option<?=$current_country == 'cd' ? ' selected="selected"' : '' ;?> value="cd">Congo (Democratic Republic of the)</option>
						<option<?=$current_country == 'ck' ? ' selected="selected"' : '' ;?> value="ck">Cook Islands</option>
						<option<?=$current_country == 'cr' ? ' selected="selected"' : '' ;?> value="cr">Costa Rica</option>
						<option<?=$current_country == 'ci' ? ' selected="selected"' : '' ;?> value="ci">Cote D'ivoire</option>
						<option<?=$current_country == 'hr' ? ' selected="selected"' : '' ;?> value="hr">Croatia</option>
						<option<?=$current_country == 'cu' ? ' selected="selected"' : '' ;?> value="cu">Cuba</option>
						<option<?=$current_country == 'cw' ? ' selected="selected"' : '' ;?> value="cw">Curaçao</option>
						<option<?=$current_country == 'cy' ? ' selected="selected"' : '' ;?> value="cy">Cyprus</option>
						<option<?=$current_country == 'cz' ? ' selected="selected"' : '' ;?> value="cz">Czech Republic</option>
						<option<?=$current_country == 'dk' ? ' selected="selected"' : '' ;?> value="dk">Denmark</option>
						<option<?=$current_country == 'dj' ? ' selected="selected"' : '' ;?> value="dj">Djibouti</option>
						<option<?=$current_country == 'dm' ? ' selected="selected"' : '' ;?> value="dm">Dominica</option>
						<option<?=$current_country == 'do' ? ' selected="selected"' : '' ;?> value="do">Dominican Republic</option>
						<option<?=$current_country == 'ec' ? ' selected="selected"' : '' ;?> value="ec">Ecuador</option>
						<option<?=$current_country == 'eg' ? ' selected="selected"' : '' ;?> value="eg">Egypt</option>
						<option<?=$current_country == 'sv' ? ' selected="selected"' : '' ;?> value="sv">El Salvador</option>
						<option<?=$current_country == 'gq' ? ' selected="selected"' : '' ;?> value="gq">Equatorial Guinea</option>
						<option<?=$current_country == 'er' ? ' selected="selected"' : '' ;?> value="er">Eritrea</option>
						<option<?=$current_country == 'ee' ? ' selected="selected"' : '' ;?> value="ee">Estonia</option>
						<option<?=$current_country == 'et' ? ' selected="selected"' : '' ;?> value="et">Ethiopia</option>
						<option<?=$current_country == 'fk' ? ' selected="selected"' : '' ;?> value="fk">Falkland Islands (Malvinas)</option>
						<option<?=$current_country == 'fo' ? ' selected="selected"' : '' ;?> value="fo">Faroe Islands</option>
						<option<?=$current_country == 'fj' ? ' selected="selected"' : '' ;?> value="fj">Fiji</option>
						<option<?=$current_country == 'fi' ? ' selected="selected"' : '' ;?> value="fi">Finland</option>
						<option<?=$current_country == 'fr' ? ' selected="selected"' : '' ;?> value="fr">France</option>
						<option<?=$current_country == 'gf' ? ' selected="selected"' : '' ;?> value="gf">French Guiana</option>
						<option<?=$current_country == 'pf' ? ' selected="selected"' : '' ;?> value="pf">French Polynesia</option>
						<option<?=$current_country == 'tf' ? ' selected="selected"' : '' ;?> value="tf">French Southern Territories</option>
						<option<?=$current_country == 'ga' ? ' selected="selected"' : '' ;?> value="ga">Gabon</option>
						<option<?=$current_country == 'gm' ? ' selected="selected"' : '' ;?> value="gm">Gambia</option>
						<option<?=$current_country == 'ge' ? ' selected="selected"' : '' ;?> value="ge">Georgia</option>
						<option<?=$current_country == 'de' ? ' selected="selected"' : '' ;?> value="de">Germany</option>
						<option<?=$current_country == 'gh' ? ' selected="selected"' : '' ;?> value="gh">Ghana</option>
						<option<?=$current_country == 'gi' ? ' selected="selected"' : '' ;?> value="gi">Gibraltar</option>
						<option<?=$current_country == 'gr' ? ' selected="selected"' : '' ;?> value="gr">Greece</option>
						<option<?=$current_country == 'gl' ? ' selected="selected"' : '' ;?> value="gl">Greenland</option>
						<option<?=$current_country == 'gd' ? ' selected="selected"' : '' ;?> value="gd">Grenada</option>
						<option<?=$current_country == 'gp' ? ' selected="selected"' : '' ;?> value="gp">Guadeloupe</option>
						<option<?=$current_country == 'gu' ? ' selected="selected"' : '' ;?> value="gu">Guam</option>
						<option<?=$current_country == 'gt' ? ' selected="selected"' : '' ;?> value="gt">Guatemala</option>
						<option<?=$current_country == 'gg' ? ' selected="selected"' : '' ;?> value="gg">Guernsey</option>
						<option<?=$current_country == 'gn' ? ' selected="selected"' : '' ;?> value="gn">Guinea</option>
						<option<?=$current_country == 'gw' ? ' selected="selected"' : '' ;?> value="gw">Guinea-bissau</option>
						<option<?=$current_country == 'gy' ? ' selected="selected"' : '' ;?> value="gy">Guyana</option>
						<option<?=$current_country == 'ht' ? ' selected="selected"' : '' ;?> value="ht">Haiti</option>
						<option<?=$current_country == 'hm' ? ' selected="selected"' : '' ;?> value="hm">Heard Island and Mcdonald Islands</option>
						<option<?=$current_country == 'va' ? ' selected="selected"' : '' ;?> value="va">Holy See (Vatican City State)</option>
						<option<?=$current_country == 'hn' ? ' selected="selected"' : '' ;?> value="hn">Honduras</option>
						<option<?=$current_country == 'hk' ? ' selected="selected"' : '' ;?> value="hk">Hong Kong</option>
						<option<?=$current_country == 'hu' ? ' selected="selected"' : '' ;?> value="hu">Hungary</option>
						<option<?=$current_country == 'is' ? ' selected="selected"' : '' ;?> value="is">Iceland</option>
						<option<?=$current_country == 'in' ? ' selected="selected"' : '' ;?> value="in">India</option>
						<option<?=$current_country == 'id' ? ' selected="selected"' : '' ;?> value="id">Indonesia</option>
						<option<?=$current_country == 'ir' ? ' selected="selected"' : '' ;?> value="ir">Iran (Islamic Republic of)</option>
						<option<?=$current_country == 'iq' ? ' selected="selected"' : '' ;?> value="iq">Iraq</option>
						<option<?=$current_country == 'ie' ? ' selected="selected"' : '' ;?> value="ie">Ireland</option>
						<option<?=$current_country == 'im' ? ' selected="selected"' : '' ;?> value="im">Isle of Man</option>
						<option<?=$current_country == 'il' ? ' selected="selected"' : '' ;?> value="il">Israel</option>
						<option<?=$current_country == 'it' ? ' selected="selected"' : '' ;?> value="it">Italy</option>
						<option<?=$current_country == 'jm' ? ' selected="selected"' : '' ;?> value="jm">Jamaica</option>
						<option<?=$current_country == 'jp' ? ' selected="selected"' : '' ;?> value="jp">Japan</option>
						<option<?=$current_country == 'je' ? ' selected="selected"' : '' ;?> value="je">Jersey</option>
						<option<?=$current_country == 'jo' ? ' selected="selected"' : '' ;?> value="jo">Jordan</option>
						<option<?=$current_country == 'kz' ? ' selected="selected"' : '' ;?> value="kz">Kazakhstan</option>
						<option<?=$current_country == 'ke' ? ' selected="selected"' : '' ;?> value="ke">Kenya</option>
						<option<?=$current_country == 'ki' ? ' selected="selected"' : '' ;?> value="ki">Kiribati</option>
						<option<?=$current_country == 'kp' ? ' selected="selected"' : '' ;?> value="kp">Korea (Democratic People's Republic of)</option>
						<option<?=$current_country == 'kr' ? ' selected="selected"' : '' ;?> value="kr">Korea (Republic of)</option>
						<option<?=$current_country == 'kw' ? ' selected="selected"' : '' ;?> value="kw">Kuwait</option>
						<option<?=$current_country == 'kg' ? ' selected="selected"' : '' ;?> value="kg">Kyrgyzstan</option>
						<option<?=$current_country == 'la' ? ' selected="selected"' : '' ;?> value="la">Lao People's Democratic Republic</option>
						<option<?=$current_country == 'lv' ? ' selected="selected"' : '' ;?> value="lv">Latvia</option>
						<option<?=$current_country == 'lb' ? ' selected="selected"' : '' ;?> value="lb">Lebanon</option>
						<option<?=$current_country == 'ls' ? ' selected="selected"' : '' ;?> value="ls">Lesotho</option>
						<option<?=$current_country == 'lr' ? ' selected="selected"' : '' ;?> value="lr">Liberia</option>
						<option<?=$current_country == 'ly' ? ' selected="selected"' : '' ;?> value="ly">Libyan Arab Jamahiriya</option>
						<option<?=$current_country == 'li' ? ' selected="selected"' : '' ;?> value="li">Liechtenstein</option>
						<option<?=$current_country == 'lt' ? ' selected="selected"' : '' ;?> value="lt">Lithuania</option>
						<option<?=$current_country == 'lu' ? ' selected="selected"' : '' ;?> value="lu">Luxembourg</option>
						<option<?=$current_country == 'mo' ? ' selected="selected"' : '' ;?> value="mo">Macao</option>
						<option<?=$current_country == 'mk' ? ' selected="selected"' : '' ;?> value="mk">Macedonia (the former Yugoslav Republic of)</option>
						<option<?=$current_country == 'mg' ? ' selected="selected"' : '' ;?> value="mg">Madagascar</option>
						<option<?=$current_country == 'mw' ? ' selected="selected"' : '' ;?> value="mw">Malawi</option>
						<option<?=$current_country == 'my' ? ' selected="selected"' : '' ;?> value="my">Malaysia</option>
						<option<?=$current_country == 'mv' ? ' selected="selected"' : '' ;?> value="mv">Maldives</option>
						<option<?=$current_country == 'ml' ? ' selected="selected"' : '' ;?> value="ml">Mali</option>
						<option<?=$current_country == 'mt' ? ' selected="selected"' : '' ;?> value="mt">Malta</option>
						<option<?=$current_country == 'mh' ? ' selected="selected"' : '' ;?> value="mh">Marshall Islands</option>
						<option<?=$current_country == 'mq' ? ' selected="selected"' : '' ;?> value="mq">Martinique</option>
						<option<?=$current_country == 'mr' ? ' selected="selected"' : '' ;?> value="mr">Mauritania</option>
						<option<?=$current_country == 'mu' ? ' selected="selected"' : '' ;?> value="mu">Mauritius</option>
						<option<?=$current_country == 'yt' ? ' selected="selected"' : '' ;?> value="yt">Mayotte</option>
						<option<?=$current_country == 'mx' ? ' selected="selected"' : '' ;?> value="mx">Mexico</option>
						<option<?=$current_country == 'fm' ? ' selected="selected"' : '' ;?> value="fm">Micronesia (Federated States of)</option>
						<option<?=$current_country == 'md' ? ' selected="selected"' : '' ;?> value="md">Moldova (Republic of)</option>
						<option<?=$current_country == 'mc' ? ' selected="selected"' : '' ;?> value="mc">Monaco</option>
						<option<?=$current_country == 'mn' ? ' selected="selected"' : '' ;?> value="mn">Mongolia</option>
						<option<?=$current_country == 'me' ? ' selected="selected"' : '' ;?> value="me">Montenegro</option>
						<option<?=$current_country == 'ms' ? ' selected="selected"' : '' ;?> value="ms">Montserrat</option>
						<option<?=$current_country == 'ma' ? ' selected="selected"' : '' ;?> value="ma">Morocco</option>
						<option<?=$current_country == 'mz' ? ' selected="selected"' : '' ;?> value="mz">Mozambique</option>
						<option<?=$current_country == 'mm' ? ' selected="selected"' : '' ;?> value="mm">Myanmar</option>
						<option<?=$current_country == 'na' ? ' selected="selected"' : '' ;?> value="na">Namibia</option>
						<option<?=$current_country == 'nr' ? ' selected="selected"' : '' ;?> value="nr">Nauru</option>
						<option<?=$current_country == 'np' ? ' selected="selected"' : '' ;?> value="np">Nepal</option>
						<option<?=$current_country == 'nl' ? ' selected="selected"' : '' ;?> value="nl">Netherlands</option>
						<option<?=$current_country == 'nc' ? ' selected="selected"' : '' ;?> value="nc">New Caledonia</option>
						<option<?=$current_country == 'nz' ? ' selected="selected"' : '' ;?> value="nz">New Zealand</option>
						<option<?=$current_country == 'ni' ? ' selected="selected"' : '' ;?> value="ni">Nicaragua</option>
						<option<?=$current_country == 'ne' ? ' selected="selected"' : '' ;?> value="ne">Niger</option>
						<option<?=$current_country == 'ng' ? ' selected="selected"' : '' ;?> value="ng">Nigeria</option>
						<option<?=$current_country == 'nu' ? ' selected="selected"' : '' ;?> value="nu">Niue</option>
						<option<?=$current_country == 'nf' ? ' selected="selected"' : '' ;?> value="nf">Norfolk Island</option>
						<option<?=$current_country == 'mp' ? ' selected="selected"' : '' ;?> value="mp">Northern Mariana Islands</option>
						<option<?=$current_country == 'no' ? ' selected="selected"' : '' ;?> value="no">Norway</option>
						<option<?=$current_country == 'om' ? ' selected="selected"' : '' ;?> value="om">Oman</option>
						<option<?=$current_country == 'pk' ? ' selected="selected"' : '' ;?> value="pk">Pakistan</option>
						<option<?=$current_country == 'pw' ? ' selected="selected"' : '' ;?> value="pw">Palau</option>
						<option<?=$current_country == 'ps' ? ' selected="selected"' : '' ;?> value="ps">Palestine, State of</option>
						<option<?=$current_country == 'pa' ? ' selected="selected"' : '' ;?> value="pa">Panama</option>
						<option<?=$current_country == 'pg' ? ' selected="selected"' : '' ;?> value="pg">Papua New Guinea</option>
						<option<?=$current_country == 'py' ? ' selected="selected"' : '' ;?> value="py">Paraguay</option>
						<option<?=$current_country == 'pe' ? ' selected="selected"' : '' ;?> value="pe">Peru</option>
						<option<?=$current_country == 'ph' ? ' selected="selected"' : '' ;?> value="ph">Philippines</option>
						<option<?=$current_country == 'pn' ? ' selected="selected"' : '' ;?> value="pn">Pitcairn</option>
						<option<?=$current_country == 'pl' ? ' selected="selected"' : '' ;?> value="pl">Poland</option>
						<option<?=$current_country == 'pt' ? ' selected="selected"' : '' ;?> value="pt">Portugal</option>
						<option<?=$current_country == 'pr' ? ' selected="selected"' : '' ;?> value="pr">Puerto Rico</option>
						<option<?=$current_country == 'qa' ? ' selected="selected"' : '' ;?> value="qa">Qatar</option>
						<option<?=$current_country == 're' ? ' selected="selected"' : '' ;?> value="re">Réunion</option>
						<option<?=$current_country == 'ro' ? ' selected="selected"' : '' ;?> value="ro">Romania</option>
						<option<?=$current_country == 'ru' ? ' selected="selected"' : '' ;?> value="ru">Russian Federation</option>
						<option<?=$current_country == 'rw' ? ' selected="selected"' : '' ;?> value="rw">Rwanda</option>
						<option<?=$current_country == 'bl' ? ' selected="selected"' : '' ;?> value="bl">Saint Barthélemy</option>
						<option<?=$current_country == 'sh' ? ' selected="selected"' : '' ;?> value="sh">Saint Helena</option>
						<option<?=$current_country == 'kn' ? ' selected="selected"' : '' ;?> value="kn">Saint Kitts and Nevis</option>
						<option<?=$current_country == 'lc' ? ' selected="selected"' : '' ;?> value="lc">Saint Lucia</option>
						<option<?=$current_country == 'mf' ? ' selected="selected"' : '' ;?> value="mf">Saint Martin (French part)</option>
						<option<?=$current_country == 'pm' ? ' selected="selected"' : '' ;?> value="pm">Saint Pierre and Miquelon</option>
						<option<?=$current_country == 'vc' ? ' selected="selected"' : '' ;?> value="vc">Saint Vincent and The Grenadines</option>
						<option<?=$current_country == 'ws' ? ' selected="selected"' : '' ;?> value="ws">Samoa</option>
						<option<?=$current_country == 'sm' ? ' selected="selected"' : '' ;?> value="sm">San Marino</option>
						<option<?=$current_country == 'st' ? ' selected="selected"' : '' ;?> value="st">Sao Tome and Principe</option>
						<option<?=$current_country == 'sa' ? ' selected="selected"' : '' ;?> value="sa">Saudi Arabia</option>
						<option<?=$current_country == 'sn' ? ' selected="selected"' : '' ;?> value="sn">Senegal</option>
						<option<?=$current_country == 'rs' ? ' selected="selected"' : '' ;?> value="rs">Serbia</option>
						<option<?=$current_country == 'sc' ? ' selected="selected"' : '' ;?> value="sc">Seychelles</option>
						<option<?=$current_country == 'sl' ? ' selected="selected"' : '' ;?> value="sl">Sierra Leone</option>
						<option<?=$current_country == 'sg' ? ' selected="selected"' : '' ;?> value="sg">Singapore</option>
						<option<?=$current_country == 'sx' ? ' selected="selected"' : '' ;?> value="sx">Sint Maarten (Dutch part)</option>
						<option<?=$current_country == 'sk' ? ' selected="selected"' : '' ;?> value="sk">Slovakia</option>
						<option<?=$current_country == 'si' ? ' selected="selected"' : '' ;?> value="si">Slovenia</option>
						<option<?=$current_country == 'sb' ? ' selected="selected"' : '' ;?> value="sb">Solomon Islands</option>
						<option<?=$current_country == 'so' ? ' selected="selected"' : '' ;?> value="so">Somalia</option>
						<option<?=$current_country == 'za' ? ' selected="selected"' : '' ;?> value="za">South Africa</option>
						<option<?=$current_country == 'gs' ? ' selected="selected"' : '' ;?> value="gs">South Georgia and The South Sandwich Islands</option>
						<option<?=$current_country == 'ss' ? ' selected="selected"' : '' ;?> value="ss">South Sudan</option>
						<option<?=$current_country == 'es' ? ' selected="selected"' : '' ;?> value="es">Spain</option>
						<option<?=$current_country == 'lk' ? ' selected="selected"' : '' ;?> value="lk">Sri Lanka</option>
						<option<?=$current_country == 'sd' ? ' selected="selected"' : '' ;?> value="sd">Sudan</option>
						<option<?=$current_country == 'sr' ? ' selected="selected"' : '' ;?> value="sr">Suriname</option>
						<option<?=$current_country == 'sj' ? ' selected="selected"' : '' ;?> value="sj">Svalbard and Jan Mayen</option>
						<option<?=$current_country == 'sz' ? ' selected="selected"' : '' ;?> value="sz">Swaziland</option>
						<option<?=$current_country == 'se' ? ' selected="selected"' : '' ;?> value="se">Sweden</option>
						<option<?=$current_country == 'ch' ? ' selected="selected"' : '' ;?> value="ch">Switzerland</option>
						<option<?=$current_country == 'sy' ? ' selected="selected"' : '' ;?> value="sy">Syrian Arab Republic</option>
						<option<?=$current_country == 'tw' ? ' selected="selected"' : '' ;?> value="tw">Taiwan, Province of China</option>
						<option<?=$current_country == 'tj' ? ' selected="selected"' : '' ;?> value="tj">Tajikistan</option>
						<option<?=$current_country == 'tz' ? ' selected="selected"' : '' ;?> value="tz">Tanzania, United Republic of</option>
						<option<?=$current_country == 'th' ? ' selected="selected"' : '' ;?> value="th">Thailand</option>
						<option<?=$current_country == 'tl' ? ' selected="selected"' : '' ;?> value="tl">Timor-leste</option>
						<option<?=$current_country == 'tg' ? ' selected="selected"' : '' ;?> value="tg">Togo</option>
						<option<?=$current_country == 'tk' ? ' selected="selected"' : '' ;?> value="tk">Tokelau</option>
						<option<?=$current_country == 'to' ? ' selected="selected"' : '' ;?> value="to">Tonga</option>
						<option<?=$current_country == 'tt' ? ' selected="selected"' : '' ;?> value="tt">Trinidad and Tobago</option>
						<option<?=$current_country == 'tn' ? ' selected="selected"' : '' ;?> value="tn">Tunisia</option>
						<option<?=$current_country == 'tr' ? ' selected="selected"' : '' ;?> value="tr">Turkey</option>
						<option<?=$current_country == 'tm' ? ' selected="selected"' : '' ;?> value="tm">Turkmenistan</option>
						<option<?=$current_country == 'tc' ? ' selected="selected"' : '' ;?> value="tc">Turks and Caicos Islands</option>
						<option<?=$current_country == 'tv' ? ' selected="selected"' : '' ;?> value="tv">Tuvalu</option>
						<option<?=$current_country == 'ug' ? ' selected="selected"' : '' ;?> value="ug">Uganda</option>
						<option<?=$current_country == 'ua' ? ' selected="selected"' : '' ;?> value="ua">Ukraine</option>
						<option<?=$current_country == 'ae' ? ' selected="selected"' : '' ;?> value="ae">United Arab Emirates</option>
						<option<?=$current_country == 'gb' ? ' selected="selected"' : '' ;?> value="gb">United Kingdom</option>
						<option<?=$current_country == 'us' ? ' selected="selected"' : '' ;?> value="us">United States</option>
						<option<?=$current_country == 'um' ? ' selected="selected"' : '' ;?> value="um">United States Minor Outlying Islands</option>
						<option<?=$current_country == 'uy' ? ' selected="selected"' : '' ;?> value="uy">Uruguay</option>
						<option<?=$current_country == 'uz' ? ' selected="selected"' : '' ;?> value="uz">Uzbekistan</option>
						<option<?=$current_country == 'vu' ? ' selected="selected"' : '' ;?> value="vu">Vanuatu</option>
						<option<?=$current_country == 've' ? ' selected="selected"' : '' ;?> value="ve">Venezuela</option>
						<option<?=$current_country == 'vn' ? ' selected="selected"' : '' ;?> value="vn">Viet Nam</option>
						<option<?=$current_country == 'vg' ? ' selected="selected"' : '' ;?> value="vg">Virgin Islands, British</option>
						<option<?=$current_country == 'vi' ? ' selected="selected"' : '' ;?> value="vi">Virgin Islands, U.S.</option>
						<option<?=$current_country == 'wf' ? ' selected="selected"' : '' ;?> value="wf">Wallis and Futuna</option>
						<option<?=$current_country == 'eh' ? ' selected="selected"' : '' ;?> value="eh">Western Sahara</option>
						<option<?=$current_country == 'ye' ? ' selected="selected"' : '' ;?> value="ye">Yemen</option>
						<option<?=$current_country == 'zm' ? ' selected="selected"' : '' ;?> value="zm">Zambia</option>
						<option<?=$current_country == 'zw' ? ' selected="selected"' : '' ;?> value="zw">Zimbabwe</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Current Avatar:</td>
				<td><?php
				echo '<img src="data:image/png;base64,' . base64_encode( $current_avatar ) . '" />';
				?></td>
			</tr>
			<tr>
				<td>Delete Avatar:</td>
				<td><input type="checkbox" value="" name="deleteavatar" /></td>
			</tr>
			<?php
                                if ($_SESSION['admin'] > 0){
					echo '<tr>';
					echo '<td>Admin Notes:</td>';
					echo '<td>';
					echo '<textarea name="adminnotes" rows="8" cols="35" />' . $current_adminnotes . '</textarea>';
					echo '</td>';
					echo '</tr>';
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
        </form>
	<?php
                if ($_SESSION['admin'] > 0){
			echo '<table align="center" border="1" cellpadding="5" width="450">';
                        echo '<tr>';
                        echo '<td>';
                        echo '<form action="resendemailverification.php" method="post" />';
                        echo '<input type="hidden" name="name" value="' . $current_username . '" />';
                        echo '<center><input type="submit" value="Resend Email Verification" /></center>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
			echo '</table>';
                }
        ?>
</body>
</html>
