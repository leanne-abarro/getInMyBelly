<?php
	class Form {
		private $sHTML;
        private $aData;
        private $aErrors;
        private $aFiles;

	// ===form building methods:===

	public function __construct ($sAction=""){
		$this -> sHTML = '<form action="'.$sAction.'" method="POST" enctype="multipart/form-data">'."\n";
        $this -> aData = array();
        $this -> aErrors = array();
        $this -> aFiles = array();
	}
    
    public function makeHeader3 ($headerName){
        $this -> sHTML .='<h3 class="textAlignCenter">'.$headerName.'</h3>'."\n";
    }
    public function makeInput ($sControlName, $sControlLabel, $sClasses){
        
        //sticky data:
        $sData = "";

        if (isset($this -> aData[$sControlName])) {
            $sData = $this -> aData[$sControlName];
        }

        // finding errors:
        $sError = "";

        if (isset($this -> aErrors[$sControlName])) {
            $sError = $this -> aErrors[$sControlName];
        }

        //html markup:
        $this -> sHTML .='<div class="'.$sClasses.'">'."\n";
        $this -> sHTML .= '<label class="marginBottom10 colour3A" for="'.$sControlName.'">'.$sControlLabel.'</label>'."\n";
        $this -> sHTML .= '<input type="text" id="'.$sControlName.'" name="'.$sControlName.'" value="'.$sData.'" />'."\n";
        $this -> sHTML .= '<span class="formError">'.$sError.'</span>'."\n";
        $this -> sHTML .='</div>'."\n";
    }

    public function quantityInput ($sControlName, $sControlLabel, $sClasses){

        //sticky data:
        $sData = "";

        if (isset($this -> aData[$sControlName])) {
            $sData = $this -> aData[$sControlName];
        }

        // finding errors:
        $sError = "";

        if (isset($this -> aErrors[$sControlName])) {
            $sError = $this -> aErrors[$sControlName];
        }

        //html markup:
        $this -> sHTML .='<div class="'.$sClasses.'">'."\n";
        $this -> sHTML .='<label class="marginBottom10 floatLeft" for="'.$sControlName.'">'.$sControlLabel.'</label>'."\n";
        $this -> sHTML .='<input class="marginTop10 marginLeft10 float Left" type="number" id="'.$sControlName.'" name="'.$sControlName.'" value="'.$sData.'" />'."\n";
        $this -> sHTML .= '<span class="formError floatLeft">'.$sError.'</span>'."\n";
        $this -> sHTML .='</div>'."\n";
    }

    public function stockInput ($sControlName, $sControlLabel, $sClasses){

        //sticky data:
        $sData = "";

        if (isset($this -> aData[$sControlName])) {
            $sData = $this -> aData[$sControlName];
        }

        // finding errors:
        $sError = "";

        if (isset($this -> aErrors[$sControlName])) {
            $sError = $this -> aErrors[$sControlName];
        }

        //html markup:
        $this -> sHTML .='<div class="'.$sClasses.'">'."\n";
        $this -> sHTML .='<label class="marginBottom10 floatLeft" for="'.$sControlName.'">'.$sControlLabel.'</label>'."\n";
        $this -> sHTML .='<input class="float Left" type="number" id="'.$sControlName.'" name="'.$sControlName.'" value="'.$sData.'" />'."\n";
        $this -> sHTML .='</div>'."\n";
    }
        
    public function checkOutInput ($sControlName){

        //sticky data:
        $sData = "";

        if (isset($this -> aData[$sControlName])) {
            $sData = $this -> aData[$sControlName];
        }

        //html markup:

        $this -> sHTML .='<input class="" type="number" id="'.$sControlName.'" name="'.$sControlName.'" value="'.$sData.'" />'."\n";
        
    }
        
    public function newsletterSubscribeInput ($sControlName){
         $sError = "";

        if (isset($this -> aErrors[$sControlName])) {
            $sError = $this -> aErrors[$sControlName];
        }
        
        //html markup:
        $this -> sHTML .='<div>'."\n";
        $this -> sHTML .='<input class="floatLeft" type="email" id="'.$sControlName.'" name="'.$sControlName.'" />'."\n";
        $this -> sHTML .= '<span class="formError floatLeft">'.$sError.'</span>'."\n";
        $this -> sHTML .='</div>'."\n";
    
    }
    
    public function makePassword ($sControlName, $sControlLabel, $sClasses){
        //sticky data:
        $sData = "";

        if (isset($this -> aData[$sControlName])) {
            $sData = $this -> aData[$sControlName];
        }

        // finding errors:
        $sError = "";

        if (isset($this -> aErrors[$sControlName])) {
            $sError = $this -> aErrors[$sControlName];
        }

        // html markup:

        $this -> sHTML .='<div class="'.$sClasses.'">'."\n";
        $this -> sHTML .= '<label class="marginBottom10 colour3A" for="'.$sControlName.'">'.$sControlLabel.'</label>'."\n";
        $this -> sHTML .= '<input type="password" id="'.$sControlName.'" name="'.$sControlName.'" value="'.$sData.'" />'."\n";
        $this -> sHTML .= '<span class="displayBlock formError">'.$sError.'</span>'."\n";
        $this -> sHTML .='</div>'."\n";
    }
     
    public function makePasswordBlank ($sControlName, $sControlLabel){ // no sticky data

        // finding errors:
        $sError = "";

        if (isset($this -> aErrors[$sControlName])) {
            $sError = $this -> aErrors[$sControlName];
        }

        // html markup:
        $this -> sHTML .='<div class="doubleColumn floatLeft marginBottom10 marginLeftNone">'."\n";
        $this -> sHTML .='<label class="marginBottom10 colour3A" for="'.$sControlName.'">'.$sControlLabel.'</label>'."\n";
        $this -> sHTML .='<input class="floatLeft" type="password" id="'.$sControlName.'" name="'.$sControlName.'" value="" />'."\n";
        $this -> sHTML .= '<span class="formError">'.$sError.'</span>'."\n";
        $this -> sHTML .='</div>'."\n";
    }
    
    public function makeCheckBox ($sControlName, $sControlLabel){
        $this -> sHTML .='<div class="marginBottom20">'."\n";
        $this -> sHTML .='<input class="floatLeft marginTop5" type="checkbox" id="'.$sControlName.'" name="'.$sControlName.'" />'."\n";
        $this -> sHTML .='<span class="newsFootnote colour66">'.$sControlLabel.'</span>'."\n";
        $this -> sHTML .='</div>'."\n";
    }

    public function makeSubmit ($sControlName, $sControlLabel, $sClasses){
        $this -> sHTML .= '<div class="clearBoth">'."\n";
        $this -> sHTML .= '<input class="'.$sClasses.'" type="submit" name="'.$sControlName.'" value="'.$sControlLabel.'" />'."\n";
        $this -> sHTML .= '</div>'."\n";
    }

    public function makeHiddenField ($sControlName, $sValue){

        $this -> sHTML .= '<input type="hidden" name="'.$sControlName.'" value="'.$sValue.'" />'."\n";
    
    } 
           
    public function makeSelect ($sControlName, $sControlLabel,$aOptions,$sClasses){
        

        //html markup:
        $this -> sHTML .='<div class="'.$sClasses.'">'."\n";
        $this -> sHTML .= '<label class="marginBottom10 colour3A" for="'.$sControlName.'">'.$sControlLabel.'</label>'."\n";
        $this -> sHTML .= '<select name="'.$sControlName.'">'."\n";
        
        foreach($aOptions as $key=>$value){

            if($key == $this->aData[$sControlName]){
               $this -> sHTML .= '<option selected value="'.$key.'">'.$value.'</option>'."\n"; 
            }else{
                $this -> sHTML .= '<option value="'.$key.'">'.$value.'</option>'."\n";
            }
			
        }
        $this -> sHTML .='</select>'."\n";
        $this -> sHTML .='</div>'."\n";
    }
        
    public function makeImageUpload ($sControlName, $sControlLabel){
        $sError ="";

        // finding errors

        if (isset($this -> aErrors[$sControlName])){
            $sError = $this -> aErrors[$sControlName];
        }
        
        $this -> sHTML .='<div class="clearBoth eight columns floatLeft marginBottom20">'."\n";
        $this -> sHTML .='<div class="imageBox marginBottom10">'."\n";
        $this -> sHTML .='<img src="images/imageBox.jpg" />'."\n";
        $this -> sHTML .='</div>'."\n";
        $this -> sHTML .='<label class="marginBottom10 colour3A" for="'.$sControlName.'">'.$sControlLabel.'</label>'."\n";
        $this -> sHTML .='<input type="file" name="'.$sControlName.'" id="'.$sControlName.'">'."\n";
        $this -> sHTML .= '<span class="formError">'.$sError.'</span>'."\n";
        $this -> sHTML .='</div>'."\n";
    }
    
    public function makeTextArea ($sControlName, $sControlLabel, $sClasses){
        
        //sticky data:
        $sData = "";

        if (isset($this -> aData[$sControlName])) {
            $sData = $this -> aData[$sControlName];
        }

        // finding errors:
        $sError = "";

        if (isset($this -> aErrors[$sControlName])) {
            $sError = $this -> aErrors[$sControlName];
        }
        
        $this -> sHTML .='<div class="'.$sClasses.'">'."\n";
        $this -> sHTML .='<label class="marginBottom10 colour3A" for="'.$sControlName.'">'.$sControlLabel.'</label>'."\n";
        $this -> sHTML .='<textarea name="'.$sControlName.'">'.$sData.'</textarea>'."\n";
        $this -> sHTML .= '<span class="formError">'.$sError.'</span>'."\n";
        $this -> sHTML .='</div>'."\n";
    }
    
    public function makeCommentBoxTextArea ($sControlName){
        $this -> sHTML .='<textarea class="floatLeft" type="password" id="'.$sControlName.'" name="'.$sControlName.'"></textarea>'."\n";
    }
        
    public function moveFile ($sControlName,$sNewName){
        // move uploaded files from temp folder to images folder

        $sNewPath = dirname(__FILE__).'/../images/'.$sNewName;

        move_uploaded_file($this -> aFiles[$sControlName]['tmp_name'], $sNewPath);
    }


    // ===form checking methods:===

    public function checkFilled ($sControlName){

        $sData = $this -> aData[$sControlName];

        if (strlen($sData) == 0) {
            $this -> aErrors[$sControlName] = "* field must be filled";
        }
    }

    public function raiseCustomError ($sControlName,$sError){
        $this -> aErrors[$sControlName] = $sError;
    }

    public function compare ($sControlName1, $sControlName2){
        $sData1 = $this -> aData[$sControlName1];
        $sData2 = $this -> aData[$sControlName2];

        if ($sData2 != $sData1) {
            $this -> aErrors[$sControlName2] = "*".$sControlName1." does not match";
        }
    }
        
    public function checkFileUpload ($sControlName){

        if (isset($this -> aFiles[$sControlName]) == false){
            $this -> aErrors[$sControlName] = "* File not uploaded";
        } else {
            if ($this -> aFiles[$sControlName]["error"] != 0){
                $this -> aErrors[$sControlName] = "* Please upload an image";
            }
        }
    }

	public function __get ($sKey){
		switch ($sKey){
			case 'HTML':
			return $this -> sHTML.'</form>';
				break;

            case 'valid':
            if (count($this -> aErrors) == 0){
                return true;
            } else {
                return false;
            }
            break;

			default:
			die($sKey." does not exist");
		}
	}

	public function __set ($sKey, $value){
		switch ($sKey){
			case 'data':
            $this -> aData = $value;
            break;
            
            case 'files':
				$this -> aFiles = $value;
				break;

            default:
            die($sKey." does not exist");
		}
	}

	}
?>