<?php
    $lSecurityLevel = $_SESSION["security-level"];

    switch ($lSecurityLevel){
        case "0": // This code is insecure
            $lSecurityLevelMessage = "Security Level: ".$lSecurityLevel." (Hosed)";
            break;
        case "1": // This code is insecure
            // DO NOTHING: This is equivalent to using client side security
            $lSecurityLevelMessage = "Security Level: ".$lSecurityLevel." (Client-Side Security)";
            break;

        case "2":
        case "3":
        case "4":
        case "5": // This code is fairly secure
            $lSecurityLevelMessage = "Security Level: ".$lSecurityLevel." (Secure)";
            break;
    }// end switch

	if($_SESSION['loggedin'] == "True"){

	    switch ($lSecurityLevel){
	   		case "0": // This code is insecure
	   		case "1": // This code is insecure
	   			// DO NOTHING: This is equivalent to using client side security
				$logged_in_user = $_SESSION['logged_in_user'];
			break;

	   		case "2":
	   		case "3":
	   		case "4":
	   		case "5": // This code is fairly secure
	   			// encode the entire message following OWASP standards
	   			// this is HTML encoding because we are outputting data into HTML
				$logged_in_user = $Encoder->encodeForHTML($_SESSION['logged_in_user']);
			break;
	   	}// end switch

	   	$lUserID = $_SESSION['uid'];

	   	$lUserAuthorizationLevelText = 'User';

	   	if ($_SESSION['is_admin'] == 'TRUE'){
	   		$lUserAuthorizationLevelText = 'Admin';
	   	}// end if

		$lAuthenticationStatusMessage =
			'Logged In ' .
			$lUserAuthorizationLevelText . ": " .
			'<span class="logged-in-user">'.$logged_in_user.'</span>'.
			'<a href="index.php?page=edit-account-profile.php&uid='.$lUserID.'">'.
            '<img src="images/edit-icon-20-20.png" /></a>';
	} else {
		$logged_in_user = "anonymous";
		$lAuthenticationStatusMessage = "Not Logged In";
	}// end if($_SESSION['loggedin'] == "True")

	if ($_SESSION["EnforceSSL"] == "True"){
		$lEnforceSSLLabel = "Drop TLS";
	}else {
		$lEnforceSSLLabel = "Enforce TLS";
	}//end if

	$lHintsMessage = "Hints: ".$_SESSION["hints-enabled"];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
	<head>
		<link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />

		<link rel="stylesheet" type="text/css" href="styles/global-styles.css" />
		<link rel="stylesheet" type="text/css" href="styles/ddsmoothmenu/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="javascript/jQuery/colorbox/colorbox.css" />
		<link rel="stylesheet" type="text/css" href="styles/gritter/jquery.gritter.css" />

		<script src="javascript/sidebar-scripts.js"></script>
		<script src="javascript/jQuery/jquery.js"></script>
		<script src="javascript/jQuery/colorbox/jquery.colorbox-min.js"></script>
		<script src="javascript/ddsmoothmenu/ddsmoothmenu.js"></script>
		<script src="javascript/gritter/jquery.gritter.min.js"></script>
		<script src="javascript/hints/hints-menu.js"></script>
		<script src="javascript/inline-initializers/jquery-init.js"></script>
		<script src="javascript/inline-initializers/ddsmoothmenu-init.js"></script>
		<script src="javascript/inline-initializers/populate-web-storage.js"></script>
		<script src="javascript/inline-initializers/gritter-init.js"></script>
		<script src="javascript/inline-initializers/hints-menu-init.js"></script>
	</head>
	<body>
        <table class="main-table-frame">
            <tbody>
                <tr class="main-table-frame-dark">
                    <td class="main-table-frame-first-bar" colspan="2">
                        <img src="./images/coykillericon-50-38.png">
                        OWASP Mutillidae II: Keep Calm and Pwn On
                    </td>
                </tr>
                <tr class="main-table-frame-dark">
                    <td class="main-table-frame-second-bar" colspan="2">
                        <?php /* Note: $C_VERSION_STRING in index.php */
                            echo $C_VERSION_STRING;
                        ?>
                        <span><?php echo $lSecurityLevelMessage; ?></span>
                        <span><?php echo $lHintsMessage; ?></span>
                        <span><?php echo $lAuthenticationStatusMessage ?></span>
                    </td>
                </tr>
            </tbody>
        </table>

        <nav>
            <ul id="main">
                <li>
                    <a href="index.php?page=home.php&popUpNotificationCode=HPH0"><i class="ion-bag"></i> <span>Home</span></a>
                </li>
                <li>
					<?php
						if ($_SESSION['loggedin'] == 'True'){
							echo '<a href="index.php?do=logout"><i class="ion-bag"></i> <span>Logout</span></a>';
						} else {
							echo '<a href="index.php?page=login.php"><i class="ion-bag"></i> <span>Login/Register</span></a>';
						}// end if
					?>
                </li>
                <li>
					<?php
						if ($_SESSION['security-level'] == 0){
							echo '<a href="index.php?do=toggle-hints&page='.$lPage.'"><i class="ion-bag"></i> <span>Toggle Hints</span></a>';
						}// end if
					?>
                </li>
                <li>
                    <a href="index.php?do=toggle-security&page=<?php echo $lPage?>"><i class="ion-bag"></i> <span>Toggle Security</span></a>
                </li>
                <li>
                    <a href="index.php?do=toggle-enforce-ssl&page=<?php echo $lPage?>"><i class="ion-bag"></i> <span><?php echo $lEnforceSSLLabel; ?></span></a>
                </li>
                <li>
                    <a href="set-up-database.php"><i class="ion-bag"></i> <span>Reset DB</span></a>
                </li>
                <li>
                    <a href="index.php?page=show-log.php"><i class="ion-bag"></i> <span>View Log</span></a>
                </li>
                <li>
                    <a href="index.php?page=captured-data.php"><i class="ion-bag"></i> <span>View Captured Data</span></a>
                </li>
                <div id="marker"></div>
            </ul>
        </nav>