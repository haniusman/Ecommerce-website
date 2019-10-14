$(document).ready(function(){

    //Validate register form
    $("#registerForm").validate({
       rules:{
           name:{
               required:true,
               minlength:2,
               accept:"[a-zA-Z]+",
           },
           password:{
               required:true,
               minlength:6,
           },
           email:{
               required:true,
               email:true,
               remote: "/check-email",
           }
       },
        messages:{
           name:{
             required: "Please enter your name",
               minlength: "Your name must be atleast 2 characters long",
               accept: "Your name must contain letters only"
           } ,
            password: {
               required: "Please provide your password",
               minlength: "Your password must be atleast 6 characters long",
            },
           email:{
               required:"Please enter your email",
               email: "Please enter valid email",
               remote: "Email already exists"
           }
        }
    });

//Validate login form
    $("#loginForm").validate({
        rules:{

            email:{
                required:true,
                email:true
            },
            password:{
                required:true
            }
        },
        messages:{

            email:{
                required:"Please enter your email",
                email: "Please enter valid email"
            },
            password: {
                required: "Please provide your password"
            }
        }
    });

    //Validate account details form
    $("#accountForm").validate({
        rules:{
            name:{
                required:true,
                minlength:2,
                accept:"[a-zA-Z]+"
            },
            address:{
                required:true
            },
            city:{
                required:true
            },
            province:{
                required:true
            },
            country:{
                required:true
            },
            pincode:{
                required:true
            },
            mobile:{
                required:true
            }
        },
        messages:{
            name:{
                required: "Please enter your name",
                minlength: "Your name must be atleast 2 characters long",
                accept: "Your name must contain letters only"
            } ,
            address: {
                required: "Please provide your address"
            },
            city: {
                required: "Please provide your city"
            },
            province: {
                required: "Please provide your province"
            },
            country: {
                required: "Please provide your country"
            },
            pincode: {
                required: "Please provide your pincode"
            },
            mobile: {
                required: "Please provide your mobile"
            }

        }
    });

    //Check current user password
    $("#current_pwd").keyup(function(){
       var current_pwd = $(this).val();
       $.ajax({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
          type:'post',
           url:'check-user-pwd',
           data: {current_pwd : current_pwd},
           success:function(resp){
               if(resp == 'false')
               {
                   $("#chkPwd").html("<font color='red'>Current Password is incorrect </font>");
               }else if(resp == 'true'){
                   $("#chkPwd").html("<font color='green'>Current Password is correct </font>");

               }

           },error:function(){
               alert("Error");
           }
       });
    });
    //Validate change password form
    $("#passwordForm").validate({
        rules:{
           current_pwd:{
               required : true,
               minlength:6,
               maxlength:20

           } ,
           new_pwd:{
               required:true,
               minlength:6,
               maxlength:20
           } ,
           confirm_pwd:{
               required: true,
               minlength:6,
               maxlength:20,
               equalTo:"#new_pwd"
           }
        },
        messages:{
            current_pwd:{
                required : "Please enter your current password"
            } ,
            new_pwd:{
                required: "Please enter your new password",
                minlength: "Your password must be atleast 6 characters long",
                maxlength: "Your password can 20 characters long"
            } ,
            confirm_pwd:{
                required: "Please confirm your password"
            }
        }
    });

    $('#myPassword').passtrength({
        minChars: 4,
        passwordToggle:true,
        tooltip:true,
        eyeImg :"/images/frontend_images/eye.svg" // toggle icon
     });

    //Copy billing address to shipping address
    $('#copyAddress').click(function(){
       if(this.checked)
       {
           $("#shipping_name").val($('#billing_name').val());
           $("#shipping_address").val($('#billing_address').val());
           $("#shipping_city").val($('#billing_city').val());
           $("#shipping_province").val($('#billing_province').val());
           $("#shipping_country").val($('#billing_country').val());
           $("#shipping_pincode").val($('#billing_pincode').val());
           $("#shipping_mobile").val($('#billing_mobile').val());
       }else{
           $("#shipping_name").val('');
           $("#shipping_address").val('');
           $("#shipping_city").val('');
           $("#shipping_province").val('');
           $("#shipping_country").val('');
           $("#shipping_pincode").val('');
           $("#shipping_mobile").val('');
       }
    });

});
