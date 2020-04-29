class pop{
    constructor(){
        let btns = document.getElementById('addUser');
        btns.addEventListener('click', this.showAddUser);
        
        btns = document.getElementsByClassName('close');
        for (let x of btns){
            x.addEventListener('click', this.closeModal);
        }
        
        btns = document.getElementById('tambahkan');
        for(let x of btns){
            x.addEventListener('click', this.showPassUser);
        }
        
    }

    showAddUser(){
        document.getElementById('modal-addUser').style.display = 'block';
    }

    showPassUser(event){
        let x = document.getElementById('modal-pass')
        x.style.display = 'block';
        let node = event.target.parentNode.parentNode.previousSibling.previousSibling;
        let nama = node.textContent;
        let pass = node.previousSibling.textContent;
        x.querySelector('#namaUser').textContent = nama;
        x.querySelector('#pass').textContent = pass;

    }

    closeModal(event){
        event.target.parentNode.parentNode.style.display = 'none';
    }
}
new pop();