class showChooser {
    constructor() {
        this.page = document.getElementsByName('select-show');
        this.page = this.page[0];
        this.form = document.getElementById('form');

        this.submitForm = this.submitForm.bind(this);
        this.page.addEventListener('change', this.submitForm);
    }

    submitForm() {
        this.form.submit();
    }
}

new showChooser();