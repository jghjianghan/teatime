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
        if (elements['index-laporan'].value == "0"){
            if (elements['tanggal1'] == ""){
                alert("Tanggal tidak boleh kosong");
            } else {
                document.getElementById('form-laporan').submit();
            }
        } else if (elements['index-laporan'].value != "0"){
            let d1 = Date.parse(elements['tanggal1'].value);
            let d2 = Date.parse(elements['tanggal2'].value);
            
            if (d2<d1){
                alert("Tanggal kedua tidak boleh lebih awal dari tanggal pertama");
            } else {
                document.getElementById('form-laporan').submit();
            }
        }
    }
}
new ManajerHome();