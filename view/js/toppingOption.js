class ToppingOption {
    constructor(id, nama, src, harga, container){
        this.thumbnail = document.createElement("div");
        this.thumbnail.className = "thumbnail";
        let img = document.createElement('img');
        img.src = "asset/img/topping/"+src;
        
        img.alt = src;
        let br = document.createElement('br');
        let label = document.createTextNode(nama);
        let numInput = document.createTextNode(input);
        numInput.setAttribute("type", "number");
        this.thumbnail.appendChild(img);
        this.thumbnail.appendChild(label);
        this.thumbnail.appendChild(br);
        this.thumbnail.appendChild(numInput);

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
}