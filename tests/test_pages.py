import unittest
import os
import re

BASE_DIR = os.path.join(os.path.dirname(os.path.dirname(os.path.abspath(__file__))), "Activity")
CSS_PATH = os.path.join(BASE_DIR, "css", "book_pos.css")

GENRES = {
    "fiction": "Fiction",
    "classics": "Classics",
    "scifi": "Sci-Fi",
    "mystery": "Mystery",
    "nonfiction": "Non-Fiction",
}


def read_page(genre):
    with open(os.path.join(BASE_DIR, f"{genre}.php")) as f:
        return f.read()


class TestPagesExist(unittest.TestCase):
    def test_all_genre_pages_exist(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                self.assertTrue(
                    os.path.isfile(os.path.join(BASE_DIR, f"{genre}.php")),
                    f"{genre}.php not found",
                )

    def test_css_file_exists(self):
        self.assertTrue(os.path.isfile(CSS_PATH), f"CSS file not found at {CSS_PATH}")


class TestPageStructure(unittest.TestCase):
    def test_page_has_correct_title(self):
        for genre, name in GENRES.items():
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn(
                    f"<title>Robert's Book Store - {name}</title>",
                    html,
                )

    def test_page_has_bootstrap_cdn(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn("bootstrap/4.5.2/css/bootstrap.min.css", html)
                self.assertIn("bootstrap/4.5.2/js/bootstrap.min.js", html)

    def test_page_has_jquery_and_popper(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn("jquery/3.5.1/jquery.min.js", html)
                self.assertIn("popper.js/1.16.0/umd/popper.min.js", html)

    def test_page_has_css_link(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn('href="css/book_pos.css"', html)

    def test_page_has_store_title(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn("Robert's Book Store", html)

    def test_page_has_genre_dropdown(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn('class="form-control genre_select"', html)
                self.assertIn("onchange=\"if(this.value) window.location.href=this.value;\"", html)
                for g in GENRES:
                    self.assertIn(f"value=\"{g}.php\"", html)

    def test_page_has_search_button(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn('class="btn btn-danger"', html)
                self.assertIn("SEARCH", html)


class TestBookCatalog(unittest.TestCase):
    def test_page_has_book_images(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                img_count = len(re.findall(r'<img ', html))
                self.assertGreaterEqual(img_count, 10, f"{genre}.php has fewer than 10 book images")

    def test_page_has_book_prices(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                price_count = len(re.findall(r'class="book_price"', html))
                self.assertGreaterEqual(price_count, 10, f"{genre}.php has fewer than 10 book prices")
                for match in re.finditer(r'class="book_price">(P[\d,]+\.00)', html):
                    price = match.group(1)
                    self.assertRegex(price, r'^P[\d,]+\.00$')

    def test_page_has_tooltips(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                tooltip_count = len(re.findall(r'data-toggle="tooltip"', html))
                self.assertGreaterEqual(tooltip_count, 10, f"{genre}.php has fewer than 10 tooltips")

    def test_page_has_pic_group(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn('class="pic_group"', html)
                self.assertIn('class="pic_option"', html)


class TestOrderForm(unittest.TestCase):
    def test_page_has_order_section(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn('class="order-section"', html)

    def test_page_has_order_form_fields(self):
        required_fields = [
            "item_name", "qty", "price", "disc_amount",
            "discounted_amount", "total_qty", "total_disc",
            "total_disc_amount", "cash_given", "change",
        ]
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                for field in required_fields:
                    self.assertIn(f'id="{field}"', html,
                                  f"{genre}.php missing field id={field}")

    def test_calculated_fields_are_readonly(self):
        readonly_fields = ["disc_amount", "discounted_amount", "total_qty",
                           "total_disc", "total_disc_amount", "change"]
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                for field in readonly_fields:
                    self.assertRegex(
                        html, rf'id="{field}"[^>]*readonly',
                        f"{genre}.php: {field} should be readonly",
                    )

    def test_page_has_discount_options(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn('value="senior"', html)
                self.assertIn('value="card"', html)
                self.assertIn('value="employee"', html)
                self.assertIn('value="none"', html)

    def test_page_has_action_buttons(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn("CALCULATE CHANGE", html)
                self.assertIn("NEW", html)
                self.assertIn("SAVE", html)
                self.assertIn("UPDATE", html)

    def test_page_has_calculator_pad(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn("ENTER", html)
                self.assertIn("Calculator", html)
                for btn in ["/", "*", "-", "+"]:
                    self.assertIn(btn, html)
                for digit in ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]:
                    self.assertIn(f">{digit}<", html)

    def test_page_has_tooltip_script(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn("$('[data-toggle=\"tooltip\"]').tooltip()", html)


class TestPageConsistency(unittest.TestCase):
    def test_all_pages_have_same_order_section_structure(self):
        pages_content = {g: read_page(g) for g in GENRES}
        order_sections = {}
        for genre, html in pages_content.items():
            match = re.search(r'<div class="order-section">.*?</div>\s*</div>\s*</div>', html, re.DOTALL)
            if not match:
                match = re.search(r'<div class="order-section">.*?</div>', html, re.DOTALL)
            order_sections[genre] = match.group(0) if match else ""

        for genre in GENRES:
            with self.subTest(genre=genre):
                self.assertIn('class="row"', order_sections[genre])
                self.assertIn('col-md-7', order_sections[genre])
                self.assertIn('col-md-5', order_sections[genre])

    def test_all_pages_link_to_same_css(self):
        for genre in GENRES:
            with self.subTest(genre=genre):
                html = read_page(genre)
                self.assertIn('href="css/book_pos.css"', html)


if __name__ == "__main__":
    unittest.main()
