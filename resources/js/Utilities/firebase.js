import app from "firebase/app";
import "firebase/firestore";
import "firebase/database";
import "firebase/storage";

const config = {
    apiKey: "AIzaSyBDMCrPnK419xIp9xXv_0qt6aATe83_MWo",
    authDomain: "ebarter-chat.firebaseapp.com",
    projectId: "ebarter-chat",
    storageBucket: "ebarter-chat.appspot.com",
    messagingSenderId: "570939177116",
    appId: "1:570939177116:web:399154edbbea956ccdd559",
    measurementId: "G-18PGJYLLWS",
};

app.initializeApp(config);

export const firebase = app;
export const db = app.firestore();
export const storageRef = app.storage().ref();

export const usersRef = db.collection("users");
export const roomsRef = db.collection("chatRooms");
export const messagesRef = (roomId) =>
    roomsRef.doc(roomId).collection("messages");

export const filesRef = storageRef.child("files");

export const dbTimestamp = firebase.firestore.FieldValue.serverTimestamp();
export const deleteDbField = firebase.firestore.FieldValue.delete();
