# 🚀 ODDS Portfolio — System Architecture & Handoff Document

This document serves as the comprehensive architectural and system design handoff for the **ODDS Portfolio & Studio CMS** platform. It outlines the architecture, database schema, frontend engine, animation pipeline, backend CMS, and extension points.

---

## 1. System Overview & Tech Stack

| Layer | Technology | Version / Notes |
| :--- | :--- | :--- |
| **Backend Framework** | Laravel | v12 / PHP 8.2+ |
| **Frontend Templating** | Blade Components | Modular architecture (`x-layout`, sections, widgets) |
| **Styling & CSS** | Tailwind CSS + Custom CSS | Tailwind v4 + Custom variable theme engine (`app.css`) |
| **Animation Engine** | GSAP + ScrollTrigger | v3.15+ (Pinning, scrubbing, counters, draggable sliders) |
| **Asset Pipeline** | Vite | `laravel-vite-plugin` with hot reloading |
| **Database** | SQLite (Default) / MySQL (Ready) | Eloquent ORM + Migrations & Seeders |
| **Media Storage** | Local Public Disk / Cloudinary | Auto-fallback logic in `OddsAdminController` |
| **AI Subsystem** | Groq API (`llama-3.3-70b-versatile`) | Real-time chat widget client handler |

---

## 2. Directory Structure

```text
ODDS_Portfolio/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ChatController.php            # Groq AI chatbot interface
│   │   │   └── OddsAdminController.php       # Full Studio CMS operations & uploads
│   │   └── Middleware/
│   │       └── AdminAuthMiddleware.php       # Session-based CMS guard
│   ├── Models/
│   │   ├── OddsAboutSection.php              # Notion-style about page sections
│   │   ├── OddsInquiry.php                   # Contact form / lead inbox
│   │   ├── OddsService.php                   # Dynamic service cards
│   │   ├── OddsSetting.php                   # Hero copy, theme, contact info
│   │   ├── OddsTestimonial.php               # Client review cards & ratings
│   │   ├── OddsWhyReason.php                 # Value proposition blocks
│   │   └── OddsWork.php                      # Portfolio case studies & KPIs
│   └── Services/
│       └── GroqService.php                   # Groq API streaming & prompt service
├── database/
│   ├── migrations/                           # Schema definitions
│   └── seeders/
│       ├── OddsContentSeeder.php             # Default portfolio & work data
│       └── AboutSectionSeeder.php            # Default about us section blocks
├── resources/
│   ├── css/
│   │   └── app.css                           # Glassmorphic navbar, orb blurs, layout
│   ├── js/
│   │   └── app.js                            # GSAP ScrollTriggers, ticker, dragging
│   └── views/
│       ├── about.blade.php                   # Public dynamic About Us page
│       ├── home.blade.php                    # Public primary Landing Page
│       ├── admin/odds/                       # Studio CMS Blade Views
│       │   ├── dashboard.blade.php
│       │   ├── works/                        # Create, Edit, Reorder, Media Upload
│       │   ├── about/                        # Rich Notion-style block editor
│       │   ├── services.blade.php
│       │   ├── testimonials.blade.php
│       │   ├── inquiries.blade.php
│       │   └── settings.blade.php
│       ├── components/
│       │   ├── layout.blade.php              # Base HTML wrapper & font loader
│       │   ├── navbar.blade.php              # Adaptive glassmorphic header
│       │   ├── footer.blade.php
│       │   ├── project-modal.blade.php       # Work case study modal popup
│       │   └── odds-chat-widget.blade.php    # AI chat drawer widget
│       └── sections/                         # Modular landing page partials
│           ├── hero.blade.php
│           ├── services.blade.php
│           ├── works.blade.php
│           ├── testimonials.blade.php
│           ├── why.blade.php
│           └── cta.blade.php
└── routes/
    ├── web.php                               # Public & CMS admin routes
    └── api.php                               # AI Chat endpoint (`/api/chat`)
```

---

## 3. Database Schema & Data Models

### Entity Relationship Model

- **`odds_settings`**: Stores global branding, hero headline/subtitle copy, and contact credentials.
- **`odds_services`**: List of studio services rendered inside the infinite marquee ticker.
- **`odds_works`**: Showcase projects/case studies with rich body JSON, KPI metrics, tech stack tags, and media.
- **`odds_testimonials`**: Client reviews, star ratings (1-5), author avatar initials, and roles.
- **`odds_about_sections`**: Modular Notion-style block content powering `/about`.
- **`odds_why_reasons`**: High-level value propositions (Stack-Agnostic, Flexibility, Velocity).
- **`odds_inquiries`**: Lead capture form submissions storing name, email, company, service requested, message, and read state.

---

## 4. Key Subsystems & Design Patterns

### A. Dynamic Glassmorphic Adaptive Navbar
* **Components**: `resources/views/components/navbar.blade.php`, `resources/css/app.css`, `resources/js/app.js`
* **Mechanism**:
  - The navbar uses CSS custom properties `--nav-bg` and `--nav-border`.
  - As sections cross scroll boundaries (`#hero` ➔ `#services` ➔ `#works` ➔ `#testimonials` ➔ `#why` ➔ `#cta`), GSAP updates CSS variables in real time and toggles `.light-theme` / `.dark-theme` classes.
  - The SVG logo uses `fill="currentColor"` to inherit contrast changes instantly without visual flash.

### B. Fullscreen Landing Sections & Infinite Marquee
* **Hero Section**: Stacked concentric radial gradient glowing orbs (`blur(150px)`), anchored to left and right edges for ultra-wide and mobile screen stability.
* **Services Marquee**: CSS keyframe infinite loop with pause-on-hover and active card selection toggle.
* **Works Section**: macOS-inspired folder tab styling with floating pill tags and dynamic GSAP counter triggers (`stat-num`).

### C. Studio CMS & Content Engine
* **Authentication**: Lightweight session-based authentication guarded by `AdminAuthMiddleware` (configured via `ADMIN_USERNAME` and `ADMIN_PASSWORD` in `.env`).
* **Media Upload**: Auto-detects Cloudinary (`CLOUDINARY_URL`); falls back seamlessly to `storage/app/public/odds/` served via local storage symlink.
* **Notion-Style Block Builder**: Interactive drag/drop and rich media JSON storage for About and Works content.

### D. AI Chatbot Widget Subsystem
* **Service**: `app/Services/GroqService.php`
* **Frontend**: `resources/views/components/odds-chat-widget.blade.php`
* **Endpoint**: `POST /api/chat` (LLaMA 3.3 70B Versatile via Groq API).

---

## 5. Routes & Endpoints Reference

### Public Frontend
| Route | Method | Name | Description |
| :--- | :--- | :--- | :--- |
| `/` | `GET` | `portfolio.index` | Primary Landing Page |
| `/about` | `GET` | `portfolio.about` | Public About Us Page |
| `/contact` | `POST` | `portfolio.contact` | Lead Form submission |
| `/media/{path}` | `GET` | `media.serve` | Storage file server helper |

### Admin Studio CMS
| Route | Method | Guard | Description |
| :--- | :--- | :--- | :--- |
| `/admin/login` | `GET/POST` | Public | CMS authentication gate |
| `/admin/logout` | `POST` | Auth | Invalidate session |
| `/admin` | `GET` | `AdminAuthMiddleware` | Overview KPIs & recent inquiries |
| `/admin/settings` | `GET/POST` | `AdminAuthMiddleware` | General & Hero CMS settings |
| `/admin/works` | `GET/POST` | `AdminAuthMiddleware` | Works CRUD & project reordering |
| `/admin/services` | `GET/POST` | `AdminAuthMiddleware` | Services CRUD & marquee ordering |
| `/admin/testimonials` | `GET/POST` | `AdminAuthMiddleware` | Testimonial moderation & ratings |
| `/admin/about` | `GET/POST` | `AdminAuthMiddleware` | About section builder & rich media |
| `/admin/why` | `GET/POST` | `AdminAuthMiddleware` | Value propositions editor |
| `/admin/inquiries` | `GET/POST` | `AdminAuthMiddleware` | Client lead inbox & review |

---

## 6. Environment Configuration (`.env`)

```env
# Database Configuration (SQLite by default, or MySQL)
DB_CONNECTION=sqlite

# ODDS Studio CMS Credentials
ADMIN_USERNAME=admin
ADMIN_PASSWORD=adminpassword

# AI Chat Widget (Optional)
GROQ_API_KEY=your_groq_api_key_here

# Cloudinary CDN Storage (Optional - falls back to local disk)
CLOUDINARY_URL=
```

---

## 7. Development & Deployment Commands

```bash
# 1. Run all services concurrently (Laravel + Queue + Vite)
npm run dev:all

# 2. Compile assets for production
npm run build

# 3. Database migrations & seeders
php artisan migrate --force
php artisan db:seed --class=OddsContentSeeder
php artisan db:seed --class=AboutSectionSeeder

# 4. Clear cache
php artisan optimize:clear
```
