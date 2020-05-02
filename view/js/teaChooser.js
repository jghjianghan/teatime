class TeaChooser {
    constructor(){
        this.teaList;
        this.teaContainer = document.getElementById('tea-option');
        this.insertThumbnail = this.insertThumbnail.bind(this);
        fetch('kasir/tea').then(response => response.json())
        .then(this.insertThumbnail);
    }

    insertThumbnail(json){
        this.teaList = [];
        for (let el of json){
            let thumbnail = document.createElement("div");
            thumbnail.className = "thumbnail";
            let img = document.createElement('img');
            img.src = "asset/img/tea/"+el.gambar;
            
            img.alt = el.nama;
            let label = document.createTextNode(el.nama);
            thumbnail.appendChild(img);
            thumbnail.appendChild(label);
            this.teaContainer.appendChild(thumbnail);
            this.teaList[el.id] = {
                nama: el.nama,
                hargaRegular: el.hargaRegular,
                hargaLarge: el.hargaLarge
            };
        }
        console.log(this.teaList);
    }
}