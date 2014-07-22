//setup global hook
FacebookLoad = $.Deferred();


var basepath = "//tibu.tk/viralcms/public/";
var scorepath = "//tibu.tk/viralcms/public/";
//var basepath = "//test.secure.dev/";
//var scorepath = "//test.secure.dev/";
var secret = "60176de80913eaeb5eaba70f79c8fe39";

FacebookData = {};
FacebookData.uid = '';
FacebookData.username = '';
FacebookData.name = '';
FacebookData.firstname = '';
FacebookData.middlename = '';
FacebookData.lastname = '';
FacebookData.birthday = '';
FacebookData.hometown = '';
FacebookData.gender = '';
FacebookData.email = '';
FacebookData.ulink = '';
FacebookData.accessToken = '';

function showProgressModal() {
    bootbox.dialog({
        title: "Vui lòng chờ ...",
        message: '<div class="progress progress-striped active"><div class="progress-bar" style="width: 100%"></div></div>'
    });
}

function doGetInfo() {
    //$('#pleaseWaitDialog').modal();
    showProgressModal();
    FB.init({
        appId: '631750210234079', // App ID
        channelUrl: basepath + 'channel.php', // Channel File
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true, // parse XFBML
        frictionlessRequests: true
    });

    // FB.Canvas.setSize({
    //     height: 3500
    // });

    // Additional initialization code here
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            // the user is logged in and has authenticated your
            // app, and response.authResponse supplies
            // the user's ID, a valid access token, a signed
            // request, and the time the access token
            // and signed request each expire
            FacebookData.uid = response.authResponse.userID;
            FacebookData.accessToken = response.authResponse.accessToken;
            FB.api('/me', {
                access_token: FacebookData.accessToken
            }, function(response) {
                FacebookData.username = response.name;
                FacebookData.ulink = response.link;
                FacebookData.name = response.username;
                FacebookData.firstname = response.first_name;
                FacebookData.middlename = response.middle_name;
                FacebookData.lastname = response.last_name;
                FacebookData.birthday = response.birthday;
                if (response.hasOwnProperty('hometown')) {
                    FacebookData.hometown = response.hometown.name;
                } else {
                    FacebookData.hometown = '';
                }
                if (response.hasOwnProperty('location')) {
                    FacebookData.hometown = response.location.name;
                }
                FacebookData.gender = response.gender;
                FacebookData.email = response.email;
                //release lock
                FacebookLoad.resolve();

                submitUserInfo(FacebookData.uid, FacebookData.username, FacebookData.name, FacebookData.firstname, FacebookData.middlename, FacebookData.lastname, FacebookData.birthday, FacebookData.hometown, FacebookData.gender, FacebookData.email, FacebookData.ulink);

                console.log(FacebookData.uid);
                console.log(FacebookData.username);
                console.log(FacebookData.accessToken);

                //doListFriend();

            });

        } else if (response.status === 'not_authorized') {
            // the user is logged in to Facebook,
            // but has not authenticated your app
            //window.top.location = "https://www.facebook.com/dialog/oauth?client_id=138482263019716&redirect_uri=https://apps.facebook.com/138482263019716/";
        } else {
            // the user isn't logged in to Facebook.
            //window.top.location = "https://www.facebook.com/dialog/oauth?client_id=138482263019716&redirect_uri=https://apps.facebook.com/138482263019716/";
        }
    });
}

function submitUserInfo(uid, username, name, first, middle, last, birthday, hometown, gender, email, link) {
    var jsHost = (("https:" == document.location.protocol) ? "https:" : "http:");
    $.ajax({
        url: basepath + "user/autocreate",
        type: "POST", //Mặc định là GET
        data: {
            uid: uid,
            username: name,
            name: username,
            first_name: first,
            middle_name: middle,
            last_name: last,
            birthday: birthday,
            hometown: hometown,
            gender: gender,
            email: email,
            link: link
        },
        success: function(data, textStatus, jqXHR) {
            //alert(JSON.stringify(data));
            //$('#pleaseWaitDialog').modal('hide');
            window.location.href = "/viralcms/public/quiz-contest?userId=" + data.userId;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Server quá tải, xin bạn vui lòng thử lại');
        }
    });
}

var isLoaded = false;

function loadFacebookInfo() {
    //alert(title);
    if (isLoaded) {
        doGetInfo();
    } else {
        // Load the SDK Asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        window.fbAsyncInit = function() {
            isLoaded = true;
            doGetInfo();
        };
    }
}


//Start load fb info
loadFacebookInfo();
//submitUserInfo('100003095200864', 'tran.p.trung.1', 'tran.p.trung.1', '', '', '', '', '', '', 'spiderman.tpt@gmail.com', '');