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
    }

    showAddUser(){
        document.getElementById('modal-addUser').style.display = 'block';
    }

    showDelUser(event){
        console.log('hello');
        let delModal = document.getElementById('modal-del');
        delModal.style.display = 'block';
        let formElements = delModal.querySelector('form').elements;
        let sourceElements = event.currentTarget.parentNode.elements;
        document.getElementById('namaUser-del').textContent = sourceElements['nama'].value;
        formElements['idUser'].value = sourceElements['idUser'].value;
        formElements['posisi'].value = sourceElements['posisi'].value;
    }

    showEditUser(event){
        let editModal = document.getElementById('modal-edit');
        editModal.style.display = 'block';
        let formElements = delModal.querySelector('form').elements;
        let sourceElements = event.currentTarget.parentNode.elements;
        formElements['edit-email'].value = sourceElements['email'].value;
        formElements['edit-nama'].value = sourceElements['nama'].value;
        formElements['edit-ttl'].value = sourceElements['ttl'].value;
        formElements['edit-alamat'].value = sourceElements['alamat'].value;
    }

    showResPass(event){
        let formElements = event.target.parentNode.elements;
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
            let res = document.getElementById("modal-pass");
            if (json.status==='success'){
                res.querySelector('#response-message').textContent = 'Success!';
                res.querySelector('#namaUser').textContent = json.name;
                res.querySelector('#pass').textContent = json.password;
            } else {
                res.querySelector('#response-message').textContent = 'An Error Has Occured!';

            }
            res.style.display = 'block';
            console.log(json);
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