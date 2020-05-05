class Pesanan {
    constructor(nomor, teh, toppingList, sugar, ice, size){
        this.nomor = nomor;
        this.teh = teh;
        this.toppingList = toppingList;
        this.sugar = sugar;
        this.ice = ice;
        this.size = size;
        this.jumlah = 1;
        this.subtotal;

        this.deleteSelf = this.deleteSelf.bind(this);
        this.onChangeJumlah = this.onChangeJumlah.bind(this);
    }
    renderData (){
        let table = document.createElement("table");
        table.className = 'order-item';

        //teh
        let tr = document.createElement('tr');
        let td = document.createElement('td');
        let span = document.createElement('span');
        span.className = "remove";
        span.textContent = '\xD7';
        span.dataset.nomor = this.nomor;
        span.addEventListener('click', this.deleteSelf);
        let input = document.createElement('input');
        input.setAttribute('type', 'number');
        input.value = this.jumlah;
        input.addEventListener('change', this.onChangeJumlah);
        
        td.appendChild(span);
        td.appendChild(document.createTextNode(" "));
        td.appendChild(input);
        tr.appendChild(td);

        td = document.createElement('td');
        td.textContent = this.teh.nama + " (" + this.teh.size.charAt(0) + ")";
        tr.appendChild(td);

        td = document.createElement('td');
        td.textContent = "Rp. " + this.teh.harga;
        tr.appendChild(td);
        
        table.appendChild(tr);

        //topping
        if (this.toppingList != null){
            for (let topping of this.toppingList){
                table.appendChild(
                    this.createRow(
                        "",
                        topping.jumlah + "x " + topping.nama,
                        "Rp. " + topping.harga
                    )
                );
            }
        }

        //additive
        table.appendChild(this.createRow("",this.sugar + " Sugar, " + this.ice + " Ice",""));        
        table.appendChild(this.createRow("","Subtotal","Rp. "+this.getHargaPesanan()));
        this.subtotal = table.lastChild.lastChild;
        return table;
    }

    createRow(content1, content2, content3){
        let tr = document.createElement('tr');
        
        let td = document.createElement('td');
        td.textContent = content1;
        tr.appendChild(td);

        td = document.createElement('td');
        td.textContent = content2;
        tr.appendChild(td);

        td = document.createElement('td');
        td.textContent = content3;
        tr.appendChild(td);

        return tr;
    }

    onChangeJumlah(event){
        if (event.currentTarget.value <= 0){
            event.currentTarget.value = 1;
        }
        this.jumlah = event.currentTarget.value;
        this.subtotal.textContent = "Rp. " + this.getHargaPesanan();
        document.dispatchEvent(new CustomEvent("change-jumlah"));
    }

    getHargaPesanan(){
        let harga = parseInt(this.teh.harga);
        if (this.toppingList != null){
            for (let topping of this.toppingList){
                harga += topping.harga;
            }
        }
        return harga * this.jumlah;
    }

    deleteSelf(event){
        const data = {
            detail: this.nomor
        };
        document.dispatchEvent(new CustomEvent('delete-order', data));
        let thisTable = event.currentTarget.parentElement.parentElement.parentElement;
        thisTable.remove();
    }

    createPesananInfo(){
        let info = {
            idTeh: this.teh.id,
            harga: this.getHargaPesanan(),
            jumlah: this.jumlah,
            gula: this.sugar,
            es: this.ice,
            ukuran: this.teh.size,
            topping: []
        }
        if (this.toppingList != null){
            for (let topping of this.toppingList){
                info.topping.push({
                    id: topping.id,
                    jumlah: topping.jumlah
                });
            }
        }
        return info;
    }
}