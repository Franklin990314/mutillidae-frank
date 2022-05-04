<style>
        [type="checkbox"]:checked,
        [type="checkbox"]:not(:checked),
        [type="radio"]:checked,
        [type="radio"]:not(:checked){
            position: absolute;
            left: -9999px;
            width: 0;
            height: 0;
            visibility: hidden;
        }
		#marker{
			height: 6px;
			background: #171c21 !important;
			position: absolute;
			bottom: 0;
			width: 160px;
			z-index: 2;
		}
    </style>

	<?php
		/* Check if required software is installed. Issue warning if not. */
	
		if (!$RequiredSoftwareHandler->isPHPCurlIsInstalled()){
			echo $RequiredSoftwareHandler->getNoCurlAdviceBasedOnOperatingSystem();
		}// end if

		if (!$RequiredSoftwareHandler->isPHPJSONIsInstalled()){
			echo $RequiredSoftwareHandler->getNoJSONAdviceBasedOnOperatingSystem();
		}// end if
	?>

	<div class="content-page" style="align-items: center;">
		<div class="body">
			<div class="section over-hide z-bigger">
				<div class="section over-hide z-bigger">
					<div class="container">
						<div class="row">
							<div class="col-12 pb-5">
								<input class="checkbox-tools" type="radio" name="tools" id="tool-1">
								<label class="for-checkbox-tools home-item" for="tool-1">
									<a title="Usage Instructions" href="./index.php?page=documentation/usage-instructions.php" style="color: #5e6468;">
										<i class='uil uil-line-alt'></i>
										<img width="32px" height="32px" src="./resources/icon/android_search_icon.ico" style="vertical-align:middle; padding-right: 5px;">
										What Should I Do?
									</a>
								</label>
								<input class="checkbox-tools" type="radio" name="tools" id="tool-2">
								<label class="for-checkbox-tools home-item" for="tool-2">
									<a 	href="./includes/pop-up-help-context-generator.php?pagename=<?php echo $lPage; ?>" class="colorbox" title="Help me with page <?php echo $lPage; ?>" style="color: #5e6468;">
										<i class='uil uil-vector-square'></i>
										<img width="32px" height="32px" src="./resources/icon/help_icon.ico" style="vertical-align:middle; padding-right: 5px;">
										Help Me!
									</a>
								</label>
							</div>
							<div class="col-12 pb-5">
								<input class="checkbox-tools" type="radio" name="tools" id="tool-3">
								<label class="for-checkbox-tools home-item" for="tool-3">
									<a href="./index.php?page=./documentation/vulnerabilities.php" style="color: #5e6468;">
										<i class='uil uil-line-alt'></i>
										<img width="32px" height="32px" src="./resources/icon/siren_emergency_icon.ico" style="vertical-align:middle; padding-right: 5px;">
										Listing of vulnerabilities
									</a>
								</label>
								<input class="checkbox-tools" type="radio" name="tools" id="tool-4">
								<label class="for-checkbox-tools home-item" for="tool-4">
									<a href="http://www.youtube.com/user/webpwnized" target="_blank" style="color: #5e6468;">
										<i class='uil uil-vector-square'></i>
										<img width="32px" height="32px" src="./resources/icon/youTube_icon.ico" style="vertical-align:middle; padding-right: 5px;">
										Video Tutorials
									</a>
								</label>
							</div>
							<div class="col-12 pb-5">
								<input class="checkbox-tools" type="radio" name="tools" id="tool-5">
								<label class="for-checkbox-tools home-item" for="tool-5">
									<a href="https://twitter.com/webpwnized" target="_blank" style="color: #5e6468;">
										<i class='uil uil-line-alt'></i>
										<img width="32px" height="32px" src="./resources/icon/twitter_icon.ico" style="vertical-align:middle; padding-right: 5px;">
										Release Announcements
									</a>
								</label>
								<input class="checkbox-tools" type="radio" name="tools" id="tool-6">
								<label class="for-checkbox-tools home-item" for="tool-6">
									<a title="Latest Version" href="https://github.com/webpwnized/mutillidae" target="_blank" style="color: #5e6468;">	
										<i class='uil uil-vector-square'></i>
										<img width="32px" height="32px" src="./resources/icon/cd_player_icon.ico" style="vertical-align:middle; padding-right: 5px;">
										Latest Version
									</a>
								</label>
							</div>
							<div class="col-12 pb-5">
								<input class="checkbox-tools" type="radio" name="tools" id="tool-7">
								<label class="for-checkbox-tools home-item" for="tool-7">
									<a href="documentation/mutillidae-test-scripts.txt" target="_blank" style="color: #5e6468;">		
										<i class='uil uil-line-alt'></i>
										<img width="32px" height="32px" src="./resources/icon/help_buoy_icon.ico" style="vertical-align:middle; padding-right: 5px;">
										Helpful hints and scripts
									</a>
								</label>
								<input class="checkbox-tools" type="radio" name="tools" id="tool-8">
								<label class="for-checkbox-tools home-item" for="tool-8">
									<a href="configuration/openldap/mutillidae.ldif" target="_blank" style="color: #5e6468;">		
										<i class='uil uil-vector-square'></i>
										<img width="32px" height="32px" src="./resources/icon/file_icon.ico" style="vertical-align:middle; padding-right: 5px;">
										Mutillidae LDIF File
									</a>
								</label>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>