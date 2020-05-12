class pop{
    constructor(){
        let btns = document.getElementById('addUser');
        btns.addEventListener('click', this.showAddUser);
        
        btns = document.getElementsByClassName('close');
        for (let x of btns){
            x.addEventListener('click', this.closeModal);
        }
        
        btns = document.getElementsByClassName('close-ok');
        for (let x of btns){
            x.addEventListener('click', this.refresh);
        }

        let formadd = document.getElementById('add_User');
        formadd.addEventListener('submit',this.onSubmit);

        btns = document.getElementsByClassName('editBtn');
        for(let x of btns){
            x.addEventListener('click',this.showEditUser);
        }

        btns = document.getElementsByClassName('resetBtn');
        for(let x of btns){
            x.addEventListener('click',this.showResPass);
        }

        btns = document.getElementsByClassName('deleteBtn');
        for(let x of btns){
            x.addEventListener('click',this.showDelUser);
        }

        document.querySelector("#modal-del form").addEventListener('submit', function(event){
            event.preventDefault();
            let formElements = event.currentTarget.elements;
            let input = {
                idUser: formElements['idUser'].value,
                posisi: formElements['posisi'].value
            };
            let init = {
                method: 'post',
                headers: {
                    "Content-Type":"application/json"
                },
                body: JSON.stringify(input)
            };
            fetch('user/delete', init).then(response => response.json())
            .then(function(json){
                console.log(json);
                let modal = document.getElementById("response-modal");
                modal.querySelector('h2').textContent = json.status;
                modal.querySelector('span').textContent = json.message;
                modal.style.display = "block";
            });
        });
        let search = document.getElementById('userSearch');
        search.addEventListener('keyup',this.searchfunction);
        let clear = document.getElementById('clear-userSearch');
        clear.addEventListener('click',this.clearfunction);
    }
    
    clearfunction(){
        let input, table, tr, td, i;
        input = document.getElementById('userSearch').value="";
        table = document.getElementById('userData');
        tr = table.getElementsByTagName('tr');
        for(i = 0;i<tr.length;i++){
            if(tr[i].getElementsByTagName('td')){
                tr[i].style.display = "";
            }
        }
    }

    searchfunction(){
        let input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('userSearch');
        filter = input.value.toUpperCase();
        table = document.getElementById('userData');
        tr = table.getElementsByTagName('tr');
        for(i = 0;i<tr.length;i++){
            td = tr[i].getElementsByTagName('td')[3];
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

    showAddUser(){
        document.getElementById('modal-addUser').style.display = 'block';
    }

    showDelUser(event){
        let delModal = document.getElementById('modal-del');
        delModal.style.display = 'block';
        let form = delModal.querySelector('form');
        let formElements = form.elements;
        let sourceElements = event.currentTarget.parentNode.elements;
        document.getElementById('namaUser-del').textContent = sourceElements['nama'].value;
        formElements['idUser'].value = sourceElements['idUser'].value;
        formElements['posisi'].value = sourceElements['posisi'].value;
    }

    showEditUser(event){
        let editModal = document.getElementById('modal-edit');
        editModal.style.display = 'block';
        let formElements = editModal.querySelector('form').elements;
        let sourceElements = event.currentTarget.parentNode.elements;
        formElements['idUser'].value = sourceElements['idUser'].value;
        formElements['posisi'].value = sourceElements['posisi'].value;
        formElements['edit-email'].value = sourceElements['email'].value;
        formElements['edit-nama'].value = sourceElements['nama'].value;
        formElements['edit-ttl'].value = sourceElements['ttl'].value;
        formElements['edit-alamat'].value = sourceElements['alamat'].value;
    }

    showResPass(event){
        let formElements = event.currentTarget.parentNode.elements;
        let input ={
            "idUser": formElements['idUser'].value,
            "posisi": formElements['posisi'].value,
            "nama": formElements['nama'].value
        };
        let init = {
            method:'post',
            headers:{
                "Content-Type":"application/json"
            },
            body: JSON.stringify(input)
        };
        // let resetModal = document.getElementById('modal-res');
        // resetModal.style.display = 'block';
        fetch('user/reset',init).then(response => response.json()).then(function(json){
            let res = document.getElementById("modal-res");
            if (json.status==='success'){
                res.querySelector('#response-message').textContent = 'Success!';
                res.querySelector('#namaUser-res').textContent = json.name;
                res.querySelector('#res-pass').textContent = json.password;
            } else {
                res.querySelector('#response-message').textContent = 'An Error Has Occured!';

            }
            res.style.display = 'block';
            console.log(json);
        });
    }

    onSubmit(event){
        event.preventDefault();
        let formElements = event.currentTarget.elements;
        let submitButton = event.currentTarget.querySelector('#tambahkan');
        submitButton.disabled = true;
        let input ={
            "posisi": formElements['posisi'].value,
            "email": formElements['email'].value,
            "nama": formElements['nama'].value,
            "ttl": formElements['ttl'].value,
            "alamat": formElements['alamat'].value
        };
        let init = {
            method:'post',
            headers:{
                "Content-Type":"application/json"
            },
            body: JSON.stringify(input)
        };
        fetch('user/add',init).then(response => response.json()).then(function(json){
            console.log(json);
            let res = document.getElementById("modal-pass");
            let resContainer = res.querySelector('#response-content');
            if (json.status==='success'){
                res.querySelector('#response-message').textContent = 'Success!';
                let bold = document.createElement('strong');
                bold.textContent = json.password;
                resContainer.textContent = "Password untuk " + json.name + ": ";
                resContainer.appendChild(bold);
                resContainer.appendChild(document.createElement('br'));
                let text = document.createTextNode("Berikan passwordnya pada user");
                resContainer.appendChild(text);
                resContainer.appendChild(document.createElement('br'));
            } else {
                res.querySelector('#response-message').textContent = 'An Error Has Occured!';
                resContainer.textContent = json.message;
                resContainer.appendChild(document.createElement('br'));
            }
            res.style.display = 'block';
        });
    }

    closeModal(event){
        event.target.parentNode.parentNode.style.display = 'none';
    }

    refresh(){
        location.reload();
    }
}
new pop();