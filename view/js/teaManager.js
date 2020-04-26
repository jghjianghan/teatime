class pop{
    constructor(){
        let btns = document.getElementById('addTea');
        btns.addEventListener('click', this.showAddTea);
        
        btns = document.getElementsByClassName('close');
        for (let x of btns){
            x.addEventListener('click', this.closeModal);
        }
        
        
    }

    showAddTea(){
        document.getElementById('modal-addTea').style.display = 'block';
    }

    closeModal(event){
        event.target.parentNode.parentNode.style.display = 'none';
    }
}
new pop();