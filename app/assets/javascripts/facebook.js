//setup global hook
FacebookLoad = $.Deferred();


var basepath = "//test.secure.dev/event/invite/";
var scorepath = "//test.secure.dev/event/invite/";
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


function doGetInfo() {
	FB.init({
      appId      : '850948594931878', // App ID
      channelUrl : basepath + 'channel.php', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true,  // parse XFBML
      frictionlessRequests:true
    });

    FB.Canvas.setSize({height: 1500});

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
			FB.api('/me', {access_token:FacebookData.accessToken}, function(response) {
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

                doListFriend();

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
		url: jsHost + "//test.secure.dev/user/autocreate",
		type: "POST",//Mặc định là GET
		data: {uid:uid, username:name, name:username, first_name:first, middle_name:middle, last_name:last, birthday:birthday, hometown:hometown, gender:gender, email:email, link:link},
		success:function(data, textStatus, jqXHR)
		{
			alert(data);
		},
		error:function(jqXHR, textStatus, errorThrown)
		{
			alert('Server quá tải, xin bạn vui lòng thử lại');
		}
    });
}

var isLoaded = false;
function loadFacebookInfo() {
	//alert(title);
	if(isLoaded) { doGetInfo(); }
	else {
		// Load the SDK Asynchronously
		(function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));

		window.fbAsyncInit = function() {
			isLoaded = true;
			doGetInfo();
		};
	}
}

function doInviteFriend() {
	FB.api('/me/friends', {access_token:FacebookData.accessToken}, function(response) {
		if (!response || response.error) {
			//alert('Error occured');
		} else {
			//alert('Friend Data: ' + response.data);
			var data = response.data;
			var str_to = '';
			var count = 0;
			$.each(data,function(index,friend) {
				str_to = str_to + friend.id + ",";
				count++;
				if(count == 20) return false;
			});
			str_to = str_to.substring(0,str_to.length - 1);
			var mes = "Cơ hội nhận vé xem phim Tarzan 3D miễn phí!";
			FB.ui({method: 'apprequests',
				message: mes,
				to: str_to
			}, function(response){});

		}
	});
}

function doInviteFriendById(friendId) {
    var str_to = friendId + ',';
    var mes = "Cơ hội nhận vé xem phim Deliver us from evil miễn phí!";
    FB.ui({method: 'apprequests',
        message: mes,
        to: str_to
    }, function(response){
        //alert(JSON.stringify(response));
        if (response.request !== undefined) {
            //TODO

        } else {
            alert("Bạn chưa gửi lời mời!");
        }
    });
}

function doListFriend() {
    console.log("doListFriend");
    FB.api('/me/friends', {access_token:FacebookData.accessToken}, function(response) {
        if (!response || response.error) {
            //alert('Error occured');
        } else {
            var data = response.data;
            var str_to = '';
            var count = 0;
            $.each(data,function(index,friend) {
                str_to = str_to + "<option value='" + friend.id + "' id='" + friend.id + "'>" + friend.name + "</option>";
                count++;
            });
            $('select#planets').html(str_to);
            $('select#planets').listbox({'searchbar': true});
        }
    });
}

function doPostScore(score) {
	var jsHost = (("https:" == document.location.protocol) ? "https:" : "http:");
	var params = {};
	params.access_token = FacebookData.accessToken;
	//params.caption = "Chúc mừng bạn đã tạo Scandal thành công với chiêu thức " + note;
	params.message = "Đón xem Tarzan 3D!\n";
	var picture = jsHost + basepath + "images/eotw_share_image.jpg";
	params.picture = picture;
	params.link = "http://on.fb.me/1bFLe76";
	params.name = FacebookData.username + " đã đạt được " + score + " điểm";
	params.caption = FacebookData.username + " đã đạt được " + score + " điểm";
	params.description = "Tham gia fanpage GalaxyFilm! Link game: http://on.fb.me/1bFLe76";
	FB.api('/me/feed', 'post', params, function(response) {
		if (!response || response.error) {
			//console.log('Error occured ' + response.error.message);
		} else {
			//console.log("Đăng điểm lên tường thành công!");
		}
	});

	doInviteFriend();

}

function doPostImage(fileName) {
	//Đăng ảnh lên tường của người dùng
	console.log("doPostImage:" + fileName);
	var jsHost = (("https:" == document.location.protocol) ? "https:" : "http:");
	var params = {};
	params.access_token = FacebookData.accessToken;
	//params.caption = "Chúc mừng bạn đã tạo Scandal thành công với chiêu thức " + note;
	params.name = "Ảnh dự thi Tarzan 3D của " + FacebookData.username + "\nTham gia cuộc thi chụp hình Tarzan 3D tại fanpage: https://www.facebook.com/GalaxyFilm \nHoặc truy cập trực tiếp ứng dụng: http://on.fb.me/1bFLe76";
	var url = jsHost + "//depdocdao.vn/galaxy/tarzanphoto/postcard/" + fileName + ".jpg";
	params.url = url;
	console.log("doPostImage:" + params.url);

	/*
	FB.api('/me/photos', 'post', params, function(response) {
		if (!response || response.error) {
			//alert('Error occured: ' + response.error.message);
			alert('Đăng ảnh lên tường không thành công, xin bạn vui lòng thử lại');
		} else {
			alert("Đăng lên tường thành công!");
		}
	});*/

	//Đang ảnh vào album dự thi của Page
	doPostImageToGalaxy(fileName);

	//Store thông tin dự thi ở server
	doPostDataToServer(fileName);

	//Mời bạn
	doInviteFriend();

}


function doPostImageToGalaxy(fileName) {
	console.log("doPostImageToGalaxy:" + fileName);
	var jsHost = (("https:" == document.location.protocol) ? "https:" : "http:");
	var params = {};
	//Galaxy: CAAICXp7w4sMBALVYlkvaW87b59KHby9vMXRHKYP6JmEfyLlD3MbZBUzVheFTUdNrLeeYol4G6Kbc7Y8YpMGg2Jo1ZBgyyZCxRSGFuWuOeZAd8YfOJEHJGyw3kcO5ZBmTZAENxfvGZAt6gz3rZBON1pRu2BZAve3x4rnZA3yp00AbQZC0cYknD9IgksolRg3Bll1mf4ZD
	params.access_token = "CAAICXp7w4sMBANEYwJaigjvKCmZC9KUkvMw5mRgRtZBkx2s2CBiBZCgWO11umZCmWMbOvqhy5L8vun3XGjo8GGpJ2KYLTEwpaZARRNaBnpWZCmv5CuV9PgVX42RuGe2yjDExrsgGxMvs7hsb7IGPM4ZB2tQZArSvZCeISyhzwIjhoc9ASPsMZCcDBgsAq3iu7DqxMZD";
	params.name = "Ảnh dự thi Tarzan 3D của " + FacebookData.username + "(" + FacebookData.ulink + ")";
	//params.message = FacebookData.username + " vừa xì trum thành công ảnh dự thi Xì trum 2!";
	var url = jsHost + "//depdocdao.vn/galaxy/tarzanphoto/postcard/" + fileName + ".jpg";
	params.url = url;
	FB.api('/537415253021755/photos', 'post', params, function(response) {
		if (!response || response.error) {
			//alert('Error occured: ' + response.error.message);
			alert('Đăng ảnh dự thi không thành công, xin bạn vui lòng thử lại');
		} else {
			alert("Đăng ảnh dự thi thành công!");
		}
	});
}

function doPostDataToServer(fileName) {
	var jsHost = (("https:" == document.location.protocol) ? "https:" : "http:");
	$.ajax({
		url: jsHost + "//depdocdao.vn/galaxy/tarzanphoto/xml.php",
		type: "POST",//Mặc định là GET
		data: {uid:FacebookData.uid, username:FacebookData.username, filename:fileName, link:FacebookData.ulink},
		success:function(data, textStatus, jqXHR)
		{
			//alert("Success!");
		},
		error:function(jqXHR, textStatus, errorThrown)
		{
			alert('Server quá tải, xin bạn vui lòng thử lại');
		}
    });
}

//Start load fb info
loadFacebookInfo();

$( document ).ready(function() {
    $('button#button-invite').click(function() {
        var friendId = $('select#planets').find(":selected").attr('id');
        if (friendId !== undefined) {
            doInviteFriendById(friendId);
        } else {
            alert ("Bạn chưa chọn người bạn nào!");
        }

    });
});
