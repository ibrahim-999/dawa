var firebaseConfig = {
    apiKey: "AAAAAVnOUgs:APA91bERqVmF7tT6G9T-65kRgiHwmpdz2Vl6hdbz0cWc9m3HybKwofoz3UxI7lKaGIBccYxfIVvcrHkn3bT3azIfZugpdtYaFhV-X71F84LN2qfDLRyYVZHOJa6ERayE1V9gNw6U_s1Z",
    authDomain: "YOUR_AUTH_DOMAIN",
    databaseURL: "YOUR_DATABASE_URL",
    projectId: "YOUR_PROJECT_ID",
    storageBucket: "YOUR_STORAGE_BUCKET",
    messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
    appId: "YOUR_APP_ID"
};
firebase.initializeApp(firebaseConfig);
var messagesRef = firebase.database().ref('messages');
messagesRef.on('child_added', function (snapshot) {
    var message = snapshot.val();
    console.log('New message:', message);
});
