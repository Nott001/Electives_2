# Robert's Book Store — Elective 2 Activity Plan

## Context

This is a school activity (Lesson 3: Web Page Design using HTML, CSS, and Bootstrap 4) for a BSCPE course. The environment runs on **Docker** (not XAMPP as the original lesson module assumes) on **Ubuntu**.

The assignment requires **5 linked webpages**, each displaying a themed product catalog (10+ images with name/price labels), a dropdown that navigates between the 5 pages, and a POS-style order form with a discount panel and calculator button grid. All 5 pages share identical structure/CSS and differ only in images and labels.

Theme chosen: **a book store**, with the 5 required categories mapped to book genres:
1. Fiction
2. Classics
3. Sci-Fi
4. Mystery
5. Non-Fiction

## Environment

- **OS:** Ubuntu
- **Project root:** `/home/nott/Electives_2/Activity`
- **Runtime:** Docker Compose — 3 services:
  - `web` (PHP 8.2 + Apache, built from a local `Dockerfile` that adds `pdo`, `pdo_mysql`, `mysqli` extensions)
  - `db` (MySQL 8.0) — not currently used by any page, but running and ready for a future lesson
  - `phpmyadmin` — DB admin UI at `http://localhost:8081`
- **App URL:** `http://localhost:8080/<pagename>.php`
- **Folder is live-mounted** into the container (`./:/var/www/html`) — no rebuild needed for HTML/CSS/PHP edits, only for `Dockerfile` changes.

### Existing files (already working)
```
Activity/
├── .env                        # DB_ROOT_PASSWORD=root
├── Dockerfile                  # php:8.2-apache + mysql extensions
├── docker-compose.yml          # web / db / phpmyadmin services
├── book_images/                # 12 real book cover images (see below)
├── css/
│   └── book_pos.css            # shared stylesheet (already built)
├── fiction.php                 # Page 1 — COMPLETE, using real images below

```

### Available real images in `book_images/`
```
How_i_killed_pluto.jpg
all_things_cease_to_appear.png
art_of_war.jpg
brothes_karamazov.jpg
closing_time.jpg
dead_astronauts.jpg
no_longer_human.jpg
no_to_disturb.jpg
numbers.jpg
the_mother_the_daughter.png
tyll.jpg
ugly_man.jpg
```
These 12 images are currently ALL used on `fiction.php`. The other 4 pages need their own distinct sets of book cover images (see Task 2 below) — reusing the same 12 across every page is not in the spirit of the assignment (each page should represent a different genre with different books).

## Task 1 — Verify/finish `fiction.php` (should already be done)

File: `fiction.php`
CSS: `css/book_pos.css`

Structure (already built, verify it matches):
- Bootstrap 4.5.2 CDN + jQuery + Popper + Bootstrap JS (same CDN links as the lesson module)
- `<link rel="stylesheet" href="css/book_pos.css">`
- Page title: "Robert's Book Store"
- Top bar: a `SEARCH` button (Bootstrap `btn btn-danger`, non-functional placeholder is fine) + a `<select>` dropdown with:
  ```html
  <option value="">----------------select genre</option>
  <option value="fiction.php">Fiction</option>
  <option value="classics.php">Classics</option>
  <option value="scifi.php">Sci-Fi</option>
  <option value="mystery.php">Mystery</option>
  <option value="nonfiction.php">Non-Fiction</option>
  ```
  with `onchange="if(this.value) window.location.href=this.value;"` so selecting an option navigates to that page.
- A `.pic_group` of `.pic_option` divs, each containing an `<img>` (with `data-toggle="tooltip"` and a `title` attribute for the hover tooltip) and a `.item_label` div showing `<book title> P<price>.00` (bold the price).
- Below the grid: an `.order-section` two-column Bootstrap row:
  - Left column ("Order Details"): labeled inputs for Name of an Item, Quantity, Price, Discount Amount, Discounted Amount, Total Quantity, Total Discount Given, Total Discounted Amount, Cash Given, Change (calculated fields are `readonly`).
  - Right column ("Order Discount Options"): 4 radio buttons (Senior Citizen / With Disc. Card / Employee Disc. / No Discount), 4 action buttons (CALCULATE CHANGE / NEW / SAVE / UPDATE), and a calculator-style number pad (ENTER button + digit/operator grid: `/ * -`, `+ 6 7`, `8 9 2`, `3 4 5`, `0 . 1`) matching the sample screenshots' layout.
- Closing `<script>` that activates Bootstrap tooltips:
  ```js
  $(document).ready(function(){ $('[data-toggle="tooltip"]').tooltip(); });
  ```

**Acceptance check:** loading `http://localhost:8080/fiction.php` shows the store title, dropdown, 12 book covers with names/prices, and the full order form + calculator layout below, styled per `book_pos.css`.

## Task 2 — Source images for the remaining 4 genres

Each of the following pages needs **10+ distinct book cover images** (do not reuse the Fiction 12). Images go in `book_images/`, ideally with a genre prefix or subfolder to keep things organized as the folder grows — e.g. keep a flat `book_images/` folder but use clearly distinct filenames per genre (no collisions).

Recommended: create subfolders to avoid filename collisions and keep things organized:
```
book_images/
├── fiction/       (already-used 12 images — optionally move them here and update fiction.php paths)
├── classics/
├── scifi/
├── mystery/
└── nonfiction/
```
If reorganizing into subfolders, **update the `src="book_images/..."` paths in `fiction.php` accordingly** (`book_images/fiction/<file>`).

Genre guidance (10 books minimum each):
- **Classics:** e.g. Pride and Prejudice, Moby Dick, War and Peace, 1984, Anna Karenina, Great Expectations, Wuthering Heights, Crime and Punishment, The Odyssey, Don Quixote
- **Sci-Fi:** e.g. Dune, Foundation, Neuromancer, The Left Hand of Darkness, Snow Crash, Hyperion, The Martian, Ender's Game, Fahrenheit 451, Brave New World
- **Mystery:** e.g. The Girl with the Dragon Tattoo, Gone Girl, And Then There Were None, The Big Sleep, In the Woods, Sharp Objects, The Silent Patient, Rebecca, The Da Vinci Code, Big Little Lies
- **Non-Fiction:** e.g. Sapiens, Educated, Atomic Habits, Thinking Fast and Slow, Into the Wild, The Immortal Life of Henrietta Lacks, Quiet, Bad Blood, Born a Crime, The Wright Brothers

(These are suggestions only — swap in whatever cover images are actually available/legally usable. Book cover thumbnails for a class assignment are fine.)

**This task is on the user (Robert) to gather the actual image files** — the agent should pause and ask for the image filenames once they're placed in the folder, the same way it was done for `fiction.php`, rather than inventing fake file paths that don't exist.

## Task 3 — Build `classics.php`, `scifi.php`, `mystery.php`, `nonfiction.php`

For each of the 4 remaining pages:
1. Copy the full structure of `fiction.php`.
2. Change the `<title>` tag to reflect the genre (e.g. "Robert's Book Store - Classics").
3. Change the dropdown's `<select>` so the current page's option is NOT necessarily marked `selected` (optional nice-to-have: mark the current page as `selected` in each page's own dropdown so it shows the active genre).
4. Replace the `.pic_group` content with that genre's 10+ books (image src, tooltip title, item label name + price — invent reasonable prices in Philippine peso format `P###.00` consistent with the sample's price range of ~P200–P5,200).
5. Keep the `.order-section` (order form + discount options + calculator) **identical** across all 5 pages — this matches the assignment's explicit instruction that all pages share the same design script except images/labels.
6. Keep the shared `css/book_pos.css` link — do not create per-page CSS files.

## Task 4 — Cross-check dropdown navigation

On every one of the 5 pages, verify the dropdown contains all 5 `<option>` values pointing to the correct filenames (`fiction.php`, `classics.php`, `scifi.php`, `mystery.php`, `nonfiction.php`) and that selecting any option correctly navigates via `window.location.href`.

## Task 5 — Final verification pass

1. `docker ps` — confirm `book_store_web`, `book_store_db`, `book_store_pma` are all running.
2. Visit each of the 5 URLs and confirm:
   - Correct title and page-specific images/labels
   - Tooltips work on hover
   - Dropdown successfully navigates to all other 4 pages
   - Order form + discount radios + calculator grid render identically across all pages
3. Confirm no broken image icons (check filenames match exactly, case-sensitive on Linux).
4. Optional polish: add `alt` text to every `<img>` for accessibility, matching the `title` attribute.

## Explicitly out of scope for this task (do not build unless asked)

- Making the calculator buttons functionally compute anything (no JS logic wiring inputs to the calculator) — the lesson only covers HTML/CSS/Bootstrap structure at this point.
- Wiring the SAVE/UPDATE/NEW buttons to the MySQL database — `db`/`phpmyadmin` containers exist for a *future* lesson, not this activity.
- Adding real backend search functionality to the SEARCH button.

## Deliverable

5 working, visually consistent PHP pages (`fiction.php`, `classics.php`, `scifi.php`, `mystery.php`, `nonfiction.php`) reachable at `http://localhost:8080/<page>.php`, sharing `css/book_pos.css`, matching the layout and field requirements shown in the Lesson 3 Activity PDF's 5 sample screenshots, themed as a book store instead of the sample's perfume/bag/shoe/light/kitchen-utensil store.
