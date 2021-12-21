
export class MessagesList {

    constructor(messagesList) {
        this.messagesList = messagesList;
        this.loadLocalStorage();
    }

    addMessage(message) {
        this.messagesList.push(message);
        this.saveLocalStorage();
    }

    saveLocalStorage() {
        localStorage.setItem('messages',JSON.stringify(this.messages));
    }

    loadLocalStorage() {
        this.messages = ( localStorage.getItem('messages') )
                        ? JSON.parse( localStorage.getItem('messages') )
                        : [];
    }

    autoincrementId() {
        return this.messageList.at(-1) +1;
    }
}

