function formValidate()
{
	var usn = document.forms['form']['uname'].value;
	var pwd = document.forms['form']['upass'].value;

	if(usn == "" || pwd == "")
	{
		alert("You left something undone");
		return false;
	}
}