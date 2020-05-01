<main>
    <section id='left'>
        <h2>Tea</h2>
        <div class="box" id="tea-option">
            <form class="search" id='tea-form'>
                <input type="text" name="query" id="" placeholder="Search..." size=10><button type='submit'><i class="fa fa-lg fa-search"></i></button>
            </form>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/bubble-tea.jpg" alt="">
                Bubble Tea
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/green-tea.jpg" alt="">
                Green Tea
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/hojicha.jpg" alt="">
                Hojicha
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/ocha.png" alt="">
                Ocha
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/thai-tea.jpg" alt="">
                Thai Tea
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/thai-tea.jpg" alt="">
                Thai Tea
            </div>
        </div>
        <h2>Topping</h2>
        <div class="box" id="topping-option">
            <form class="search" id='topping-form'>
                <input type="text" name="query" placeholder="Search..." size=10><button type='submit'><i class="fa fa-lg fa-search"></i></button>
            </form>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea<br>
                <input type="number" name="">
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea<br>
                <input type="number" name="">
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea<br>
                <input type="number" name="">
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea<br>
                <input type="number" name="">
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea<br>
                <input type="number" name="">
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea<br>
                <input type="number" name="">
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea<br>
                <input type="number" name="">
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea<br>
                <input type="number" name="">
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea<br>
                <input type="number" name="">
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea<br>
                <input type="number" name="">
            </div>
            <div class="thumbnail">
                <img src="<?php echo $upPrefix;?>asset/img/tea/black-tea.png" alt="">
                Black Tea<br>
                <input type="number" name="">
            </div>
            
        </div>
        <form id='pesanan-form'>
            <div>
                Sugar:
                <select name="sugar">
                    <option value="none">None</option>
                    <option value="slight">Slight</option>
                    <option value="half">Half</option>
                    <option value="less">Less</option>
                    <option value="normal">Normal</option>
                </select>
            </div>
            <div>
                Ice:
                <select name="ice">
                    <option value="none">None</option>
                    <option value="less">Less</option>
                    <option value="normal">Normal</option>
                </select>
            </div>
            <div>
                Cup Size:
                <select name="cup-size">
                    <option value="regular">Regular</option>
                    <option value="large">Large</option>
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