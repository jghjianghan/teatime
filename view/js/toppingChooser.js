class ToppingChooser {
    constructor(){
        this.toppingList;
        this.toppingContainer = document.getElementById('topping-option');
        this.insertThumbnail = this.insertThumbnail.bind(this);
        fetch('kasir/topping').then(response => response.json())
        .then(this.insertThumbnail);
    }

    insertThumbnail(json){
        this.toppingList = new Object();
        for (let el of json){
            this.toppingList[el.id] = (new ToppingOption(el.id, el.nama, el.gambar, el.harga, this.toppingContainer));
        }
    }

    getSelected(){
        let result = [];
        let isEmpty = true;
        for (let i in this.toppingList){
            if (this.toppingList[i].getJumlah() != "" && this.toppingList[i].getJumlah()!=0){
                isEmpty = false;
                result.push({
                    id: this.toppingList[i].id,
                    nama: this.toppingList[i].nama,
                    jumlah: this.toppingList[i].getJumlah(),
                    harga: this.toppingList[i].getTotalHarga()
                });
            }
        }
        return (isEmpty)?null:result;
    }
    resetAll (){
        for (let i in this.toppingList){
            this.toppingList[i].reset();
        }
    }
}