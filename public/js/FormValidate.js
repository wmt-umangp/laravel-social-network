$(document).ready(function () {
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters");
    $('#signup').validate({
        rules: {
            'name':{
                required:true,
                lettersonly: true,
            },
            'email':{
                required: true,
                email: true
            },
            'password':{
                required: true,
                minlength: 6
            },
            'cpassword':{
                required:true,
                equalTo: "#password"
            }
        },
        messages: {
            'name':{
                required:'Please Enter Name!!',
                lettersonly: 'name should be in letters only!!',
            },
            'email':{
                required: 'Please Enter Email!!',
                email: 'Please Enter Valid Email!!'
            },
            'password':{
                required: 'Please Enter Password!!',
                minlength: 'Password must be 6 character long!!'
            },
            'cpassword':{
                required:'Please Enter Confirm Password!!',
                equalTo: "Confirm Password must be same as password!!"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });


    $('#signin').validate({
        rules: {
            'email':{
                required: true,
                email: true
            },
            'password':{
                required: true,
                minlength: 6
            },
        },
        messages: {
            'email': {
                required: 'Please Enter Email!!',
                email: 'Please Enter a valid Email!!',
            },
            'password': {
                required: 'Please Enter Password!!',
                minlength: 'Password must be 6 characters long!!',
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $('#createpost').validate({
        rules: {
            'body':{
                required:true,
                maxlength: 1000,
            }
        },
        messages: {
            'body':{
                required:'Please Enter Text for Post!!',
                maxlength: 'Maximum 1000 characters allowed!!',
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1000000)
    }, 'File size must be less than {0} MB');

    $('#account').validate({
        rules: {
            'name':{
                required:true,
                lettersonly:true,
            },
            'image':{
                required:true,
                extension: "jpg|jpeg|png|gif",
                filesize: 3,
            }
        },
        messages: {
            'name':{
                required:'Please Enter Name!!',
                lettersonly: 'Name Must be in letters only!!'
            },
            'image':{
                required:'Please Choose Image!!',
                extension: 'Only image type jpg/png/jpeg/gif is allowed!!',
                filesize: 'File Size Must be less than 3MB'
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $('#editmodal').validate({
        rules: {
            'post-body':{
                required:true,
                maxlength: 1000,
            }
        },
        messages: {
            'post-body':{
                required:'Please Enter Text for Post!!',
                maxlength: 'Maximum 1000 characters allowed!!',
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });


});

