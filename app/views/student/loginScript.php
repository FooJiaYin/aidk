<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://apis.google.com/js/api:client.js"></script>
<script>
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
        });
    };

    function attachSignin(element) {
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
        var fd = new FormData();
        fd.append('loginBy', loginBy);
        fd.append('token', token);
        fd.append('email', email);
        fetch("/student/snsLogin", {
                method: 'POST',
                body: fd
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error(response.statusText);
                }
                return response.json();
            }).then((result) => {
                if (result.result)
                    window.location.replace("/");
                else
                    alert("帳號尚未連結或者非使用此社群網註冊，請選擇正確的社群入口進行登入！");
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

    $(function() {
        startApp();
    });
</script>