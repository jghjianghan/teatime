class OrderList{
    constructor(){
        this.bill = document.getElementById('nota');
        this.baseLine = this.bill.querySelector("hr");
        this.total = this.bill.querySelector("span:last-child");
        this.counter = 0;
        this.orderList = [];

        this.deleteOrder = this.deleteOrder.bind(this);
        document.addEventListener('delete-order', this.deleteOrder);
    }
    addOrder (tea, toppingList, sugar, ice, cup){
        this.orderList[this.counter] = new Pesanan(this.counter++, tea, toppingList, sugar, ice, cup);
        this.bill.insertBefore(this.orderList[this.counter - 1].renderData(), this.baseLine);
    }
    deleteOrder (event){
        delete this.orderList[event.detail];
    }
    getTotalHarga(){
        let total = 0;
        for (let x of this.orderList){
            if(x != null){
                total += x.getHargaPesanan();
            }
        }
        return total;
    }

    createOrderListInfo(){
        let info = [];
        for (let x of this.orderList){
            if(x != null){
                info.push(x.createPesananInfo());
            }
        }
        return info;
    }

    clear(){
        for (let x of this.orderList){
            if(x != null){
                this.bill.firstElementChild.remove();
            }
        }
        this.counter = 0;
        this.orderList = [];
    }
}