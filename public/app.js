document.addEventListener("DOMContentLoaded", event => {

    const app = firebase.app();
    const db = firebase.firestore();
    const chatHistory = firebase.firestore();

    chatHistory.onSnapshot(doc => {
        const chatData = doc.data();
        document.write(data.displayName + `<br>`)
        document.write(d + `<br>`)
    })
});