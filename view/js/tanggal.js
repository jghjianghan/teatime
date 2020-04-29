class tanggal {
    constructor() {
        this.page = document.getElementsByName('select-laporan');
        this.page = this.page[0];
        this.page.addEventListener('change', this.showTanggal);

        this.showTanggal = this.showTanggal.bind(this);
    }

    showTanggal() {
        if (this.page.value == 'detail-trans-harian') {
            this.page.classList.remove("date");
        } else {
            this.page.classList.add("date");
        }
    }

}
new tanggal();