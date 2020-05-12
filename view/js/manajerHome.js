class ManajerHome {
    constructor(){
        this.form = document.getElementById('form-laporan');
        this.formHandle = this.formHandle.bind(this);
        this.form.addEventListener('submit', this.formHandle);

        this.select = this.form.elements['select-laporan'];
        console.log(this.select);
        this.select.selectedIndex = this.select.dataset.selected;
    }
    formHandle(event){
        event.preventDefault();
        let elements = this.form.elements;
        elements['index-laporan'].value = elements['select-laporan'].selectedIndex;
        console.log(this.form);
        document.getElementById('form-laporan').submit();
    }
}
new ManajerHome();