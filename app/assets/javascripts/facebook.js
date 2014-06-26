//setup global hook
FacebookLoad = $.Deferred();


var basepath = "//tibu.tk/viralcms/public/";
var scorepath = "//tibu.tk/viralcms/public/";
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
    $('#pleaseWaitDialog').modal();
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
		url: basepath + "user/autocreate",
		type: "POST",//Mặc định là GET
		data: {uid:uid, username:name, name:username, first_name:first, middle_name:middle, last_name:last, birthday:birthday, hometown:hometown, gender:gender, email:email, link:link},
		success:function(data, textStatus, jqXHR)
		{
			//alert(JSON.stringify(data));
            $('#pleaseWaitDialog').modal('hide');
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

function doInviteFriendById(friendId, friendName) {
    var str_to = friendId + ',';
    var mes = "Chơi game để có cơ hội nhận vé xem phim Linh Hồn Báo Thù miễn phí ngày 4/7/2014 từ Galaxy Thiên Ngân!";
    FB.ui({method: 'apprequests',
        message: mes,
        to: str_to
    }, function(response){
        //alert(JSON.stringify(response));
        if (response.request !== undefined) {
            //TODO
            doGetInviteCode(friendId, friendName);
        } else {
            alert("Bạn chưa gửi lời mời !!!");

        }
    });
}

function doGetInviteCode(friendId, friendName) {
	$.ajax({
		url: basepath + "invitation/create",
		type: "POST",//Mặc định là GET
		data: {fromId:FacebookData.uid, toId:friendId, toName:friendName},
		success:function(data, textStatus, jqXHR)
		{
			//alert(data);
            if (data.status == "success") {
                alert("Bạn đã nhận được một mã dự thưởng: GLX" + zfill1(data.id, 8) + "");
                doCreatePhoto(data.id, friendName);
            }
            else {
                if (data.message == "exist") {
                    alert("Bạn đã mời tài khoản này rồi. Vui lòng chọn người khác ^^");
                } else {
                    alert('Server quá tải, xin bạn vui lòng thử lại');
                }
            }
		},
		error:function(jqXHR, textStatus, errorThrown)
		{
			alert('Server quá tải, xin bạn vui lòng thử lại');
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

function doGetRank() {
    $('#pleaseWaitDialog').modal();
    $.ajax({
        url:  basepath  + "invitation/rank",
        type: "GET",//Mặc định là GET
        data: {},
        success:function(data, textStatus, jqXHR)
        {
            //alert(JSON.stringify(data));
            var html = '';
            var count = 1;
            $.each(data,function(index, invitation) {
                html =
                html
                + "<tr>"
                + "<td>" + count + "</td>"
                + "<td><a target='_blank' href='https://www.facebook.com/" + invitation.from_id + "'>" + invitation.shortname + "</a></td>"
                + "<td>" + invitation.amount + "</td>"
                + "</tr>";
                count++;
            });
            $('table#table-rank tbody').html(html);
            $('#pleaseWaitDialog').modal('hide');
        },
        error:function(jqXHR, textStatus, errorThrown)
        {
            alert('Server quá tải, xin bạn vui lòng thử lại');
        }
    });
}

function doCreatePhoto(invitationId, friendName) {
    var des = FacebookData.username + " đã mời " + friendName + " tới rạp xem phim kinh dị Deliver Us From Evil - Linh Hồn Báo Thù và có cơ hội trúng tới 10 vé xem phim miễn phí.";
    $.ajax({
        url:  basepath  + "image/create",
        type: "POST",//Mặc định là GET
        data: {invitationId:invitationId, title:'', description:des},
        success:function(data, textStatus, jqXHR)
        {
            //alert(JSON.stringify(data));
            if (data.status == "error") {
                alert('Server quá tải, xin bạn vui lòng thử lại');
            } else {
                var file = data.photo;
                var filepath = basepath + "assets/" + file;
                doPostImage(filepath, friendName);
            }
        },
        error:function(jqXHR, textStatus, errorThrown)
        {
            alert('Server quá tải, xin bạn vui lòng thử lại');
        }
    });
}

function doPostImage(filepath, friendName) {
	//Đăng ảnh lên tường của người dùng
	//console.log("doPostImage:" + fileName);
	var jsHost = (("https:" == document.location.protocol) ? "https:" : "http:");
	var params = {};
	params.access_token = FacebookData.accessToken;
	//params.caption = "Chúc mừng bạn đã tạo Scandal thành công với chiêu thức " + note;
	params.name = "Bạn " + FacebookData.username + " đã mời " + friendName + " đi xem phim Linh Hồn Báo Thù tại Việt Nam ngày 4/7/2014 và có cơ hội trúng tới 10 vé xem phim miễn phí.\nTham gia tại đây: http://on.fb.me/1sHchKC\nTrailer phim: http://bit.ly/1pRjcNM";
	var url = jsHost + filepath;
	params.url = url;
	//console.log("doPostImage:" + params.url);

	FB.api('/me/photos', 'post', params, function(response) {
		if (!response || response.error) {
			//alert('Error occured: ' + response.error.message);
			alert('Đăng ảnh lên tường không thành công, xin bạn vui lòng thử lại');
		} else {
			alert("Đăng lên tường thành công!");
		}
	});

}


//Start load fb info
loadFacebookInfo();

function zfill1(number, size) {
	number = number.toString();
	while (number.length < size) number = "0" + number;
	return number;
}

$( document ).ready(function() {
    $('button#button-invite').click(function() {
        var friendNode = $('select#planets').find(":selected");
        var friendId = friendNode.attr('id');
        var friendName = friendNode.html();
        if (friendId !== undefined) {
            doInviteFriendById(friendId, friendName);
        } else {
            alert ("Bạn chưa chọn người bạn nào!");
        }

    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

	  	var target = $(e.target).attr("href") // activated tab
	 	if(target == '#profile') {
            $('#pleaseWaitDialog').modal();
	 		$.ajax({
				url: basepath + "invitation/lists",
				type: "GET",//Mặc định là GET
				data: {id:FacebookData.uid},
				success:function(data, textStatus, jqXHR)
				{
					var html = '';
					var count = 1;
					$.each(data,function(index, invitation) {
		                html =
		                html
		                + "<tr>"
		                + "<td>" + count + "</td>"
		                + "<td><a target='_blank' href='https://www.facebook.com/" + invitation.to_id + "'>" + invitation.to_name + "</a></td>"
		                + "<td>" + "GLX" + zfill1(invitation.id, 8) + "</td>"
		                + "<td>" + invitation.created_at + "</td>"
		                + "</tr>";
		                count++;
		            });
		            $('table#invitations tbody').html(html);
                    $('#pleaseWaitDialog').modal('hide');
				},
				error:function(jqXHR, textStatus, errorThrown)
				{
					alert('Server quá tải, xin bạn vui lòng thử lại');
				}
		    });
	 	} else if (target == '#rank') {
            doGetRank();
        }
	});
});
