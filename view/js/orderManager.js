class OrderManager{
    constructor(){
        this.teaChooser = new TeaChooser();
        this.toppingChooser = new ToppingChooser();
        this.orderAdditiveForm = document.getElementById('pesanan-form');
        this.orderList = new OrderList();
        this.orderSubmitForm = document.getElementById('nota-form');
        
        this.modal = document.getElementById('modal-kasir');
        this.modal.querySelector("button").addEventListener("click", function(event){
            event.currentTarget.parentNode.parentNode.style.display = "none";
        });

        this.addOrder = this.addOrder.bind(this);
        this.showModal = this.showModal.bind(this);
        this.orderAdditiveForm.addEventListener('submit', this.addOrder);

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
            toppingChoice = this.toppingChooser.getSelected();
            this.toppingChooser.resetAll();
            this.teaChooser.reset();
        }
    }
    showModal(title, message){
        this.modal.style.display = "block";
        this.modal.querySelector("h2").textContent = title;
        this.modal.querySelector("span#message").textContent = message;
    }
    insertSelectOption(json){
        let selectInput = this.orderAdditiveForm.querySelector("select[name='"+ json.name +"']");
        for (let opt of json.option){
            let option = document.createElement('option');
            option.value = opt;
            option.textContent = opt;
            selectInput.appendChild(option);
        }
    }
}
new OrderManager();