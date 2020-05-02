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
    }
}