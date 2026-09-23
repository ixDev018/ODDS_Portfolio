import os
import re

views_dir = r'resources/views'

all_files = []
for root, dirs, files in os.walk(views_dir):
    if 'admin' in root or 'emails' in root:
        continue
    for f in files:
        if f.endswith('.blade.php'):
            all_files.append(os.path.join(root, f))

print(f"Frontend files scanned: {len(all_files)}")

links = []
onclicks = []
buttons = []
forms = []

for fpath in all_files:
    rel = os.path.relpath(fpath, views_dir)
    with open(fpath, 'r', encoding='utf-8', errors='ignore') as f:
        content = f.read()

    # href
    for m in re.finditer(r'href=["\']([^"\']*)["\']', content):
        val = m.group(1).strip()
        line = content[:m.start()].count('\n') + 1
        links.append((rel, line, val))

    # onclick
    for m in re.finditer(r'onclick=["\']([^"\']*)["\']', content):
        val = m.group(1).strip()
        line = content[:m.start()].count('\n') + 1
        onclicks.append((rel, line, val))

    # form actions
    for m in re.finditer(r'<form\b[^>]*action=["\']([^"\']*)["\']', content, re.IGNORECASE):
        val = m.group(1).strip()
        line = content[:m.start()].count('\n') + 1
        forms.append((rel, line, val))

    # buttons without onclick or type=submit
    for m in re.finditer(r'<button\b([^>]*)>(.*?)</button>', content, re.DOTALL | re.IGNORECASE):
        attrs = m.group(1)
        body = m.group(2).strip()[:40]
        line = content[:m.start()].count('\n') + 1
        buttons.append((rel, line, attrs, body))

print("\n=================== FORMS ===================")
for rel, line, val in forms:
    print(f"[{rel}:{line}] action='{val}'")

print("\n=================== LINKS (href) ===================")
for rel, line, val in links:
    if val.startswith('http://') or val.startswith('https://') or val.startswith('//'):
        print(f"[EXTERNAL] [{rel}:{line}] {val}")
    elif val.startswith('#'):
        print(f"[ANCHOR]   [{rel}:{line}] {val}")
    elif val.startswith('mailto:') or val.startswith('tel:'):
        print(f"[CONTACT]  [{rel}:{line}] {val}")
    elif 'route(' in val or 'url(' in val or val.startswith('/'):
        print(f"[INTERNAL] [{rel}:{line}] {val}")
    else:
        print(f"[OTHER]    [{rel}:{line}] {val}")

print("\n=================== ONCLICKS ===================")
for rel, line, val in onclicks:
    print(f"[{rel}:{line}] {val}")
