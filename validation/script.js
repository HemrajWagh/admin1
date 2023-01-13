var nameError = document.getElementById('name_error');
var phoneError = document.getElementById('phone_error');
var emailError = document.getElementById('email_error');
var massageError = document.getElementById('massage_error');
var submitError = document.getElementById('submit_error');


function validatName(){
	var name = document.getElementById('contact_name').value;
	if(name.length=0){
		nameError.innerHTML= "Name is required"
	}
	if(!name.match(/^[_a-zA-Z0-9]*\s{1}[A-Za-z]*$/)){
		nameError.innerHTML ="Write full name";
		return false;
	}
	nameError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
	return true;
}