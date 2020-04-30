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
            x.addEventListener('click',);
        }
    }

    showAddUser(){
        document.getElementById('modal-addUser').style.display = 'block';
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