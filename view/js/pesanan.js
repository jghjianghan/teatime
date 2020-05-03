class Pesanan {
    constructor(teh, toppingList, sugar, ice, size){
        this.teh = teh;
        this.toppingList = toppingList;
        this.sugar = sugar;
        this.ice = ice;
        this.size = size;
        this.jumlah = 1;   
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
        span.addEventListener('click', this.deleteSelf);
        let input = document.createElement('input');
        input.setAttribute('type', 'number');
        
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
        // table.appendChild(this.createRow("",this.ice + " Ice",""));
        
        table.appendChild(this.createRow("","Subtotal","Rp. "+this.getHargaPesanan()));

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

    getHargaPesanan(){
        let harga = parseInt(this.teh.harga);
        if (this.toppingList != null){
            for (let topping of this.toppingList){
                harga += topping.harga;
            }
        }
        return harga;
    }

    deleteSelf(event){
        console.log('delete');
        console.log(event.currentTarget.parentElement.parentElement.parentElement);
    }
}