//setup global hook
FacebookLoad = $.Deferred();


var basepath = "//tibu.tk/viralcms/public/";
var scorepath = "//tibu.tk/viralcms/public/";
var secret = "60176de80913eaeb5eaba70f79c8fe39";


function doGetInfo() {
    //$('#pleaseWaitDialog').modal();
    FB.init({
        appId: '631750210234079', // App ID
        channelUrl: basepath + 'channel.php', // Channel File
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true, // parse XFBML
        frictionlessRequests: true
    });

    FB.Canvas.setAutoGrow();

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