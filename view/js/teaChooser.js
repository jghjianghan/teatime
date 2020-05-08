class TeaChooser {
    constructor(){
        this.teaList;
        this.selectedTea = -1;
        this.teaContainer = document.getElementById('tea-option');
        this.insertThumbnail = this.insertThumbnail.bind(this);
        fetch('kasir/tea').then(response => response.json())
        .then(this.insertThumbnail);

        this.selectTea = this.selectTea.bind(this);
        document.addEventListener('tea-selected', this.selectTea);

        //search
        this.teaSearch = this.teaContainer.querySelector("#tea-form input[type='text']");
        this.clearFilter = this.clearFilter.bind(this);
        this.teaSearch.nextSibling.addEventListener('click', this.clearFilter);
        this.filterOption = this.filterOption.bind(this);
        this.teaSearch.addEventListener('input', this.filterOption);
    }

    insertThumbnail(json){
        this.teaList = new Object();
        for (let el of json){
            this.teaList[el.id] = (new TeaOption(el.id, el.nama, el.gambar, el.hargaRegular, el.hargaLarge, this.teaContainer));
        }
    }

    selectTea(event){
        if (this.selectedTea == event.detail){
            this.teaList[this.selectedTea].toggleActivation();
            this.selectedTea = -1;
        } else {
            if (this.selectedTea != -1){
                this.teaList[this.selectedTea].toggleActivation();
            }
            
            this.selectedTea = event.detail;
            this.teaList[this.selectedTea].toggleActivation();
        }
    }

    getSelected(){
        if (this.selectedTea == -1){
            return null;
        } else {
            return this.teaList[this.selectedTea];
        }
    }
    reset (){
        if (this.selectedTea!=-1){
            this.teaList[this.selectedTea].toggleActivation();
            this.selectedTea = -1;
        }
        this.clearFilter();
    }
    clearFilter(){
        this.teaSearch.value = "";
        for (let i in this.teaList){
            if (this.teaList[i] != null ){
                this.teaList[i].show();
            }
        }
    }

    filterOption(event){
        for (let i in this.teaList){
            if (this.teaList[i] != null){
                if (this.teaList[i].nama.toLowerCase().includes(event.currentTarget.value.toLowerCase())){
                    this.teaList[i].show();
                }
                else {
                    this.teaList[i].hide();
                }
            } 
        }
    }
}