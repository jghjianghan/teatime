class OrderManager{
    constructor(){
        this.teaChooser = new TeaChooser();
        this.toppingChooser = new ToppingChooser();
        this.orderAdditiveForm = document.getElementById('pesanan-form');
        this.orderList = new OrderList();
        this.orderSubmitForm = document.getElementById('nota-form');

        this.addOrder = this.addOrder.bind(this);
        this.orderAdditiveForm.addEventListener('submit', this.addOrder);
    }

    addOrder(event){
        event.preventDefault();
        console.log(this.teaChooser.getSelected());
        console.log(this.toppingChooser.getSelected());
        this.toppingChooser.resetAll();
        this.teaChooser.reset();
    }
}
new OrderManager();