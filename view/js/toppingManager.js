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

        btns = document.getElementsByClassName('close-ok');
        for (let x of btns){
            x.addEventListener('click', function(){location.reload();});
        }

        document.querySelector('#modal-delTopping form').addEventListener('submit', function(event){
            event.preventDefault();
            let formElements = event.currentTarget.elements;
            let input = {
                idTopping: formElements['idTopping'].value
            };
            let init = {
                method: 'post',
                headers: {
                    "Content-Type":"application/json"
                },
                body: JSON.stringify(input)
            };
            fetch('topping/delete', init).then(response => response.json())
            .then(function(json){
                console.log(json);
                let modal = document.getElementById("response-modal");
                modal.querySelector('h2').textContent = json.status;
                modal.querySelector('span').textContent = json.message;
                modal.style.display = "block";
            });
        });
        let search = document.getElementById('toppingSearch');
        search.addEventListener('keyup',this.searchfunction);
        
    }

    searchfunction(){
        let input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('toppingSearch');
        filter = input.value.toUpperCase();
        table = document.getElementById('toppingData');
        tr = table.getElementsByTagName('tr');
        for(i = 0;i<tr.length;i++){
            td = tr[i].getElementsByTagName('td')[2];
            if(td){
                txtValue = td.textContent||td.innerText;
                if(txtValue.toUpperCase().indexOf(filter)>-1){
                    tr[i].style.display = "";
                }
                else{
                    tr[i].style.display = 'none';
                }
            }
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
        editModal.querySelector('img').src = "../asset/img/topping/" + sourceElements['gambarTopping'].value;
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