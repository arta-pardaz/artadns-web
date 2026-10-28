import argparse
import json
import re
from html import escape
from html.parser import HTMLParser
from pathlib import Path
from string import Template

ROOT = Path(__file__).resolve().parent


class Boundaries(HTMLParser):
    def __init__(self, source):
        super().__init__(convert_charrefs=False)
        self.source = source
        self.lines = [0]
        for match in re.finditer("\n", source):
            self.lines.append(match.end())
        self.stack = []
        self.regions = {}
        self.ids = set()
        self.feed(source)
        self.close()
        if set(self.regions) != {"desktop", "mobile"}:
            raise ValueError("Expected exactly one desktop and mobile menu")

    def position(self):
        line, column = self.getpos()
        return self.lines[line - 1] + column

    def handle_starttag(self, tag, attrs):
        attrs = dict(attrs)
        if "id" in attrs:
            self.ids.add(attrs["id"])
        classes = attrs.get("class", "").split()
        region = None
        if tag == "nav" and "nav-menu" in classes:
            region = "desktop"
        if tag == "ul" and self.stack and self.stack[-1][2] == "mobileMenuDrawer":
            region = "mobile"
        if tag not in {"area", "base", "br", "col", "embed", "hr", "img", "input", "link", "meta", "param", "source", "track", "wbr"}:
            self.stack.append((tag, region, attrs.get("id"), self.position() + len(self.get_starttag_text())))

    def handle_startendtag(self, tag, attrs):
        if dict(attrs).get("id"):
            self.ids.add(dict(attrs)["id"])

    def handle_endtag(self, tag):
        if not self.stack or self.stack[-1][0] != tag:
            raise ValueError(f"Unbalanced HTML at {self.getpos()}: {tag}")
        _, region, _, start = self.stack.pop()
        if region:
            if region in self.regions:
                raise ValueError(f"Duplicate {region} menu")
            self.regions[region] = (start, self.position())


def load_site():
    pages = {path.name: path.read_bytes().decode("utf-8") for path in sorted(ROOT.glob("*.html")) if path.name != "menu-link.html"}
    if not pages:
        raise ValueError("No site pages found")
    parsed = {name: Boundaries(source) for name, source in pages.items()}
    items = json.loads((ROOT / "menu.json").read_text(encoding="utf-8"))
    seen = set()
    if not items:
        raise ValueError("Empty menu")
    for item in items:
        if set(item) - {"page", "fragment", "label"}:
            raise ValueError("Unknown menu property")
        page_name, label = item["page"], item["label"]
        fragment = item.get("fragment", "")
        if not isinstance(label, str) or not label.strip() or page_name not in pages:
            raise ValueError(f"Invalid menu item: {item}")
        if fragment and fragment not in parsed[page_name].ids:
            raise ValueError(f"Missing anchor: {page_name}#{fragment}")
        key = (page_name, fragment)
        if key in seen:
            raise ValueError(f"Duplicate menu destination: {key}")
        seen.add(key)
    template = Template((ROOT / "menu-link.html").read_text(encoding="utf-8").strip())
    return pages, parsed, items, template


def render_links(items, template, page, mobile):
    links = []
    for item in items:
        item_page = item.get("page", page)
        fragment = item.get("fragment", "")
        if fragment and item_page == page:
            href = f"#{fragment}"
        elif fragment:
            href = f"{item_page}#{fragment}"
        else:
            href = item_page
        link = template.substitute(
            href=escape(href, quote=True),
            classes="nav-link mobile-link" if mobile else "nav-link",
            active=' aria-current="page"' if page == item_page and not fragment else "",
            label=escape(item["label"]),
        )
        links.append(f"<li>{link}</li>" if mobile else link)
    return links


def generate(source, regions, items, template, page):
    newline = "\r\n" if "\r\n" in source else "\n"
    for kind, (start, end) in sorted(regions.items(), key=lambda entry: entry[1][0], reverse=True):
        closing_indent = source[source.rfind("\n", 0, end) + 1:end]
        if closing_indent.strip():
            raise ValueError(f"Menu closing tag must be on its own line: {page}")
        links = render_links(items, template, page, kind == "mobile")
        content = newline + newline.join(closing_indent + "  " + link for link in links) + newline + closing_indent
        source = source[:start] + content + source[end:]
    return source


def build(check=False):
    pages, parsed, items, template = load_site()
    outputs = {name: generate(source, parsed[name].regions, items, template, name) for name, source in pages.items()}
    stale = [name for name in pages if pages[name] != outputs[name]]
    if check and stale:
        raise ValueError(f"Stale menus: {', '.join(stale)}")
    if not check:
        for name in stale:
            (ROOT / name).write_bytes(outputs[name].encode("utf-8"))
    return outputs


if __name__ == "__main__":
    parser = argparse.ArgumentParser()
    parser.add_argument("--check", action="store_true")
    args = parser.parse_args()
    output = build(args.check)
    print(f"{'Checked' if args.check else 'Built'} menus for {len(output)} pages")
