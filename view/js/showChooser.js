class showChooser {
    constructor() {
        this.page = document.getElementsByName('select-show');
        this.page = this.page[0];
        this.form = document.getElementById('form');

        this.submitForm = this.submitForm.bind(this);
        this.page.addEventListener('change', this.submitForm)
        for (let opt of this.page){
            if (opt.value == this.page.dataset.show){
                opt.selected = true;
            }
        }
        let noPage = this.form.page.value;
        let pageButton = document.querySelectorAll('#pagination input[type="submit"]');
        pageButton[parseInt(noPage)-1].classList.add('active');
    }

    submitForm() {
        this.form.page.value = 1;
        this.form.submit();
    }
}

new showChooser();