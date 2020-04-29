class pop{
    constructor(){
        let btns = document.getElementById('addUser');
        btns.addEventListener('click', this.showAddUser);
        
        btns = document.getElementsByClassName('close');
        for (let x of btns){
            x.addEventListener('click', this.closeModal);
        }
        
        let formadd = document.getElementById('add_User');
        formadd.addEventListener('submit',this.onSubmit);
    }

    showAddUser(){
        document.getElementById('modal-addUser').style.display = 'block';
    }
    
    onSuccess(response){
        return response.text();
    }
     
    showResult(text){
        res = document.getElementById("modal-pass");
        res.textContent = text;
        res.style.display = 'block';
    }

    onSubmit(event){
        event.preventDefault();
        let formElements = event.currentTarget.elements;
        let name = formElements['name'].value;
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
        fetch('user/add',init).then(this.onSuccess).then(this.showResult);
    }

    closeModal(event){
        event.target.parentNode.parentNode.style.display = 'none';
    }
}
new pop();