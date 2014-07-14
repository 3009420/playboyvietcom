function validateData(){
	if($('#srcimgaes').val()==''){
		alert('Vui lòng nhập Anh');
		$('#srcimgaes').focus();
		return false;
	}
//		else if($('#note_value').val()==''){
//		alert('Vui lòng nhập note value');
//		$('#contentdetailfull_value').focus();
//		return false;
//	}
	else{
		$('#frmUpdate').submit();
	}
	return false;		
}
