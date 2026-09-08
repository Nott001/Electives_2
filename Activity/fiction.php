<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robert's Book Store - Fiction</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Calling or Accessing the CSS from book_pos.css file inside the css folder -->
    <link rel="stylesheet" href="css/book_pos.css">
</head>
<body>
<div class="container page_border">
    <h1 class="store_title">Robert's Book Store</h1>

    <div class="topbar">
        <button type="button" class="btn btn-danger">SEARCH</button>
        <select class="form-control genre_select" onchange="if(this.value) window.location.href=this.value;">
            <option value="">----------------select genre</option>
            <option value="fiction.php" selected>Fiction</option>
            <option value="classics.php">Classics</option>
            <option value="scifi.php">Sci-Fi</option>
            <option value="mystery.php">Mystery</option>
            <option value="nonfiction.php">Non-Fiction</option>
        </select>
    </div>

    <div class="pic_group">
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/How_i_killed_pluto.jpg" data-toggle="tooltip" data-placement="bottom" title="How I Killed Pluto" alt="How I Killed Pluto">
            </div>
            <div class="item_label">
                <span class="book_title">How I Killed Pluto</span>
                <span class="book_price">P450.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/all_things_cease_to_appear.png" data-toggle="tooltip" data-placement="bottom" title="All Things Cease to Appear" alt="All Things Cease to Appear">
            </div>
            <div class="item_label">
                <span class="book_title">All Things Cease to Appear</span>
                <span class="book_price">P520.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/art_of_war.jpg" data-toggle="tooltip" data-placement="bottom" title="The Art of War" alt="The Art of War">
            </div>
            <div class="item_label">
                <span class="book_title">The Art of War</span>
                <span class="book_price">P380.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/brothes_karamazov.jpg" data-toggle="tooltip" data-placement="bottom" title="The Brothers Karamazov" alt="The Brothers Karamazov">
            </div>
            <div class="item_label">
                <span class="book_title">The Brothers Karamazov</span>
                <span class="book_price">P1,250.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/closing_time.jpg" data-toggle="tooltip" data-placement="bottom" title="Closing Time" alt="Closing Time">
            </div>
            <div class="item_label">
                <span class="book_title">Closing Time</span>
                <span class="book_price">P480.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/dead_astronauts.jpg" data-toggle="tooltip" data-placement="bottom" title="Dead Astronauts" alt="Dead Astronauts">
            </div>
            <div class="item_label">
                <span class="book_title">Dead Astronauts</span>
                <span class="book_price">P590.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/no_longer_human.jpg" data-toggle="tooltip" data-placement="bottom" title="No Longer Human" alt="No Longer Human">
            </div>
            <div class="item_label">
                <span class="book_title">No Longer Human</span>
                <span class="book_price">P620.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/no_to_disturb.jpg" data-toggle="tooltip" data-placement="bottom" title="Not to Disturb" alt="Not to Disturb">
            </div>
            <div class="item_label">
                <span class="book_title">Not to Disturb</span>
                <span class="book_price">P410.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/numbers.jpg" data-toggle="tooltip" data-placement="bottom" title="Numbers" alt="Numbers">
            </div>
            <div class="item_label">
                <span class="book_title">Numbers</span>
                <span class="book_price">P550.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/the_mother_the_daughter.png" data-toggle="tooltip" data-placement="bottom" title="The Mother, The Daughter" alt="The Mother, The Daughter">
            </div>
            <div class="item_label">
                <span class="book_title">The Mother, The Daughter</span>
                <span class="book_price">P470.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/tyll.jpg" data-toggle="tooltip" data-placement="bottom" title="Tyll" alt="Tyll">
            </div>
            <div class="item_label">
                <span class="book_title">Tyll</span>
                <span class="book_price">P580.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/ugly_man.jpg" data-toggle="tooltip" data-placement="bottom" title="Ugly Man" alt="Ugly Man">
            </div>
            <div class="item_label">
                <span class="book_title">Ugly Man</span>
                <span class="book_price">P430.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/the_pale_king.jpg" data-toggle="tooltip" data-placement="bottom" title="The Pale King" alt="The Pale King">
            </div>
            <div class="item_label">
                <span class="book_title">The Pale King</span>
                <span class="book_price">P760.00</span>
            </div>
        </div>
        <div class="pic_option">
            <div class="pic_img">
                <img src="book_images/the_sell_out.png" data-toggle="tooltip" data-placement="bottom" title="The Sellout" alt="The Sellout">
            </div>
            <div class="item_label">
                <span class="book_title">The Sellout</span>
                <span class="book_price">P640.00</span>
            </div>
        </div>
    </div>

    <div class="order-section">
        <div class="row">
            <div class="col-md-7 order-details">
                <h3>Order Details</h3>
                <div class="form-group">
                    <label for="item_name">Name of an Item</label>
                    <input type="text" class="form-control" id="item_name">
                </div>
                <div class="form-group">
                    <label for="qty">Quantity</label>
                    <input type="number" class="form-control" id="qty">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price">
                </div>
                <div class="form-group">
                    <label for="disc_amount">Discount Amount</label>
                    <input type="text" class="form-control" id="disc_amount" readonly>
                </div>
                <div class="form-group">
                    <label for="discounted_amount">Discounted Amount</label>
                    <input type="text" class="form-control" id="discounted_amount" readonly>
                </div>
                <div class="form-group">
                    <label for="total_qty">Total Quantity</label>
                    <input type="text" class="form-control" id="total_qty" readonly>
                </div>
                <div class="form-group">
                    <label for="total_disc">Total Discount Given</label>
                    <input type="text" class="form-control" id="total_disc" readonly>
                </div>
                <div class="form-group">
                    <label for="total_disc_amount">Total Discounted Amount</label>
                    <input type="text" class="form-control" id="total_disc_amount" readonly>
                </div>
                <div class="form-group">
                    <label for="cash_given">Cash Given</label>
                    <input type="number" class="form-control" id="cash_given">
                </div>
                <div class="form-group">
                    <label for="change">Change</label>
                    <input type="text" class="form-control" id="change" readonly>
                </div>
            </div>
            <div class="col-md-5 discount-options">
                <h3>Order Discount Options</h3>
                <div class="form-group">
                    <label class="radio_label"><input type="radio" name="discount" value="senior"> Senior Citizen</label>
                    <label class="radio_label"><input type="radio" name="discount" value="card"> With Disc. Card</label>
                    <label class="radio_label"><input type="radio" name="discount" value="employee"> Employee Disc.</label>
                    <label class="radio_label"><input type="radio" name="discount" value="none" checked> No Discount</label>
                </div>
                <div class="action-btns">
                    <button type="button" class="btn btn-success">CALCULATE CHANGE</button>
                    <button type="button" class="btn btn-primary">NEW</button>
                    <button type="button" class="btn btn-warning">SAVE</button>
                    <button type="button" class="btn btn-info">UPDATE</button>
                </div>
                <div class="calc_pad">
                    <h4>Calculator</h4>
                    <div class="calc-grid">
                        <button type="button" class="btn btn-dark btn-enter">ENTER</button>
                        <button type="button" class="btn btn-secondary">/</button>
                        <button type="button" class="btn btn-secondary">*</button>
                        <button type="button" class="btn btn-secondary">-</button>
                        <button type="button" class="btn btn-secondary">+</button>
                        <button type="button" class="btn btn-light border">6</button>
                        <button type="button" class="btn btn-light border">7</button>
                        <button type="button" class="btn btn-light border">8</button>
                        <button type="button" class="btn btn-light border">9</button>
                        <button type="button" class="btn btn-light border">2</button>
                        <button type="button" class="btn btn-light border">3</button>
                        <button type="button" class="btn btn-light border">4</button>
                        <button type="button" class="btn btn-light border">5</button>
                        <button type="button" class="btn btn-light border">0</button>
                        <button type="button" class="btn btn-light border">.</button>
                        <button type="button" class="btn btn-light border">1</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>
</html>