class tanggal {
    constructor() {
        this.page = document.getElementsByName('select-laporan');
        this.page = this.page[0];
        this.hiddenInput = document.querySelector('#tanggalKedua')

        this.showTanggal = this.showTanggal.bind(this);
        this.page.addEventListener('change', this.showTanggal);
    }

    showTanggal() {
        if (this.page.value == 'detail-trans-harian') {
            this.hiddenInput.classList.add("hide");
        } else {
            this.hiddenInput.classList.remove("hide");
        }
    }

}
new tanggal();