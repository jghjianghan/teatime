class ChangePasswordForm {
    constructor (){
        this.form = document.querySelector('form');
        this.elements = this.form.elements;
        this.oldPass = this.elements['oldPass'];
        this.newPass = this.elements['newPass'];
        this.confirmPass = this.elements['confirmPass'];
        this.messageContainer = this.form.querySelector('p.msg');

        this.validate = this.validate.bind(this);
        this.form.addEventListener('submit', this.validate);

        this.modal = document.querySelector('.modal');
        this.refresh = this.refresh.bind(this);
        this.button = this.form.querySelector('button');
        this.modal.querySelector('button').addEventListener('click', this.refresh);
        this.showModal = this.showModal.bind(this);

        let userInfo = document.querySelector('#account-info span:first-child');
        this.userId = userInfo.dataset.id;
        this.userRole = userInfo.dataset.role;

        this.success = false;
    }
    validate(event){
        event.preventDefault();
        if (this.newPass.value.length < 8 || this.oldPass.value.length < 8){
            this.showError("Password should be at least 8 characters long");
        } else if (this.newPass.value !== this.confirmPass.value){
            this.showError("New password and confirmed password is different");
        } else {
            this.button.disabled = true;
            let input = {
                userId: this.userId,
                role: this.userRole,
                oldPass: this.oldPass.value,
                newPass: this.newPass.value,
                confirmPass: this.confirmPass.value
            };
            let init = {
                method:'post',
                headers:{
                    "Content-Type":"application/json"
                },
                body: JSON.stringify(input)
            };

            fetch('changePassword', init).then(response => response.json())
            .then (this.showModal);
        }
    }
    showModal(json){
        this.modal.style.display = 'block';
        this.modal.querySelector('h2').textContent = json.status;
        this.modal.querySelector('span').textContent = json.message;
        this.success = (json.status == 'Success');
    }

    showError(text){
        this.messageContainer.style.display = 'block';
        this.messageContainer.textContent = text;
    }

    refresh(){
        if (this.success){
            window.location.href = 'login';
        } else {
            location.reload();
        }
    }
}
new ChangePasswordForm();