# Changelog

All notable changes to this project are documented in this file.
Format: [Keep a Changelog](https://keepachangelog.com/en/1.1.0/) — dated, grouped by version.

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
