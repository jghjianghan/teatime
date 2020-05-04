class pop{
    constructor(){
        let btns = document.getElementById('addTopping');
        btns.addEventListener('click', this.showAddTopping);
        
        btns = document.getElementsByClassName('close');
        for (let x of btns){
            x.addEventListener('click', this.closeModal);
        }
        
        btns = document.getElementsByClassName('updateToppingBtn');
        for(let x of btns){
            x.addEventListener('click',this.showUpdateTopping);
        }

        btns = document.getElementsByClassName('deleteToppingBtn');
        for(let x of btns){
            x.addEventListener('click',this.showDeleteTopping);
        }
    }

    showAddTopping(){
        document.getElementById('modal-addTopping').style.display = 'block';
    }

    showUpdateTopping(event){
        let editModal = document.getElementById('modal-updateTopping');
        editModal.style.display = 'block';
        let formElements = editModal.querySelector('form').elements;
        let sourceElements = event.currentTarget.parentNode.elements;
        formElements['idTopping'].value = sourceElements['idTopping'].value;
        formElements['foto'].value = sourceElements['gambarTopping'].value;
        formElements['update-nama'].value = sourceElements['namaTopping'].value;
        formElements['update-harga'].value = sourceElements['hargaTopping'].value;
    }

    showDeleteTopping(event){
        let delModal = document.getElementById('modal-delTopping');
        delModal.style.display = 'block';
        let formElements = delModal.querySelector('form').elements;
        let sourceElements = event.currentTarget.parentNode.elements;
        document.getElementById('namaTopping-del').textContent = sourceElements['namaTopping'].value;
        formElements['idTopping'].value = sourceElements['idTopping'].value;
    }

    closeModal(event){
        event.target.parentNode.parentNode.style.display = 'none';
    }
}
new pop();