export class Messages
{

    constructor(message_id, author_id, message, created, pubpriv, destinatari)
    {
        this.id = message_id;
        this.author_id = author_id;
        this.message = message;
        this.created = created;
        this.pubpriv = pubpriv;
        this.destinatari = destinatari;
    }
}