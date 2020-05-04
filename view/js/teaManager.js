class pop{
    constructor(){
        let btns = document.getElementById('addTea');
        btns.addEventListener('click', this.showAddTea);
        
        btns = document.getElementsByClassName('close');
        for (let x of btns){
            x.addEventListener('click', this.closeModal);
        }

        btns = document.getElementsByClassName("updateTeaBtn");
        for(let x of btns){
            x.addEventListener('click',this.showUpdateTea);
        }
        
        btns = document.getElementsByClassName("deleteTeaBtn");
        for(let x of btns){
            x.addEventListener('click',this.showDeleteTea);
        }
    }

    showAddTea(){
        document.getElementById('modal-addTea').style.display = 'block';
    }

    showUpdateTea(event){
        let editModal = document.getElementById('modal-updateTea');
        editModal.style.display = 'block';
        let formElements = editModal.querySelector('form').elements;
        let sourceElements = event.currentTarget.parentNode.elements;
        formElements['update-nama'].value = sourceElements['namaTeh'].value;
        formElements['update-reg'].value = sourceElements['regular'].value;
        formElements['update-large'].value = sourceElements['large'].value;
    }

    showDeleteTea(event){
        let delModal = document.getElementById('modal-delTea');
        delModal.style.display = 'block';
        let formElements = delModal.querySelector('form').elements;
        let sourceElements = event.currentTarget.parentNode.elements;
        document.getElementById('namaTeh-del').textContent = sourceElements['namaTeh'].value;
        formElements['idTeh'].value = sourceElements['idTeh'].value;
    }

    closeModal(event){
        event.target.parentNode.parentNode.style.display = 'none';
    }
}
new pop();