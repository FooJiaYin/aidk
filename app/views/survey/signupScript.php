<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://apis.google.com/js/api:client.js"></script>
<script language='javascript'>
    const google_client_id = "<?=SNS_GOOGLE_CLIENT_ID?>";
    const fb_app_id = "<?=SNS_FB_APP_ID?>";
    const fb_api_version = "<?=SNS_FB_API_VERSION?>";
    var googleUser = {};
    var startApp = function() {
        gapi.load('auth2', function() {
            auth2 = gapi.auth2.init({
                client_id: google_client_id,
                cookiepolicy: 'single_host_origin',
            });
            attachSignin(document.getElementById('Glogin'));
            attachSignin(document.getElementById('GSignup'));
        });
    };

    function attachSignin(element) {
        if ($(element).data("do") == "signup") {
            auth2.attachClickHandler(element, {},
                function(googleUser) {
                    console.log("Signed in: " + googleUser.getBasicProfile().getEmail());
                    var token = googleUser.getBasicProfile().getId();
                    var email = googleUser.getBasicProfile().getEmail();
                    var name = googleUser.getBasicProfile().getName();
                    snsSignupcheck("GOOGLE", token, email, name);
                },
                function(error) {
                    console.log(JSON.stringify(error, undefined, 2));
                });
        } else {
            auth2.attachClickHandler(element, {},
                function(googleUser) {
                    console.log("Signed in: " + googleUser.getBasicProfile().getEmail());
                    var token = googleUser.getBasicProfile().getId();
                    var email = googleUser.getBasicProfile().getEmail();
                    snsLogin("GOOGLE", token, email);
                },
                function(error) {
                    console.log(JSON.stringify(error, undefined, 2));
                });
        }
    }

    window.fbAsyncInit = function() {
        FB.init({
            appId: fb_app_id,
            cookie: true,
            xfbml: true,
            version: fb_api_version
        });

        FB.AppEvents.logPageView();

    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function snsLogin(loginBy, token, email) {
        console.log("Do SNS login");
        $("#loginBy").val(loginBy);
        $("#login_account").val(email);
        $("#login_password").val(token);
        $("#login_form").submit();
    }

    function snsSignupcheck(loginBy, token, email, name) {
        console.log("Do SNS signup check");
        var fd = new FormData();
        fd.append('loginBy', loginBy);
        fd.append('token', token);
        fd.append('email', email);
        fetch("/survey/snsSignupCheck", {
                method: 'POST',
                body: fd
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error(response.statusText);
                }
                return response.json();
            }).then((result) => {
                if (result.result) {
                    $("#signup_email").val(email).attr("readonly", "readonly");
                    $("#signup_name").val(name);
                    $("#password").attr("placeholder", "此密碼用於直接使用email登入，非社群帳號密碼");
                    $("#login_form").hide();
                    $(".snsSignup").hide();
                    $(".snsSignup2").show();
                    if (loginBy == "GOOGLE") {
                        $("#google_token").val(token);
                        //alert("GOOGLE!");
                    } else if (loginBy == "FB") {
                        $("#fb_token").val(token);
                        //alert("FB!");
                    }
                } else {
                    alert("Email帳號已存在或該社群帳號已連動，請直接使用對應的社群連結登入！");
                }
            });
    }

    $("#FBlogin").click(function() {
        FB.getLoginStatus(function(response) {
            console.log("FB Status");
            if (response.authResponse) {
                console.log("Auth!");
                FB.api('/me', {
                    fields: 'id,name,email'
                }, function(response) {
                    snsLogin("FB", response.id, response.email);
                });
            } else {
                console.log("Call FB.login");
                FB.login(function(response) {
                    if (response.authResponse) {
                        FB.api('/me', {
                            fields: 'id,name,email'
                        }, function(response) {
                            //console.log(response);
                            snsLogin("FB", response.id, response.email);
                        });
                    }
                }, {
                    scope: 'email'
                });
            }
        });
    });

    $("#FBSignup").click(function() {
        FB.getLoginStatus(function(response) {
            console.log("FB Status");
            if (response.authResponse) {
                console.log("Auth!");
                FB.api('/me', {
                    fields: 'id,name,email'
                }, function(response) {
                    snsSignupcheck("FB", response.id, response.email, response.name);
                });
            } else {
                console.log("Call FB.Signup");
                FB.login(function(response) {
                    if (response.authResponse) {
                        FB.api('/me', {
                            fields: 'id,name,email'
                        }, function(response) {
                            //console.log(response);
                            snsSignupcheck("FB", response.id, response.email, response.name);
                        });
                    }
                }, {
                    scope: 'email'
                });
            }
        });
    });

    function check(input) {
        if (input.value != document.getElementById('password').value) {
            input.setCustomValidity('兩次密碼不相符！');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }
    $(function() {
        startApp();
        $("#birthday").datepicker({
            changeMonth: true,
            changeYear: true,
            showMonthAfterYear: true,
            dateFormat: 'yy/mm/dd'
        });
    });
</script>
<?php if (isset($_GET['alert']) && $_GET['alert'] == '1') : ?>
    <script>
        alert("<?= $_GET['msg'] ?>");
        <?php if (isset($_GET['redirect'])) : ?>
            window.location.replace("<?= $_GET['redirect'] ?>");
        <?php else : ?>
            window.location.replace("/survey/signup/");
        <?php endif ?>
    </script>
<?php endif ?>