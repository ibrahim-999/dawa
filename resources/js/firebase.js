// Import the functions you need from the SDKs you need
import  * as app from "firebase/app";
import * as DB from "firebase/database";

// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyBvIB-4iBGILnKN81hNkJVHZNiNWxeui3o",
    authDomain: "dawafast-bw.firebaseapp.com",
    databaseURL: "https://dawafast-bw-default-rtdb.firebaseio.com",
    projectId: "dawafast-bw",
    storageBucket: "dawafast-bw.appspot.com",
    messagingSenderId: "5801660939",
    appId: "1:5801660939:web:83120a78d01944085f2d0e",
    measurementId: "G-7NLTYRJ7GE"
};

// Initialize Firebase
app.initializeApp(firebaseConfig);
export default DB;




//
// // Import the functions you need from the SDKs you need
// import { initializeApp } from "firebase/app";
// import { getAnalytics } from "firebase/analytics";
// import { getDatabase, ref, onValue} from "firebase/database";
//
// // https://firebase.google.com/docs/web/setup#available-libraries
//
// // Your web app's Firebase configuration
// // For Firebase JS SDK v7.20.0 and later, measurementId is optional
// const firebaseConfig = {
//     apiKey: "AIzaSyBvIB-4iBGILnKN81hNkJVHZNiNWxeui3o",
//     authDomain: "dawafast-bw.firebaseapp.com",
//     databaseURL: "https://dawafast-bw-default-rtdb.firebaseio.com",
//     projectId: "dawafast-bw",
//     storageBucket: "dawafast-bw.appspot.com",
//     messagingSenderId: "5801660939",
//     appId: "1:5801660939:web:83120a78d01944085f2d0e",
//     measurementId: "G-7NLTYRJ7GE"
// };
//
// // Initialize Firebase
// const firebase = initializeApp(firebaseConfig);
// const analytics = getAnalytics(firebase);
// const app = createApp({});
//
// var database = getDatabase();
