var appID = "204122571c0d982";
var region = "us";
var appSetting = new CometChat.AppSettingsBuilder().subscribePresenceForAllUsers().setRegion(region).build();
var sessionID = getURLParameter('sessionid',window.location.href);
CometChat.init(appID, appSetting).then(
  () => {
    console.log("Initialization completed successfully");
	let apiKey = "f0fde460db672d56f3ac59f408ddc39b88d9232a";
	let d = new Date();
	let timestamp = d.getTime();
	var uid = "uid"+timestamp;
	var name = "Testing "+Math.floor(Math.random() * 101);

	var user = new CometChat.User(uid);

	user.setName(name);

	CometChat.createUser(user, apiKey).then(
	    user => {
	        console.log("user created", user);


var UID = uid;
var apiKey = "f0fde460db672d56f3ac59f408ddc39b88d9232a";

			CometChat.login(UID, apiKey).then(
			user => {
			console.log("Login Successful:", { user });


			var GUID = sessionID;
			var groupName = "meeting_"+sessionID;
			var password = "";
			var groupType = CometChat.GROUP_TYPE.PUBLIC;
			var group = new CometChat.Group(GUID, groupName, groupType, password);

			CometChat.createGroup(group).then(
			    group => {
			        console.log("Group created successfully:", group);
			    },
			    error => {
			        console.log("Group creation failed with exception:", error);
			    }
			);


			CometChat.joinGroup(GUID, groupType, password).then(
			  group => {
			    console.log("Group joined successfully:", group);
			  },
			  error => {
			    console.log("Group joining failed with exception:", error);
			  }
			);
			var receiverID = 'supergroup';
			var callType = CometChat.CALL_TYPE.VIDEO;
			var receiverType = CometChat.RECEIVER_TYPE.GROUP;
			console.log('receiverID',receiverID,'UID',UID);
			var call = new CometChat.Call(receiverID, callType, receiverType);

			CometChat.initiateCall(call).then(
			outGoingCall => {
			console.log(call.getSessionId())

			CometChat.startCall(
			sessionID,
			document.getElementById("callScreen"),
			new CometChat.OngoingCallListener({
			onUserJoined: user => {
			/* Notification received here if another user joins the call. */
			console.log("User joined call:", user);
			/* this method can be use to display message or perform any actions if someone joining the call */
			},
			onUserLeft: user => {
			/* Notification received here if another user left the call. */
			console.log("User left call:", user);
			/* this method can be use to display message or perform any actions if someone leaving the call */
			},
			onCallEnded: call => {
			/* Notification received here if current ongoing call is ended. */
			console.log("Call ended:", call);
			/* hiding/closing the call screen can be done here. */
			}
			})
			);



			console.log("Call initiated successfully:", outGoingCall);
			// perform action on success. Like show your calling screen.
			},
			error => {
			console.log("Call initialization failed with exception:", error);
			}
			);

			},
			error => {
			console.log("Login failed with exception:", { error });
			}
			);




    },error => {
        console.log("error", error);
    }
	)
    // You can now call login function.
  },
  error => {
    console.log("Initialization failed with error:", error);
    // Check the reason for error and take appropriate action.
  }
);