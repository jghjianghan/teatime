class TeaOption {
    constructor(id, nama, src, hargaR, hargaL, container){
        this.thumbnail = document.createElement("div");
        this.thumbnail.className = "thumbnail";
        let img = document.createElement('img');
        img.src = "asset/img/tea/"+src;
        
        img.alt = src;
        let label = document.createTextNode(nama);
        this.thumbnail.appendChild(img);
        this.thumbnail.appendChild(label);
        container.appendChild(this.thumbnail);

        this.id = id;
        this.nama = nama;
        this.hargaR = hargaR;
        this.hargaL = hargaL;

        this.clicked = this.clicked.bind(this);
        this.thumbnail.addEventListener('click', this.clicked);
    }
    clicked (){
        document.dispatchEvent(new CustomEvent('tea-selected', {detail: this.id}));
    }
    toggleActivation(){
        this.thumbnail.classList.toggle("clicked");
    }
    createTeaInfo(size){
        return {
            id: this.id,
            nama: this.nama,
            harga: parseInt((size=="Regular")?this.hargaR:this.hargaL),
            size: size
        };
    }
    hide(){
        this.thumbnail.style.display = "none";
    }
    show(){
        this.thumbnail.style.display = "inline-block";
    }
}