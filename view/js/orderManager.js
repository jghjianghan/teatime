class OrderManager{
    constructor(){
        this.teaChooser = new TeaChooser();
        this.toppingChooser = new ToppingChooser();
        this.orderAdditiveForm = document.getElementById('pesanan-form');
        this.orderList = new OrderList();
        this.orderSubmitForm = document.getElementById('nota-form');

        this.idKasir = document.querySelector('#account-info span:first-child').dataset.id;
        
        this.modal = document.getElementById('modal-kasir');
        this.modal.querySelector("button").addEventListener("click", function(event){
            event.currentTarget.parentNode.parentNode.style.display = "none";
        });

        this.addOrder = this.addOrder.bind(this);
        this.showModal = this.showModal.bind(this);
        this.orderAdditiveForm.addEventListener('submit', this.addOrder);

        this.sugarSelect = this.orderAdditiveForm.querySelector("select[name='sugar']");
        this.iceSelect = this.orderAdditiveForm.querySelector("select[name='ice']");
        this.cupSelect = this.orderAdditiveForm.querySelector("select[name='cup-size']");

        this.orderNumber = document.querySelector("#right > h2");
        this.updateOrderNumber();
        
        this.checkout = this.checkout.bind(this);
        this.orderSubmitForm.addEventListener('submit', this.checkout);
        this.postCheckoutReset = this.postCheckoutReset.bind(this);

        this.totalHarga = document.getElementById("total-harga");
        this.updateTotal = this.updateTotal.bind(this);
        document.addEventListener('delete-order', this.updateTotal);
        document.addEventListener('change-jumlah', this.updateTotal);

        //fetch select option
        this.insertSelectOption = this.insertSelectOption.bind(this);
        fetch('kasir/sugar').then(response => response.json())
        .then(this.insertSelectOption);
        fetch('kasir/ice').then(response => response.json())
        .then(this.insertSelectOption);
        fetch('kasir/cup').then(response => response.json())
        .then(this.insertSelectOption);
    }

    addOrder(event){
        event.preventDefault();
        let teaChoice = this.teaChooser.getSelected();
        let toppingChoice;
        if (teaChoice == null){
            this.showModal("Error","Tidak ada teh yang terpilih!");
        } else {
            teaChoice = teaChoice.createTeaInfo(this.cupSelect.value);
            toppingChoice = this.toppingChooser.getSelected();

            this.orderList.addOrder(teaChoice, toppingChoice, this.sugarSelect.value, this.iceSelect.value, this.cupSelect.value);

            this.teaChooser.reset();
            this.toppingChooser.resetAll();
            this.orderAdditiveForm.reset();
            this.updateTotal();
        }
    }
    showModal(title, message){
        this.modal.style.display = "block";
        this.modal.querySelector("h2").textContent = title;
        this.modal.querySelector("span#message").textContent = message;
    }
    insertSelectOption(json){
        let selectInput;
        switch(json.name){
            case "sugar":
                selectInput = this.sugarSelect;
                break;
            case "ice":
                selectInput = this.iceSelect;
                break;
            case "cup-size":
                selectInput = this.cupSelect;
                break;
        }
        
        for (let opt of json.option){
            let option = document.createElement('option');
            option.value = opt;
            option.textContent = opt;
            selectInput.appendChild(option);
        }
    }

    updateOrderNumber(){
        fetch("kasir/orderNum").then(response=>response.text())
        .then(text => this.orderNumber.textContent = "Order #" + text);
    }

    updateTotal(){
        this.totalHarga.textContent = "Rp. " + this.orderList.getTotalHarga();
    }

    checkout(event){
        event.preventDefault();
        event.currentTarget.querySelector("input[type='submit']").disabled = true;
        console.log('checkingout');
        let info = {
            orderList: this.orderList.createOrderListInfo(),
            namaPemesan: event.currentTarget.elements['nama-pemesan'].value,
            totalHarga: this.orderList.getTotalHarga(),
            idKasir: this.idKasir
        }

        let init = {
            method: 'post',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(info)
        };
        fetch('kasir/checkout', init).then(response => response.json())
        .then(this.postCheckoutReset);

    }
    postCheckoutReset (json){
        this.showModal(json.status, json.message);
        if (json.status === "Success"){
            this.updateOrderNumber();
            this.orderSubmitForm.reset();
            this.orderList.clear();
            this.updateTotal();
        }
        this.orderSubmitForm.querySelector("input[type='submit']").disabled = false;
    }
}
new OrderManager();