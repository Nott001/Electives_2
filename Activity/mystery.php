<?php require __DIR__ . '/includes/book_pos.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robert's Book Store - Mystery</title>

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
            <option value="fiction.php">Fiction</option>
            <option value="classics.php">Classics</option>
            <option value="scifi.php">Sci-Fi</option>
            <option value="mystery.php" selected>Mystery</option>
            <option value="nonfiction.php">Non-Fiction</option>
        </select>
    </div>

    <form method="post" action="#order_details" id="order_form" novalidate>
    <!-- Pressing Enter in a field recomputes the amounts instead of triggering another button -->
    <button type="submit" name="action" value="preview" class="default-submit" tabindex="-1" aria-hidden="true"></button>
    <div class="row pos-layout">
        <!-- Left: book covers and order form scroll with the page -->
        <div class="col-lg-8 col-xl-9 pos-main">
            <div class="pic_group">
                <div class="pic_option">
                    <div class="pic_img">
                        <img src="book_images/knives_come_down.jpg" data-toggle="tooltip" data-placement="bottom" title="The Knives Come Down" alt="The Knives Come Down">
                    </div>
                    <div class="item_label">
                        <span class="book_title">The Knives Come Down</span>
                        <span class="book_price">P660.00</span>
                    </div>
                </div>
                <div class="pic_option">
                    <div class="pic_img">
                        <img src="book_images/1000_black_umbrellas.jpg" data-toggle="tooltip" data-placement="bottom" title="A Thousand Black Umbrellas" alt="A Thousand Black Umbrellas">
                    </div>
                    <div class="item_label">
                        <span class="book_title">A Thousand Black Umbrellas</span>
                        <span class="book_price">P580.00</span>
                    </div>
                </div>
                <div class="pic_option">
                    <div class="pic_img">
                        <img src="book_images/cunning_plans.jpg" data-toggle="tooltip" data-placement="bottom" title="Cunning Plans" alt="Cunning Plans">
                    </div>
                    <div class="item_label">
                        <span class="book_title">Cunning Plans</span>
                        <span class="book_price">P540.00</span>
                    </div>
                </div>
                <div class="pic_option">
                    <div class="pic_img">
                        <img src="book_images/the_everlasting.jpg" data-toggle="tooltip" data-placement="bottom" title="The Everlasting" alt="The Everlasting">
                    </div>
                    <div class="item_label">
                        <span class="book_title">The Everlasting</span>
                        <span class="book_price">P610.00</span>
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
                        <img src="book_images/closing_time.jpg" data-toggle="tooltip" data-placement="bottom" title="Closing Time" alt="Closing Time">
                    </div>
                    <div class="item_label">
                        <span class="book_title">Closing Time</span>
                        <span class="book_price">P480.00</span>
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
                        <img src="book_images/no_to_disturb.jpg" data-toggle="tooltip" data-placement="bottom" title="Not to Disturb" alt="Not to Disturb">
                    </div>
                    <div class="item_label">
                        <span class="book_title">Not to Disturb</span>
                        <span class="book_price">P410.00</span>
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
                        <img src="book_images/How_i_killed_pluto.jpg" data-toggle="tooltip" data-placement="bottom" title="How I Killed Pluto" alt="How I Killed Pluto">
                    </div>
                    <div class="item_label">
                        <span class="book_title">How I Killed Pluto</span>
                        <span class="book_price">P450.00</span>
                    </div>
                </div>
            </div>

            <div class="order-section">
                <div class="row">
                    <div class="col-md-7 order-details">
                        <h3 id="order_details">Order Details</h3>
                        <div class="form-group">
                            <label for="item_name">Name of an Item</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" value="<?= h($form['item_name']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control" id="qty" name="qty" value="<?= h($form['qty']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="any" value="<?= h($form['price']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="disc_amount">Discount Amount</label>
                            <input type="text" class="form-control" id="disc_amount" readonly value="<?= $line ? money($line['discount']) : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="discounted_amount">Discounted Amount</label>
                            <input type="text" class="form-control" id="discounted_amount" readonly value="<?= $line ? money($line['amount']) : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="total_qty">Total Quantity</label>
                            <input type="text" class="form-control" id="total_qty" readonly value="<?= $pos['items'] ? $totals['qty'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="total_disc">Total Discount Given</label>
                            <input type="text" class="form-control" id="total_disc" readonly value="<?= $pos['items'] ? money($totals['discount']) : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="total_disc_amount">Total Discounted Amount</label>
                            <input type="text" class="form-control" id="total_disc_amount" readonly value="<?= $pos['items'] ? money($totals['amount']) : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="cash_given">Cash Given</label>
                            <input type="number" class="form-control" id="cash_given" name="cash_given" step="any" value="<?= h($form['cash_given']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="change">Change</label>
                            <input type="text" class="form-control" id="change" readonly value="<?= $change ?>">
                        </div>
                        <h3 class="mt-4">Order List</h3>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover order-list" id="order_list">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!$pos['items']): ?>
                                    <tr class="empty-row"><td colspan="6">No items saved yet.</td></tr>
                                <?php endif; ?>
                                <?php foreach ($pos['items'] as $i => $it): ?>
                                    <tr class="<?= $i === $pos['selected'] ? 'table-active' : '' ?>">
                                        <td><button type="submit" name="select_row" value="<?= $i ?>" class="btn btn-link btn-sm p-0 select-row" title="Edit this item"><?= $i + 1 ?></button></td>
                                        <td><?= h($it['name']) ?></td>
                                        <td><?= $it['qty'] ?></td>
                                        <td><?= money($it['price']) ?></td>
                                        <td><?= money($it['discount']) ?></td>
                                        <td><?= money($it['amount']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-5 discount-options">
                        <h3>Order Discount Options</h3>
                        <div class="form-group">
                            <label class="radio_label"><input type="radio" name="discount" value="senior"<?= $form['discount'] === 'senior' ? ' checked' : '' ?>> Senior Citizen</label>
                            <label class="radio_label"><input type="radio" name="discount" value="card"<?= $form['discount'] === 'card' ? ' checked' : '' ?>> With Disc. Card</label>
                            <label class="radio_label"><input type="radio" name="discount" value="employee"<?= $form['discount'] === 'employee' ? ' checked' : '' ?>> Employee Disc.</label>
                            <label class="radio_label"><input type="radio" name="discount" value="none"<?= $form['discount'] === 'none' ? ' checked' : '' ?>> No Discount</label>
                        </div>
                        <div id="order_msg">
                            <?php if ($message): ?>
                                <div class="alert alert-<?= $message['type'] ?> py-2 mb-2"><?= $message['text'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="action-btns">
                            <button type="submit" name="action" value="calculate" class="btn btn-success" id="btn_calculate">CALCULATE CHANGE</button>
                            <button type="submit" name="action" value="new" class="btn btn-primary" id="btn_new">NEW</button>
                            <button type="submit" name="action" value="save" class="btn btn-warning" id="btn_save">SAVE</button>
                            <button type="submit" name="action" value="update" class="btn btn-info" id="btn_update">UPDATE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right: calculator stays pinned while the left side scrolls -->
        <div class="col-lg-4 col-xl-3">
            <aside class="pos-sidebar calc_pad">
                <h4>Calculator</h4>
                <div class="input-group calc-display-group">
                    <input type="text" class="form-control calc-display" id="calc_display" name="calc_display" readonly placeholder="0" value="<?= h($form['calc_display']) ?>">
                    <div class="input-group-append">
                        <button type="submit" name="action" value="calc_clear" class="btn btn-danger" id="calc_clear">C</button>
                    </div>
                </div>
                <select class="form-control form-control-sm calc-target" id="calc_target" name="calc_target">
                    <option value="">ENTER result goes to: (nowhere)</option>
                    <?php foreach (CALC_TARGETS as $field => $label): ?>
                        <option value="<?= $field ?>"<?= $form['calc_target'] === $field ? ' selected' : '' ?>>ENTER result goes to: <?= $label ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="calc-grid">
                    <button type="submit" name="action" value="calc_enter" class="btn btn-dark btn-enter">ENTER</button>
                    <button type="submit" name="calc_key" value="/" class="btn btn-secondary">/</button>
                    <button type="submit" name="calc_key" value="*" class="btn btn-secondary">*</button>
                    <button type="submit" name="calc_key" value="-" class="btn btn-secondary">-</button>
                    <button type="submit" name="calc_key" value="+" class="btn btn-secondary">+</button>
                    <button type="submit" name="calc_key" value="6" class="btn btn-light border">6</button>
                    <button type="submit" name="calc_key" value="7" class="btn btn-light border">7</button>
                    <button type="submit" name="calc_key" value="8" class="btn btn-light border">8</button>
                    <button type="submit" name="calc_key" value="9" class="btn btn-light border">9</button>
                    <button type="submit" name="calc_key" value="2" class="btn btn-light border">2</button>
                    <button type="submit" name="calc_key" value="3" class="btn btn-light border">3</button>
                    <button type="submit" name="calc_key" value="4" class="btn btn-light border">4</button>
                    <button type="submit" name="calc_key" value="5" class="btn btn-light border">5</button>
                    <button type="submit" name="calc_key" value="0" class="btn btn-light border">0</button>
                    <button type="submit" name="calc_key" value="." class="btn btn-light border">.</button>
                    <button type="submit" name="calc_key" value="1" class="btn btn-light border">1</button>
                </div>
            </aside>
        </div>
    </div>
    </form>
</div>

<!-- Book cover click / auto-recalculate glue; all the math is in includes/book_pos.php -->
<script src="js/book_pos.js"></script>

<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>
</html>