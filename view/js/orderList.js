class OrderList{
    constructor(){
        this.bill = document.getElementById('nota');
        this.baseLine = this.bill.querySelector("hr");
        this.total = this.bill.querySelector("span:last-child");
        this.orderList = [];

        // this.bill.insertBefore(document.createTextNode("happy"), this.baseLine);
    }
    addOrder (tea, toppingList, sugar, ice, cup){
        this.orderList.push(new Pesanan(tea, toppingList, sugar, ice, cup));
        this.bill.insertBefore(this.orderList[this.orderList.length-1].renderData(), this.baseLine);
    }
}