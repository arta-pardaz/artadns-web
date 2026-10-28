import unittest
from html.parser import HTMLParser
from string import Template

from build_menu import Boundaries, build, generate, load_site, render_links


class Links(HTMLParser):
    def __init__(self, source):
        super().__init__()
        self.links = []
        self.feed(source)

    def handle_starttag(self, tag, attrs):
        if tag == "a":
            self.links.append(dict(attrs))


class MenuTests(unittest.TestCase):
    def test_generated_output_and_idempotence(self):
        pages, parsed, items, template = load_site()
        self.assertEqual(build(check=True), pages)
        for page, source in pages.items():
            generated = generate(source, parsed[page].regions, items, template, page)
            self.assertEqual(generated, source)
            self.assertEqual(generate(generated, Boundaries(generated).regions, items, template, page), generated)

    def test_links_active_state_and_mobile_parity(self):
        pages, parsed, _, _ = load_site()
        for page, source in pages.items():
            menus = []
            for kind, (start, end) in parsed[page].regions.items():
                links = Links(source[start:end]).links
                menus.append([(link["href"], link.get("aria-current")) for link in links])
                self.assertEqual(len(links), 7)
                active = []
                for link in links:
                    target, _, fragment = link["href"].partition("#")
                    target = target or page
                    self.assertIn(target, pages)
                    if fragment:
                        self.assertIn(fragment, parsed[target].ids)
                    if "aria-current" in link:
                        self.assertEqual(link["aria-current"], "page")
                        active.append(link["href"])
                    self.assertEqual(link["class"], "nav-link mobile-link" if kind == "mobile" else "nav-link")
                self.assertEqual(active, [page])
            self.assertEqual(menus[0], menus[1])

    def test_replaces_only_menu_contents(self):
        pages, parsed, items, template = load_site()
        changed = [dict(item, label="Changed") for item in items]
        for page, source in pages.items():
            generated = generate(source, parsed[page].regions, changed, template, page)
            def outside(text):
                for start, end in sorted(Boundaries(text).regions.values(), reverse=True):
                    text = text[:start] + text[end:]
                return text
            self.assertEqual(outside(source), outside(generated))

    def test_invalid_boundaries_fail(self):
        pages, _, _, _ = load_site()
        source = pages["index.html"]
        with self.assertRaises(ValueError):
            Boundaries(source.replace('class="nav-menu"', 'class="missing-menu"'))
        with self.assertRaises(ValueError):
            Boundaries(source.replace('</header>', '<nav class="nav-menu"></nav></header>'))

    def test_template_escapes_content(self):
        links = render_links([{"page": "index.html", "label": '<script>"&'}], Template('<a href="$href" class="$classes"$active>$label</a>'), "download.html", False)
        self.assertIn('&lt;script&gt;&quot;&amp;', links[0])


if __name__ == "__main__":
    unittest.main()
