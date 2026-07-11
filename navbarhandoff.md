# Glassmorphism Adaptive Navbar Handoff Documentation

This document explains the implementation of the dynamic glassmorphism navbar system. The navbar's background, border, text, logo, and buttons adjust dynamically as the user scrolls, matching the background of the active section and shifting themes between dark and light modes for readability.

---

## Core Components

### 1. Inlined Dynamic Logo (`resources/views/components/navbar.blade.php`)
The ODDS SVG logo has been inlined inside the navbar link component. The hardcoded `fill="white"` attributes have been changed to `fill="currentColor"`.
This ensures that the logo dynamically inherits the parent `.navbar` color (`#fff` on dark sections, `#111` on light sections).

### 2. Glassmorphic CSS System (`resources/css/app.css`)
- **Scrolled Glass Properties**: When the page is scrolled (`.navbar.scrolled`), the navbar gets dynamic glass colors via CSS custom properties:
  - `background: var(--nav-bg, rgba(14, 14, 14, 0.65))`
  - `backdrop-filter: blur(16px)`
  - `border-bottom: 1px solid var(--nav-border, rgba(255, 255, 255, 0.08))`
- **Direct Scroll scrubbing**: Background and border color transitions are managed by GSAP and excluded from the CSS `transition` rule to ensure there is zero input lag during scrolling.
- **Theme Transitioning**: Text color (`color`), padding, and button colors transition smoothly over `0.3s ease` via CSS whenever the theme changes.
- **Adaptive Light Theme**: Added the `.navbar.light-theme` selector to convert elements to dark text, dark links, and a dark action button (`.btn-nav` with `#111` background and `#fff` text) for light sections (`#works`, `#why`).

### 3. Scroll Trigger Integration (`resources/js/app.js`)
- **Initial Load Check**: Toggles the `.scrolled` state immediately on page load, handling page refreshes at scrolled offsets.
- **Hero-to-Services Transition**: Animates the `--nav-bg` variable from Hero dark glass `rgba(14, 14, 14, 0.65)` to Services purple glass `rgba(135, 90, 245, 0.65)` directly inside the pinned ScrollTrigger timeline.
- **Boundary Triggers**: Sets up boundary mappings for subsequent sections:
  ```javascript
  const boundaries = [
      {
          trigger: '#works',
          colorFrom: 'rgba(135, 90, 245, 0.65)',
          colorTo: 'rgba(227, 227, 227, 0.65)',
          borderFrom: 'rgba(255, 255, 255, 0.08)',
          borderTo: 'rgba(0, 0, 0, 0.06)',
          themeFrom: 'dark',
          themeTo: 'light'
      },
      ...
  ];
  ```
  - **Background Blend**: Scrubbed `gsap.fromTo` transitions `--nav-bg` and `--nav-border` in real-time as a boundary passes the navbar (from `top 84px` to `top top`).
  - **Theme Toggle**: A separate `ScrollTrigger` toggles the `.light-theme` class at the exact midpoint (`top 42px`) to swap text and button readability seamlessly.
