var firebaseConfig = {
    apiKey: "AIzaSyBvIB-4iBGILnKN81hNkJVHZNiNWxeui3o",
    authDomain: "dawafast-bw.firebaseapp.com",
    databaseURL: "https://dawafast-bw-default-rtdb.firebaseio.com",
    projectId: "dawafast-bw",
    storageBucket: "dawafast-bw.appspot.com",
    messagingSenderId: "5801660939",
    appId: "1:5801660939:web:83120a78d01944085f2d0e",
    measurementId: "G-7NLTYRJ7GE"
};
firebase.initializeApp(firebaseConfig);
 const messagesRef = firebase.database().ref('messages');

function sendMessage(messageText) {
    const newMessageRef = messagesRef.push();
    newMessageRef.set({
        text: messageText,
        timestamp: firebase.database.ServerValue.TIMESTAMP,
    });
}
messagesRef.on('child_added', (snapshot) => {
    alert(1);

    const message = snapshot.val();
    // Update the UI with the new message
    console.log(message);
});

messagesRef.on('child_added', (snapshot) => {
    alert();
    const message = snapshot.val();
    const messageContainer = document.getElementById('messageContainer');
    const messageElement = document.createElement('p');
    messageElement.textContent = message.text;
    messageContainer.appendChild(messageElement);
});
