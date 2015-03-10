function validateForm(form) {
    var name = document.forms["form"]["name"].value;
    if (name == null || name == "") {
        alert("Field must be filled out"); //how to include actual name of field in alert?
        return false;
    }
}
