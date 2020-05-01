class pop{
    constructor(){
        let btns = document.getElementById('addTea');
        btns.addEventListener('click', this.showAddTea);
        
        btns = document.getElementsByClassName('close');
        for (let x of btns){
            x.addEventListener('click', this.closeModal);
        }
        
        btns = document.getElementById("deleteBtn");
        for(let x of btns){
            x.addEventListener('click',this.showDeleteTea);
        }
    }

    showAddTea(){
        document.getElementById('modal-addTea').style.display = 'block';
    }

    showDeleteTea(){
        document.getElementsById('modal-delTea').style.display = 'block';
        
        // let node = event.target.parentNode.parentNode.previousSibling.previousSibling; 
        // let namaTeh = node.previousSibling.textContent;
        // nama.querySelector("input[name='idTeh']").value = event.target.previousElementSibling.value;
        // nama.querySelector('#namaTeh').textContent = namaTeh;
    }

    closeModal(event){
        event.target.parentNode.parentNode.style.display = 'none';
    }
}
new pop();