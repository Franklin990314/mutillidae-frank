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
    </style>

    <div class="content-page">
        <div class="body">
            <div class="page-title"><span style="font-size: 18pt;"><?php echo "{$lTitle}"; ?></span></div>

            <?php include_once (__ROOT__.'/includes/back-button.inc');?>

            <!-- BEGIN HTML OUTPUT  -->
            <div class="content-page padding--20">
                <div><table style="margin-left:auto; margin-right:auto; width: 600px;">
                    <tbody>
                        <tr><td></td></tr>
                        <tr>
                            <td class="form-header"><?php echo "{$lQuestion}"; ?></td>
                        </tr>
                        <tr><td></td></tr>
                    </tbody>
                </table></div>
            </div>

            <!-- BEGIN HTML OUTPUT  -->
            <form   action=""
                    method="post"
                    enctype="application/x-www-form-urlencoded"
                    id="idForm">
                <div class="section over-hide z-bigger">
                    <div class="section over-hide z-bigger">
                        <div class="container pb-5">
                            <div class="row justify-content-center pb-5">
                                <div class="col-12 pb-5 checkbox-lab">
                                    <input class="checkbox-tools" type="radio" name="answer" id="tool-1" value="1">
                                    <label class="for-checkbox-tools" for="tool-1">
                                        <i class='uil uil-line-alt'></i>
                                        <?php echo "{$lChoice_1}"; ?>
                                    </label>
                                    <input class="checkbox-tools" type="radio" name="answer" id="tool-2" value="2">
                                    <label class="for-checkbox-tools" for="tool-2">
                                        <i class='uil uil-vector-square'></i>
                                        <?php echo "{$lChoice_2}"; ?>
                                    </label>
                                    <input class="checkbox-tools" type="radio" name="answer" id="tool-3" value="3">
                                    <label class="for-checkbox-tools" for="tool-3">
                                        <i class='uil uil-ruler'></i>
                                        <?php echo "{$lChoice_3}"; ?>
                                    </label>
                                    <input class="checkbox-tools" type="radio" name="answer" id="tool-4" value="4">
                                    <label class="for-checkbox-tools" for="tool-4">
                                        <i class='uil uil-crop-alt'></i>
                                        <?php echo "{$lChoice_4}"; ?>
                                    </label>
                                    <input class="checkbox-tools" type="radio" name="answer" id="tool-5" value="5">
                                    <label class="for-checkbox-tools" for="tool-5">
                                        <i class='uil uil-brush-alt'></i>
                                        <?php echo "{$lChoice_5}"; ?>
                                    </label>
                                </div>
                            </div>
                        </div>	
                    </div>
                </div>
                <div style="text-align: -webkit-center;">
                    <div class="field back-button-div padding-bottom--24">
                        <input id="back-button-anchor" name="submit" type="submit" value="Submit" />
                    </div>
                </div>
            </form>

            <?php
                try{
                    $lResult = "Choose the best answer or view Hints and Videos";

                    if (isset($_POST["answer"])){

                    if ($_POST["answer"] == $lCorrectAnswer){
                    $lResult = "Correct";
                    }else{
                        $lResult = "Incorrect";
                    }//end if

                    }// end if (isset($_POST))

                    echo "<div class='report-header'>{$lResult}</div>";

                }catch(Exception $e){
                    echo $CustomErrorHandler->FormatError($e, "Input: " . $lMessage);
                }// end try
            ?>
            
            <br>
            <div style="text-align: -webkit-center;">
                <div class="field back-button-div padding-bottom--24">
                    <?php
                        $lFirstLab = 1;
                        $lFinalLab = 63;
                        $lLastLab = $lLabNumber-1;
                        $lNextLab = $lLabNumber+1;

                        if ($lLabNumber > $lFirstLab){
                            echo "<a href=\"index.php?page=labs/lab-{$lLastLab}.php\"><input id=\"back-button-anchor\" class=\"light-button\" type=\"button\" value=\"Previous Lab\"></a>";
                        }
                        if ($lLabNumber > $lFirstLab && $lLabNumber < $lFinalLab){
                            echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
                        }
                        if ($lLabNumber < $lFinalLab){
                            echo "<a href=\"index.php?page=labs/lab-{$lNextLab}.php\"><input id=\"back-button-anchor\" class=\"light-button\" type=\"button\" value=\"Next Lab\"></a>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>