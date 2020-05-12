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

        btns = document.getElementsByClassName('close-ok');
        for (let x of btns){
            x.addEventListener('click', function(){location.reload();});
        }

        document.querySelector('#modal-delTea form').addEventListener('submit', function(event){
            event.preventDefault();
            let formElements = event.currentTarget.elements;
            let input = {
                idTeh: formElements['idTeh'].value
            };
            let init = {
                method: 'post',
                headers: {
                    "Content-Type":"application/json"
                },
                body: JSON.stringify(input)
            };
            fetch('tea/delete', init).then(response => response.json())
            .then(function(json){
                console.log(json);
                let modal = document.getElementById("response-modal");
                modal.querySelector('h2').textContent = json.status;
                modal.querySelector('span').textContent = json.message;
                modal.style.display = "block";
            });
        });
        let search = document.getElementById('teaSearch');
        search.addEventListener('keyup',this.searchfunction);
        let clear = document.getElementById('clear-teaSearch');
        clear.addEventListener('click',this.clearfunction);
    }

    clearfunction(){
        let input, table, tr, td, i;
        input = document.getElementById('teaSearch').value="";
        table = document.getElementById('teaData');
        tr = table.getElementsByTagName('tr');
        for(i = 0;i<tr.length;i++){
            if(tr[i].getElementsByTagName('td')){
                tr[i].style.display = "";
            }
        }
    }

    searchfunction(){
        let input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('teaSearch');
        filter = input.value.toUpperCase();
        table = document.getElementById('teaData');
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

    showAddTea(){
        document.getElementById('modal-addTea').style.display = 'block';
    }

    showUpdateTea(event){
        let editModal = document.getElementById('modal-updateTea');
        editModal.style.display = 'block';
        let formElements = editModal.querySelector('form').elements;
        let sourceElements = event.currentTarget.parentNode.elements;
        formElements['idTeh'].value = sourceElements['idTeh'].value;
        editModal.querySelector('img').src = "../asset/img/tea/" + sourceElements['gambarTeh'].value;
        formElements['update-nama'].value = sourceElements['namaTeh'].value;
        formElements['update-reg'].value = sourceElements['regular'].value;
        formElements['update-large'].value = sourceElements['large'].value;
    }

    showDeleteTea(event){
        let delModal = document.getElementById('modal-delTea');
        delModal.style.display = 'block';
        let form = delModal.querySelector('form');
        let formElements = form.elements;
        let sourceElements = event.currentTarget.parentNode.elements;
        document.getElementById('namaTeh-del').textContent = sourceElements['namaTeh'].value;
        formElements['idTeh'].value = sourceElements['idTeh'].value;
    }

    closeModal(event){
        event.target.parentNode.parentNode.style.display = 'none';
    }
}
new pop();