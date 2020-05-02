class ToppingOption {
    constructor(id, nama, src, harga, container){
        this.thumbnail = document.createElement("div");
        this.thumbnail.className = "thumbnail";
        let img = document.createElement('img');
        img.src = "asset/img/topping/"+src;
        
        img.alt = src;
        let br = document.createElement('br');
        let label = document.createTextNode(nama);
        this.numInput = document.createElement("input");
        this.numInput.setAttribute("type", "number");

        this.onChange = this.onChange.bind(this);
        this.numInput.addEventListener('change', this.onChange);

        this.thumbnail.appendChild(img);
        this.thumbnail.appendChild(label);
        this.thumbnail.appendChild(br);
        this.thumbnail.appendChild(this.numInput);

        container.appendChild(this.thumbnail);

        this.id = id;
        this.nama = nama;
        this.harga = harga;

        this.getTotalHarga = this.getTotalHarga.bind(this)
    }
    onChange (event){
        if (event.currentTarget.value < 0){
            event.currentTarget.value = 0;
        }
        if (event.currentTarget.value == "" || event.currentTarget.value==0){
            this.thumbnail.classList.remove("clicked");
        } else {
            this.thumbnail.classList.add("clicked");
        }
    }
    getJumlah(){
        return this.numInput.value;
    }
    getTotalHarga(){
        return this.getJumlah() * this.harga;
    }
    reset(){
        this.numInput.value = "";
        this.thumbnail.classList.remove("clicked");
    }
}