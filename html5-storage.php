<?php 
        try {	    	
            switch ($_SESSION["security-level"]){
                case "0": // This code is insecure.
                    $lUseClientSideStorageForSensitiveData = TRUE;
                    $lUseJavaScriptValidation = FALSE;
                    $lEnableHTMLControls = FALSE;
                break;
                case "1": // This code is insecure.
                    $lUseClientSideStorageForSensitiveData = TRUE;
                    $lUseJavaScriptValidation = TRUE;
                    $lEnableHTMLControls = TRUE;
                break;

                case "2":
                case "3":
                case "4":
                case "5": // This code is fairly secure
                    $lUseClientSideStorageForSensitiveData = FALSE;
                    $lUseJavaScriptValidation = TRUE;
                    $lEnableHTMLControls = TRUE;
                break;
            }// end switch
        }catch(Exception $e){
            echo $CustomErrorHandler->FormatError($e, "Error setting up configuration on page html5-storage.php");
        }// end try	
        
        if($lUseClientSideStorageForSensitiveData){
            echo "<script type=\"text/javascript\" src=\"javascript/html5-secrets.js\"></script>";		
        }// end if
    ?>

    <div class="content-page">
        <div class="body">
            <div class="page-title">HTML 5 Storage</div>

            <?php include_once (__ROOT__.'/includes/back-button.inc');?>

            <!-- BEGIN HTML OUTPUT  -->
            <script type="text/javascript">
                /* 
                    The Storage interface of the browser API
                
                    interface Storage {
                        readonly attribute unsigned long length;
                        DOMString? key(unsigned long index);
                        getter DOMString getItem(DOMString key);
                        setter creator void setItem(DOMString key, DOMString value);
                        deleter void removeItem(DOMString key);
                        void clear();
                    };
                */

                <?php 
                    if ($lUseJavaScriptValidation){
                        echo "var gUseJavaScriptValidation = \"TRUE\";";
                    }else{
                        echo "var gUseJavaScriptValidation = \"FALSE\";";
                    }
                ?>

                var addRow = function(pKey, pItem, pStorageType){
                    try{
                        var lDocRoot = window.document;
                        var lTBody = lDocRoot.getElementById("idSessionStorageTableBody");
                        var lTR = lDocRoot.createElement("tr");
                        var lKeyTD = lDocRoot.createElement("td");
                        var lItemTD = lDocRoot.createElement("td");
                        var lTypeTD = lDocRoot.createElement("td");

                        //lKeyTD.addAttribute("class", "label");
                        lItemTD.style.textAlign = "center";
                        lKeyTD.appendChild(lDocRoot.createTextNode(pKey));
                        lItemTD.appendChild(lDocRoot.createTextNode(pItem));
                        lTypeTD.appendChild(lDocRoot.createTextNode(pStorageType));
                        
                        lTR.appendChild(lKeyTD);
                        lTR.appendChild(lItemTD);
                        lTR.appendChild(lTypeTD);
                        lTBody.appendChild(lTR);
                    }catch(/*Exception*/ e){
                        alert("Error trying to add row in function addRow(): " + e.name + "-" + e.message);
                    };// end try
                };//end JavaScript function addRow

                var setMessage = function(/* String */ pMessage){
                    var lMessageSpan = document.getElementById("idAddItemMessageSpan");
                    lMessageSpan.innerHTML = pMessage;
                    lMessageSpan.setAttribute("class","success-message");
                };// end function setMessage

                var addItemToStorage = function(theForm){
                    try{			
                        var lKey = theForm.DOMStorageKey.value;
                        var lItem = theForm.DOMStorageItem.value;
                        var lType = "";
                        var lUnacceptableKeyPattern = "[^A-Za-z0-9]";

                        if (gUseJavaScriptValidation == "TRUE" && lKey.match(lUnacceptableKeyPattern)){
                            setMessage("Unable to add key " + lKey.toString() + " because it contains non-alphanumeric characters");
                            return false;
                        }// end if

                        var lInvalidTR = document.getElementById("id-invalid-input-tr");
                        if(lKey.length == 0 || lItem.length == 0){
                            lInvalidTR.style.display = "";
                            return false;
                        }else{
                            lInvalidTR.style.display = "none";
                        }// end if

                        if(theForm.SessionStorageType[0].checked){
                            window.sessionStorage.setItem(lKey, lItem);
                            lType = "Session";
                        }else if (theForm.SessionStorageType[1].checked){
                            window.localStorage.setItem(lKey, lItem);
                            lType = "Local";
                        }// end if

                        addRow(lKey, lItem, lType);
                        setMessage("Added key " + lKey.toString() + " to " + lType.toString() + " storage");

                    }catch(/*Exception*/ e){
                        alert("Error in function addItemToStorage(): " + e.name + "-" + e.message);
                    }// end try
                };// end JavaScript function

                var init = function(){
                    var s = window.sessionStorage;
                    var l = window.localStorage;
                    var lKey = "";

                    // grab local storage
                    for(var i=0;i<s.length;i++){
                        lKey = s.key(i);
                        if(!lKey.match(/^Secure/)){addRow(lKey, s.getItem(lKey), "Session");};
                    }//end for

                    // grab session storage
                    for(var i=0;i<l.length;i++){
                        lKey = l.key(i);
                        if(!lKey.match(/^Secure/)){addRow(lKey, l.getItem(lKey), "Local");};
                    }// end for

                };//end JavaScript function init
                
            </script>

            <div class="content-page padding--20">
                <div>
                    <table style="margin-left:auto; margin-right:auto; width: 600px;">
                        <tbody>
                            <tr id="id-invalid-input-tr" style="display: none;">
                                <td class="error-message">
                                    Error: Invalid Input - Both Key and Item are required fields
                                </td>
                            </tr>
                            <tr>
                                <td class="form-header">HTML 5 Web Storage</td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content-page">
                <div><table border="1px;" width="100%" class="results-table">
                    <tbody>
                        <tr class="report-header">
                            <td colspan="3">Web Storage</td>
                        </tr>
                        <tr class="report-header">
                            <td>Key</td>
                            <td>Item</td>
                            <td>Storage Type</td>
                        </tr>
                    </tbody>
                    <tbody id="idSessionStorageTableBody"></tbody>
                </table></div>
            </div>

            <form 	action="index.php?page=html5-storage.php" 
                method="post" 
                enctype="application/x-www-form-urlencoded" 
                onsubmit="return false;"
                id="idForm">
                <div class="content-page">
                    <div>
                        <table style="margin-left:auto; margin-right:auto; width: 600px;">
                            <tbody>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td>
                                        <div class="field padding-bottom--24">
                                            <label for="key">Key</label>
                                            <input  type="text" id="idDOMStorageKeyInput" name="DOMStorageKey" size="20"
                                                    autofocus="autofocus"
                                                <?php
                                                    if ($lEnableHTMLControls) {
                                                        echo('minlength="1" maxlength="20" required="required"');
                                                    }// end if
                                                ?>
                                            >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="field padding-bottom--24">
                                            <label for="item">Item</label>
                                            <input type="text" id="idDOMStorageItemInput" name="DOMStorageItem" size="20"
                                                <?php
                                                    if ($lEnableHTMLControls) {
                                                        echo('minlength="1" maxlength="20" required="required"');
                                                    }// end if
                                                ?>
                                            >
                                        </div>
                                    </td>
                                    <td class="label">
                                        <div class="container" style="display: inline-flex;">
                                            <form>
                                                <label>
                                                    <input type="radio" name="SessionStorageType" value="Session" checked="checked" 
                                                        <?php
                                                            if ($lEnableHTMLControls) {
                                                                echo('required="required"');
                                                            }// end if
                                                        ?>
                                                    /><span>Session</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="SessionStorageType" value="Local"
                                                        <?php
                                                            if ($lEnableHTMLControls) {
                                                                echo('required="required"');
                                                            }// end if
                                                        ?>
                                                    /><span>Local</span>
                                                </label>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="field back-button-div padding-bottom--10">
                                            <input id="back-button-anchor" onclick="addItemToStorage(this.form);" type="button" name="submit" value="Add new">
                                        </div>
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tfoot id="idSessionStorageTableFooter">
                                    <tr><th colspan="5"><span id="idAddItemMessageSpan"></span></th></tr>
                                    <tr><td>&nbsp;</td></tr>
                                </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>

            <div style="margin-left:auto; margin-right:auto; width:600px;">
                <span title="Click to delete session storage" onclick='sessionStorage.clear(); var node=window.document.getElementById("idSessionStorageTableBody"); while(node.hasChildNodes()){node.removeChild(node.firstChild)}; init();' style="cursor: pointer;" >
                    <img width="32px" height="32px" src="./resources/icon/delete_icon.ico" style="vertical-align:middle;">
                    <span style="font-weight: bold;">Session Storage</span>
                </span>
                <span title="Click to delete locate storage" onclick='localStorage.clear(); var node=window.document.getElementById("idSessionStorageTableBody"); while(node.hasChildNodes()){node.removeChild(node.firstChild)}; init();' style="cursor: pointer;" >
                    <img width="32px" height="32px" src="./resources/icon/delete_icon.ico" style="vertical-align:middle;">
                    <span style="font-weight: bold;">Local Storage</span>
                </span>
                <span title="Click to delete all html 5 storage" onclick='sessionStorage.clear();localStorage.clear(); var node=window.document.getElementById("idSessionStorageTableBody"); while(node.hasChildNodes()){node.removeChild(node.firstChild)}; init();' style="cursor: pointer;" >
                    <img width="32px" height="32px" src="./resources/icon/delete_icon.ico" style="vertical-align:middle;">
                    <span style="font-weight: bold;">All Storage</span>
                </span>
            </div>

            <script>
                try{
                    init();
                }catch(e){
                    alert("Error when calling init()"+e.message);
                }
            </script>
        </div>
    </div>
</section>