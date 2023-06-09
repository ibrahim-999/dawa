     var firebaseConfig = {
    apiKey: "YOUR_API_KEY",
    authDomain: "YOUR_AUTH_DOMAIN",
    databaseURL: "YOUR_DATABASE_URL",
    projectId: "YOUR_PROJECT_ID",
    storageBucket: "YOUR_STORAGE_BUCKET",
    messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
    appId: "YOUR_APP_ID"
};
    firebase.initializeApp(firebaseConfig);
     var messagesRef = firebase.database().ref('messages');
     messagesRef.on('child_added', function(snapshot) {
         var message = snapshot.val();
         console.log('New message:', message);
     });
