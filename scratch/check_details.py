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

for fpath in all_files:
    rel = os.path.relpath(fpath, views_dir)
    with open(fpath, 'r', encoding='utf-8', errors='ignore') as f:
        content = f.read()

    # Find full <a ...> tags
    a_tags = re.findall(r'<a\b[^>]*>', content, re.IGNORECASE)
    # Find full <button ...> tags
    btn_tags = re.findall(r'<button\b[^>]*>.*?</button>', content, re.IGNORECASE | re.DOTALL)
    
    has_items = False
    for a in a_tags:
        # Ignore external asset links (like stylesheet link tags, wait <a ...> only)
        href_match = re.search(r'href=["\']([^"\']*)["\']', a)
        href = href_match.group(1) if href_match else 'NO_HREF'
        if not href.endswith('.css') and not 'fonts.' in href:
            if not has_items:
                print(f"\n=== FILE: {rel} ===")
                has_items = True
            print(f"  LINK: {a.strip()}")

    for b in btn_tags:
        # shorten inner html if long
        b_clean = re.sub(r'\s+', ' ', b).strip()
        if len(b_clean) > 120:
            b_clean = b_clean[:120] + '...'
        if not has_items:
            print(f"\n=== FILE: {rel} ===")
            has_items = True
        print(f"  BTN:  {b_clean}")
