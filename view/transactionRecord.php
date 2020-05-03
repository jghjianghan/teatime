<main>
    <section id='left'>
        <h2>Tea</h2>
        <div class="box" id="tea-option">
            <form class="search" id='tea-form'>
                <input type="text" name="query" id="" placeholder="Search..." size=10><button type='submit'><i class="fa fa-lg fa-search"></i></button>
            </form>
        </div>
        <h2>Topping</h2>
        <div class="box" id="topping-option">
            <form class="search" id='topping-form'>
                <input type="text" name="query" placeholder="Search..." size=10><button type='submit'><i class="fa fa-lg fa-search"></i></button>
            </form>
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
        <h2>Order #400</h2>
        <div id='nota' class='box'>

        </div>
        <form id='nota-form'>
            Orderer's Name:
            <input type="text" name="nama-pemesan" required>
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