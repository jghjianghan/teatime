class ChangePassNotif{
    constructor(){
        console.log('hello');
        this.modal = document.createElement('div');
        this.modal.className = 'modal';
        let container = document.createElement('div');
        let h2 = document.createElement('h2');
        h2.textContent = 'Notice';
        container.appendChild(h2);
        let span = document.createElement('span');
        span.innerHTML = "This is your first time logged in. Do you want to change your password now?";
        container.appendChild(span);
        
        let div = document.createElement('div');

        let link = document.createElement('a');
        let button = document.createElement('button');
        button.textContent = "Yes";
        link.appendChild(button);
        link.href = 'changePassword';
        div.appendChild(link);

        div.id = "button-group";
        link = document.createElement('a');
        button = document.createElement('button');
        button.textContent = "Later";
        this.hideModal = this.hideModal.bind(this);
        link.appendChild(button);
        link.addEventListener('click', this.hideModal);
        div.appendChild(link);

        container.appendChild(div);

        this.modal.appendChild(container);
        document.getElementById('wrapper').appendChild(this.modal);

        this.modal.style.display = 'block';
    }
    hideModal(event){
        event.preventDefault();
        this.modal.style.display = 'none';
    }
}
new ChangePassNotif();