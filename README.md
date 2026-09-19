# Electives 2 — Book Store Activity

A school activity for a **BSCPE** course (Lesson 3: Web Page Design using HTML, CSS, and Bootstrap 4). This project is a themed **book store** with 5 genre catalog pages, each featuring a product grid and a POS-style order form with a discount panel and calculator.

## Live Demo

Once Docker is running, access the app at:

- **Store:** `http://localhost:8080/fiction.php` (or any genre page)
- **phpMyAdmin:** `http://localhost:8081`

## Pages

| Page | Genre | URL |
|------|-------|-----|
| `fiction.php` | Fiction | `/fiction.php` |
| `classics.php` | Classics | `/classics.php` |
| `scifi.php` | Sci-Fi | `/scifi.php` |
| `mystery.php` | Mystery | `/mystery.php` |
| `nonfiction.php` | Non-Fiction | `/nonfiction.php` |

Every page shares the same structure and styling (`css/book_pos.css`) and differs only in images and book labels. A genre dropdown in the top bar navigates between all 5 pages.

## Features

- **Bootstrap 4.5** responsive layout with 10+ book covers per genre page
- **Genre dropdown** with automatic navigation via `window.location.href`
- **Order form** with fields: Name of Item, Quantity, Price, Discount Amount, Discounted Amount, Total Quantity, Total Discount Given, Total Discounted Amount, Cash Given, Change
- **Discount options**: Senior Citizen, With Disc. Card, Employee Disc., No Discount
- **Calculator pad** (digit/operator grid + ENTER)
- **Tooltip** hover effects on book covers (Bootstrap tooltips)
- **Dockerized** environment — no XAMPP or local PHP install needed

## Getting Started

### Prerequisites

- [Docker](https://www.docker.com/get-started/) and [Docker Compose](https://docs.docker.com/compose/install/) installed

### Run

```bash
cd Activity
docker-compose up -d
```

Open `http://localhost:8080/fiction.php` in your browser.

> **Note:** The project folder is live-mounted into the container, so edits to HTML/CSS/PHP files take effect immediately — no rebuild needed. Only `Dockerfile` changes require a rebuild (`docker-compose build && docker-compose up -d`).

## Project Structure

```
Electives_2/
├── README.md
└── Activity/
    ├── .env                      # DB_ROOT_PASSWORD=root
    ├── Dockerfile                # php:8.2-apache + pdo/pdo_mysql/mysqli
    ├── docker-compose.yml        # web / db / phpmyadmin services
    ├── PLAN.md                   # Detailed activity plan and task breakdown
    ├── CHANGELOG.md              # Version history
    ├── fiction.php               # Page 1 — Fiction (14 books)
    ├── classics.php              # Page 2 — Classics (10 books)
    ├── scifi.php                 # Page 3 — Sci-Fi (10 books)
    ├── mystery.php               # Page 4 — Mystery (10 books)
    ├── nonfiction.php            # Page 5 — Non-Fiction (10 books)

    └── CHANGELOG.md
```

## Docker Services

| Service | Image | Port | Purpose |
|---------|-------|------|---------|
| `web` | `php:8.2-apache` | 8080 | PHP + Apache web server |
| `db` | `mysql:8.0` | 3306 | MySQL database (ready for future lessons) |
| `phpmyadmin` | `phpmyadmin/phpmyadmin` | 8081 | Database admin UI |

## Technologies

- **PHP 8.2**
- **Bootstrap 4.5.2**
- **jQuery 3.5.1** + **Popper.js**
- **Docker & Docker Compose**
- **MySQL 8.0**

## Status

All 5 genre pages are **complete** and functional. Calculator logic, SAVE/UPDATE/NEW button wiring, and database integration are intentionally out of scope for this lesson.

See [CHANGELOG.md](Activity/CHANGELOG.md) for details.
