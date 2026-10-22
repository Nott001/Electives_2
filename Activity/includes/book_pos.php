<?php
/*============================================================
  Robert's Book Store — shared POS logic (server side)
  Included at the top of: fiction.php, classics.php, scifi.php,
                          mystery.php, nonfiction.php
  Every button in the order form posts back to the same page;
  the saved order lives in the PHP session, so it carries over
  when switching genre pages.
============================================================ */

session_start();

// Discount rate per radio value
const DISCOUNT_RATES = [
    'senior'   => 0.20,
    'card'     => 0.10,
    'employee' => 0.15,
    'none'     => 0,
];

// Fields the calculator's ENTER can send its result to
const CALC_TARGETS = [
    'qty'        => 'Quantity',
    'price'      => 'Price',
    'cash_given' => 'Cash Given',
];

// ---------- Helpers ----------
function h($text)
{
    return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
}

function money($n)
{
    return number_format($n, 2);
}

function is_operator($ch)
{
    return $ch !== '' && strpos('+-*/', $ch) !== false;
}

// Discount and discounted amount for one order line
function compute_line($qty, $price, $type)
{
    $gross = $qty * $price;
    $discount = round($gross * DISCOUNT_RATES[$type], 2);
    return ['discount' => $discount, 'amount' => round($gross - $discount, 2)];
}

// Validates the item fields; returns [item, null] or [null, error message]
function read_item($form)
{
    $name = $form['item_name'];
    $qty = filter_var($form['qty'], FILTER_VALIDATE_INT);
    $price = $form['price'];

    if ($name === '') return [null, 'Enter the name of the item.'];
    if ($qty === false || $qty <= 0) return [null, 'Quantity must be a whole number greater than 0.'];
    if (!is_numeric($price) || $price <= 0) return [null, 'Price must be greater than 0.'];

    $price = (float) $price;
    $type = $form['discount'];
    return [['name' => $name, 'qty' => $qty, 'price' => $price, 'type' => $type]
        + compute_line($qty, $price, $type), null];
}

function order_totals($items)
{
    $totals = ['qty' => 0, 'discount' => 0, 'amount' => 0];
    foreach ($items as $it) {
        $totals['qty'] += $it['qty'];
        $totals['discount'] += $it['discount'];
        $totals['amount'] += $it['amount'];
    }
    $totals['amount'] = round($totals['amount'], 2);
    return $totals;
}

// ---------- Calculator ----------
// Evaluates "num op num op ..." with * and / before + and -, without eval()
function calc_evaluate($expr)
{
    if (!preg_match_all('/\d*\.?\d+|\d+\.|[+\-*\/]/', $expr, $m)) return null;
    $tokens = $m[0];
    if ($tokens[0] === '-') array_unshift($tokens, '0');
    if (!is_numeric($tokens[0])) return null;

    $terms = [(float) $tokens[0]];
    $ops = [];
    for ($i = 1; $i < count($tokens); $i += 2) {
        $op = $tokens[$i];
        if (!isset($tokens[$i + 1]) || !is_numeric($tokens[$i + 1])) return null;
        $num = (float) $tokens[$i + 1];
        $last = count($terms) - 1;
        if ($op === '*') {
            $terms[$last] *= $num;
        } elseif ($op === '/') {
            if ($num == 0) return null;
            $terms[$last] /= $num;
        } else {
            $ops[] = $op;
            $terms[] = $num;
        }
    }
    $result = $terms[0];
    foreach ($ops as $j => $op) {
        $result = $op === '+' ? $result + $terms[$j + 1] : $result - $terms[$j + 1];
    }
    return round($result, 2);
}

// Appends one calculator key to the display, the same way a pocket calculator would
function calc_press($expr, $key)
{
    if ($expr === 'Error') $expr = '';
    $last = substr($expr, -1);

    if (is_operator($key)) {
        if ($expr === '' && $key !== '-') return $expr;
        if (is_operator($last)) $expr = substr($expr, 0, -1);
    } elseif ($key === '.') {
        $parts = preg_split('/[+\-*\/]/', $expr);
        $current = end($parts);
        if (strpos($current, '.') !== false) return $expr;
        if ($current === '') $key = '0.';
    } elseif (!ctype_digit($key)) {
        return $expr;
    }
    return $expr . $key;
}

// Formats a calculator result without trailing zeros (12.50 -> "12.5")
function calc_format($n)
{
    return rtrim(rtrim(number_format($n, 2, '.', ''), '0'), '.');
}

// ---------- Request handling ----------
if (!isset($_SESSION['pos'])) {
    $_SESSION['pos'] = [
        'items'       => [],   // saved order lines
        'selected'    => -1,   // row picked from the order list (for UPDATE)
        'cash'        => '',   // last Cash Given entered
        'change_for'  => null, // Cash Given that CALCULATE CHANGE last ran with
    ];
}
$pos = &$_SESSION['pos'];

$form = [
    'item_name'    => '',
    'qty'          => '',
    'price'        => '',
    'discount'     => 'none',
    'cash_given'   => $pos['cash'],
    'calc_display' => '',
    'calc_target'  => '',
];
$line = null;      // discount figures shown in Discount Amount / Discounted Amount
$message = null;   // ['text' => ..., 'type' => bootstrap alert colour]

function clear_item_fields(&$form, &$pos)
{
    $form['item_name'] = $form['qty'] = $form['price'] = '';
    $form['discount'] = 'none';
    $pos['selected'] = -1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (array_keys($form) as $field) {
        if (isset($_POST[$field])) $form[$field] = trim((string) $_POST[$field]);
    }
    if (!isset(DISCOUNT_RATES[$form['discount']])) $form['discount'] = 'none';
    if (!isset(CALC_TARGETS[$form['calc_target']])) $form['calc_target'] = '';
    $form['calc_display'] = $form['calc_display'] === 'Error'
        ? 'Error'
        : preg_replace('/[^0-9.+\-*\/]/', '', $form['calc_display']);

    if (isset($_POST['calc_key'])) {
        $form['calc_display'] = calc_press($form['calc_display'], (string) $_POST['calc_key']);
    } elseif (isset($_POST['select_row'])) {
        // Clicking a saved row loads it back into the form for UPDATE
        $i = (int) $_POST['select_row'];
        if (isset($pos['items'][$i])) {
            $it = $pos['items'][$i];
            $pos['selected'] = $i;
            $form['item_name'] = $it['name'];
            $form['qty'] = (string) $it['qty'];
            $form['price'] = (string) $it['price'];
            $form['discount'] = $it['type'];
            $message = ['text' => 'Editing item #' . ($i + 1) . '. Change the fields, then press UPDATE.', 'type' => 'info'];
        }
    } else {
        switch ($_POST['action'] ?? 'preview') {
            case 'save':
                [$item, $error] = read_item($form);
                if ($error) {
                    $message = ['text' => $error, 'type' => 'danger'];
                    break;
                }
                $pos['items'][] = $item;
                $pos['change_for'] = null;
                $line = $item;
                clear_item_fields($form, $pos);
                $message = ['text' => 'Saved <b>' . h($item['name']) . '</b> to the order.', 'type' => 'success'];
                break;

            case 'update':
                if (!isset($pos['items'][$pos['selected']])) {
                    $message = ['text' => 'Click an item in the order list first, then press UPDATE.', 'type' => 'danger'];
                    break;
                }
                [$item, $error] = read_item($form);
                if ($error) {
                    $message = ['text' => $error, 'type' => 'danger'];
                    break;
                }
                $n = $pos['selected'] + 1;
                $pos['items'][$pos['selected']] = $item;
                $pos['change_for'] = null;
                $line = $item;
                clear_item_fields($form, $pos);
                $message = ['text' => "Updated item #$n.", 'type' => 'success'];
                break;

            case 'new':
                $pos['items'] = [];
                $pos['change_for'] = null;
                clear_item_fields($form, $pos);
                $form['cash_given'] = '';
                break;

            case 'calculate':
                $total = order_totals($pos['items'])['amount'];
                $cash = $form['cash_given'];
                if (!$pos['items']) {
                    $message = ['text' => 'Save at least one item before calculating change.', 'type' => 'danger'];
                } elseif (!is_numeric($cash) || $cash <= 0) {
                    $message = ['text' => 'Enter the cash given.', 'type' => 'danger'];
                } elseif ($cash < $total) {
                    $message = ['text' => 'Insufficient cash: P' . money($cash) . ' given, P' . money($total) . ' due.', 'type' => 'danger'];
                } else {
                    $pos['change_for'] = $cash;
                }
                break;

            case 'calc_enter':
                $expr = preg_replace('/[+\-*\/.]$/', '', $form['calc_display']);
                if ($expr === '' || $expr === 'Error') break;
                $result = calc_evaluate($expr);
                if ($result === null) {
                    $form['calc_display'] = 'Error';
                    break;
                }
                $form['calc_display'] = calc_format($result);
                if ($form['calc_target'] === 'qty') {
                    $form['qty'] = (string) round($result);
                } elseif ($form['calc_target'] !== '') {
                    $form[$form['calc_target']] = calc_format($result);
                }
                break;

            case 'calc_clear':
                $form['calc_display'] = '';
                break;

            // 'preview' (pressing Enter in a field, picking a book or a discount) just recomputes
        }
    }
}

$pos['cash'] = $form['cash_given'];

// Live per-item computation of the fields currently in the form
if ($line === null && is_numeric($form['qty']) && is_numeric($form['price'])
    && $form['qty'] > 0 && $form['price'] > 0) {
    $line = compute_line((float) $form['qty'], (float) $form['price'], $form['discount']);
}

$totals = order_totals($pos['items']);

// Change stays on screen until the order or the cash given changes
$change = '';
if ($pos['change_for'] !== null) {
    if ($pos['items'] && $pos['change_for'] === $form['cash_given'] && $form['cash_given'] >= $totals['amount']) {
        $change = money(round($form['cash_given'] - $totals['amount'], 2));
    } else {
        $pos['change_for'] = null;
    }
}
