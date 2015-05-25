<?php

class TestAction extends Action{
	public function test(){
	  $this->display('test');
	}
	public function md5transfer(){
	  $plainText = $_POST['plaintext'];
    $md5Text = substr(md5($plainText),0,30);
    echo $md5Text;    
	}

}

?>
