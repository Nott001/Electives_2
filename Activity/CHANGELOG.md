# Changelog

All notable changes to this project are documented in this file.
Format: [Keep a Changelog](https://keepachangelog.com/en/1.1.0/) — dated, grouped by version.

## [1.3.0] - 2026-10-22

### Changed
- Page layout is now two columns: book covers and the order form (details, discount options, buttons, Order List) scroll on the left, while the **calculator is pinned** in a sticky sidebar on the right (`.pos-sidebar`, `position: sticky` at ≥ 992px; it stacks below on narrow screens).
- The order `<form>` now wraps the whole catalog + sidebar so the calculator keys still post with it; the form returns to `#order_details` after each submit.

## [1.2.0] - 2026-10-07

### Changed
- Order form and calculator logic moved from JavaScript to PHP: new **`includes/book_pos.php`**, required at the top of all 5 pages.
  - The order section is now a `<form method="post">`; every button (SAVE / UPDATE / NEW / CALCULATE CHANGE, calculator keys, ENTER, C) submits it and PHP computes the discounts, totals, change and calculator result.
  - Saved order lines are stored in the PHP session (shared across the genre pages); the Order List table is rendered by PHP.
  - The calculator's ENTER target is now chosen with a dropdown (`#calc_target`) instead of the last-focused field.
- `js/book_pos.js` reduced to UI glue: clicking a book cover fills the name/price and asks PHP to recompute; changing the discount recomputes; clicking an Order List row selects it.

## [1.1.0] - 2026-10-06

### Added
- **`js/book_pos.js`** — shared order form logic, included by all 5 pages:
  - Clicking a book cover fills Name of an Item / Price (Quantity defaults to 1).
  - Discount Amount and Discounted Amount compute live from Quantity × Price and the selected discount (Senior Citizen 20%, With Disc. Card 10%, Employee Disc. 15%, No Discount 0%).
  - **SAVE** adds the item to a new Order List table and updates Total Quantity, Total Discount Given and Total Discounted Amount.
  - **UPDATE** edits the Order List row that was clicked.
  - **NEW** clears the order for a new transaction.
  - **CALCULATE CHANGE** computes Cash Given − Total Discounted Amount, with validation messages.
  - Calculator pad now works: display + **C** clear button, operator precedence, division-by-zero handling (no `eval`); ENTER sends the result to the last-focused Quantity / Price / Cash Given field.
- Order List table, message area, and calculator display styles in `css/book_pos.css`.
- `TestPosWiring` tests in `tests/test_pages.py`.

## [1.0.0] - 2026-09-08

### Added
- **`fiction.php`** — Fiction catalog page (14 books). Includes the original 12 cover images plus *The Pale King* and *The Sellout*.
- **`classics.php`** — Classics catalog page (10 books): 7 Shakespeare plays, *Cancer Ward*, *The Brothers Karamazov*, *No Longer Human*.
- **`scifi.php`** — Sci-Fi catalog page (10 books): *Version Control*, *Dead Astronauts*, *The Visible Man*, padded with reused covers to meet the 10-image minimum.
- **`mystery.php`** — Mystery catalog page (10 books): *The Knives Come Down*, *A Thousand Black Umbrellas*, *Cunning Plans*, *The Everlasting*, padded with reused covers.
- **`nonfiction.php`** — Non-Fiction catalog page (10 books): *Nature and Value*, *The Reason for Flowers*, *Birds of America*, *The Art of Cunning*, *The Art of Immersion*, *The Art of War*, padded with reused covers.
- **`css/book_pos.css`** — shared stylesheet for all 5 genre pages (page wrapper, top bar, picture grid, item labels, order form, discount panel, calculator grid).
- **`CHANGELOG.md`** — this file.

### Notes
- All 5 pages share the identical Bootstrap 4 order form: **Order Details** fields (Name of an Item, Quantity, Price, plus `readonly` Discount Amount, Discounted Amount, Total Quantity, Total Discount Given, Total Discounted Amount, Cash Given, Change), **Order Discount Options** radios (Senior Citizen / With Disc. Card / Employee Disc. / No Discount), action buttons (CALCULATE CHANGE / NEW / SAVE / UPDATE), and the calculator pad (ENTER + `/ * -`, `+ 6 7`, `8 9 2`, `3 4 5`, `0 . 1`).
- Genre dropdown on every page navigates via `window.location.href` and marks the current page's option `selected`; a SEARCH button (placeholder, non-functional) sits in the top bar.
- Book covers are reused across genre pages to reach the assignment's 10+ images-per-page requirement (only 33 unique covers exist; 54 slots are needed). Each page's own 10 images are unique within that page.
- Reached at `http://localhost:8080/<page>.php`. Calculator logic, SAVE/UPDATE/NEW wiring, and DB integration intentionally not implemented (out of scope for this lesson).

### Known limitations
- Some padding covers on Sci-Fi/Mystery/Non-Fiction pages do not match their genre (e.g. *The Mother, The Daughter* under Sci-Fi) due to the limited cover set. Replace these with genre-accurate covers as they become available.
