<main>
    <section id='left'>
        <h2>Tea</h2>
        <div class="box" id="tea-option">
            <div class="search" id='tea-form'>
                <input type="text" name="query" id="" placeholder="Search..." size=10><button><i class="fa fa-times"></i></button>
            </div>
        </div>
        <h2>Topping</h2>
        <div class="box" id="topping-option">
            <div class="search" id='topping-form'>
                <input type="text" name="query" placeholder="Search..." size=10><button><i class="fa fa-times"></i></button>
            </div>
        </div>
        <form id='pesanan-form'>
            <div>
                Sugar:
                <select name="sugar">
                </select>
            </div>
            <div>
                Ice:
                <select name="ice">
                </select>
            </div>
            <div>
                Cup Size:
                <select name="cup-size">
                </select>
            </div>
            <input type="submit" value="Add Order">
        </form>
    </section>
    <section id='right'>
        <h2>Order List</h2>
        <div id='nota' class='box'>
            <hr>
            <div id='bill-total'>
                <span>Total</span>
                <span id='total-harga'>Rp. 0</span>
            </div>
        </div>
        <form id='nota-form'>
            Orderer's Name:
            <input type="text" name="nama-pemesan" required autocomplete="off">
            <input type="submit" value="Checkout">
        </form>
    </section>
</main>

<div class="modal" id='modal-kasir'>
    <div>
        <h2></h2>
        <span id='message'></span><br>
        <button>OK</button>
    </div>
</div>