class pop{
    constructor(){
        let btns = document.getElementById('addUser');
        btns.addEventListener('click', this.showAddUser);
        
        btns = document.getElementsByClassName('close');
        for (let x of btns){
            x.addEventListener('click', this.closeModal);
        }
        btns = document.getElementById('addTea');
        btns.addEventListener('click',this.showAddTea);
    }

    showAddUser(){
        document.getElementById('modal-addUser').style.display = 'block';
    }
    showAddTea(){
        document.getElementById('modal-addTea').style.display = 'block';
    }
    showAddTopping(){
        document.getElementById('modal-addTopping').style.display = 'block';
    }
    closeModal(event){
        event.target.parentNode.parentNode.style.display = 'none';
    }
}
new pop();