document.addEventListener("DOMContentLoaded", event => {

    const app = firebase.app();
    const db = firebase.firestore();
    const chatHistory = db.collection()

    chatHistory.onSnapshot(doc => {
        const chatData = doc.data();
        document.write(data.displayName + `<br>`)
        document.write(data.text + `<br>`)
    })
});