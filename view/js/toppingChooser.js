class ToppingChooser {
    constructor(){
        this.toppingList;
        this.toppingContainer = document.getElementById('topping-option');
        this.insertThumbnail = this.insertThumbnail.bind(this);
        fetch('kasir/topping').then(response => response.json())
        .then(this.insertThumbnail);

        //search
        this.toppingSearch = this.toppingContainer.querySelector("#topping-form input[type='text']");
        this.clearFilter = this.clearFilter.bind(this);
        this.toppingSearch.nextSibling.addEventListener('click', this.clearFilter);
        this.filterOption = this.filterOption.bind(this);
        this.toppingSearch.addEventListener('input', this.filterOption);
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
        this.clearFilter();
    }
    clearFilter(){
        this.toppingSearch.value = "";
        for (let i in this.toppingList){
            if (this.toppingList[i] != null ){
                this.toppingList[i].show();
            }
        }
    }
    filterOption(event){
        for (let i in this.toppingList){
            if (this.toppingList[i] != null){
                if (this.toppingList[i].nama.toLowerCase().includes(event.currentTarget.value.toLowerCase())){
                    this.toppingList[i].show();
                }
                else {
                    this.toppingList[i].hide();
                }
            }
        }
    }
}