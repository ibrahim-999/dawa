// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    // apiKey: "AIzaSyDlEj4dGlJxxc3pTD9SpbTioIt78wrzODI",
    // authDomain: "dawafast-14c07.firebaseapp.com",
    // projectId: "dawafast-14c07",
    // storageBucket: "dawafast-14c07.appspot.com",
    // messagingSenderId: "77358708914",
    // appId: "1:77358708914:web:7cfbea4d6c32a2016d71ab",
    // measurementId: "G-X9KGVP77RE"
    apiKey: "AIzaSyBvIB-4iBGILnKN81hNkJVHZNiNWxeui3o",
    authDomain: "dawafast-bw.firebaseapp.com",
    projectId: "dawafast-bw",
    storageBucket: "dawafast-bw.appspot.com",
    messagingSenderId: "5801660939",
    appId: "1:5801660939:web:83120a78d01944085f2d0e",
    measurementId: "G-7NLTYRJ7GE"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});