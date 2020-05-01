class OrderManager{
    constructor(){
        this.teaChooser = new TeaChooser();
        this.toppingChooser = new ToppingChooser();
        this.orderAdditiveForm = document.getElementById('pesanan-form');
        this.orderList = new OrderList();
        this.orderSubmitForm = document.getElementById('nota-form');
    }
}
new OrderManager();