class pop{
    constructor(){
        let btns = document.getElementById('addTopping');
        btns.addEventListener('click', this.showAddTopping);
        
        btns = document.getElementsByClassName('close');
        for (let x of btns){
            x.addEventListener('click', this.closeModal);
        }
        
        
    }

    showAddTopping(){
        document.getElementById('modal-addTopping').style.display = 'block';
    }

    closeModal(event){
        event.target.parentNode.parentNode.style.display = 'none';
    }
}
new pop();