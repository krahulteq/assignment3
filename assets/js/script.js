$(document).ready(function () {
    $('#form').submit(function () {
        errorcheck = 0;

        // Error removing if input is correct/valid
        var removeErr = document.getElementsByClassName('error');
        for (i = 0; i < removeErr.length; i++) {
            removeErr[i].innerHTML = "";
        }

        var letters = /^[A-Za-z\s]+$/;
        var validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        var fname = $("#fname").val();
        fname = fname.trim();
        var lname = $("#lname").val();
        lname = lname.trim();
        var email = $("#email").val();
        email = email.trim();
        var phone = $("#phone").val();
        phone = phone.trim();
        var password = $("#password").val();
        password = password.trim();
        var cpassword = $("#cpassword").val();
        cpassword = cpassword.trim();
        var gender = "";
        var ele = document.getElementsByName('gender');
        for (i = 0; i < ele.length; i++) {
            if (ele[i].checked) {
                gender = ele[i].value;
            }
        }

        // file validation
        var fileInput = $('#file');
        var fileToUpload = fileInput.val();
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        var mysubmit = "";
        mysubmit = $("#mysubmit").val();
        mysubmit = mysubmit.trim();
        if (mysubmit != "") {
            if (fileToUpload == "") {
                $('#fileErr').html("Please select image");
                errorcheck = 1;
            } else if (!allowedExtensions.exec(fileToUpload)) {
                $('#fileErr').html("Sorry, only JPG, JPEG & PNG files are allowed.");
                errorcheck = 1;
            } else if ($('#file')[0].files[0].size > 50000) {
                $('#fileErr').html("Sorry, your file is greater than 50kb.");
                errorcheck = 1;
            }
        } else {
            if (fileToUpload == "") {

            } else if (!allowedExtensions.exec(fileToUpload)) {
                $('#fileErr').html("Sorry, only JPG, JPEG & PNG files are allowed.");
                errorcheck = 1;
            } else if ($('#file')[0].files[0].size > 50000) {
                $('#fileErr').html("Sorry, your file is greater than 50kb.");
                errorcheck = 1;
            }
        }

        // first name validation
        if (fname == "") {
            $('#fnameErr').html("Please enter your first name");
            errorcheck = 1;
        } else if (!fname.match(letters)) {
            $('#fnameErr').html("Please enter characters only");
            errorcheck = 1;
        } else if (fname.length < 3) {
            $('#fnameErr').html("Please enter at least 3 characters");
            errorcheck = 1;
        }

        // last name validation
        if (lname == "") {
            $('#lnameErr').html("Please enter your last name");
            errorcheck = 1;
        } else if (!lname.match(letters)) {
            $('#lnameErr').html("Please enter characters only");
            errorcheck = 1;
        } else if (lname.length < 3) {
            $('#lnameErr').html("Please enter at least 3 characters");
            errorcheck = 1;
        }

        // email validation
        if (email == null || email == "") {
            $('#emailErr').html("Please enter your email");
            errorcheck = 1;
        } else if (!email.match(validRegex)) {
            $('#emailErr').html("Please enter valid email");
            errorcheck = 1;
        }

        // phone number validation
        if (phone == "") {
            $('#phoneErr').html("Please enter your phone number");
            errorcheck = 1;
        } else if (isNaN(phone)) {
            $('#phoneErr').html("Please enter numeric only");
            errorcheck = 1;
        } else if (phone.length != 10) {
            $('#phoneErr').html("please enter 10 digit only");
            errorcheck = 1;
        }

        // password validation
        if (password == "") {
            $('#passwordErr').html("Please enter your password");
            errorcheck = 1;
        }

        // confirm password validation
        if (cpassword == "") {
            $('#cpasswordErr').html("Please enter your confirm password");
            errorcheck = 1;
        } else if (cpassword != password) {
            $('#cpasswordErr').html("confirm password not matched with password");
            errorcheck = 1;
        }

        // gender validation
        if (gender == "") {
            $('#genderErr').html("Please select your gender");
            errorcheck = 1;
        }

        if (errorcheck == 0) {
            console.log('no error continue form submission');
        } else {
            return false;
        }
    });

    // error removing on keyup
    $('input[name=file]').click(function () {
        $('#fileErr').html("");
    });
    $('input[name=fname]').keyup(function () {
        $('#fnameErr').html("");
    });
    $('input[name=lname]').keyup(function () {
        $('#lnameErr').html("");
    });
    $('input[name=email]').keyup(function () {
        $('#emailErr').html("");
    });
    $('input[name=phone]').keyup(function () {
        $('#phoneErr').html("");
    });
    $('input[name=password]').keyup(function () {
        $('#passwordErr').html("");
    });
    $('input[name=cpassword]').keyup(function () {
        $('#cpasswordErr').html("");
    });
    $('input[name=gender]').click(function () {
        $('#genderErr').html("");
    });

    // show hide password
    $('#showpassword').click(function () {
        var type = $('#password').attr('type');
        if (type == 'password') {
            $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        }
        return false;
    });

    $('#showcpassword').click(function () {
        var type = $('#cpassword').attr('type');
        if (type == 'password') {
            $('#cpassword').attr('type', 'text');
        } else {
            $('#cpassword').attr('type', 'password');
        }
        return false;
    });

});
// <!-- script for delete confirmation -->
function confirmation() {
    var result = confirm("Are you sure to delete?");
    if (!result) {
        return false;
    }
}