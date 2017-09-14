function formValidate() {
    var x = document.forms["fetch_form"]["stars"].value;
    if (x == "" && Math.floor(x) == x) {
        document.forms["fetch_form"]["stars"].style.backgroundColor = "red";
		alert("Please enter a valid input.");
        return false;
    }
}