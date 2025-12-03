# Disotech - Newsroom (Blocksy Child Theme)

This repository contains the custom code for the **Newsroom** page and related components
for the Disotech training project.  
It is a Blocksy child theme, not a full WordPress installation.

## Structure

- `functions.php`  
  - Registers **Articles** (`post_type=article`) and **Case Studies** (`post_type=case_study`)
  - Enqueues newsroom assets:
    - `assets/css/newsroom.css`
    - `assets/js/newsroom-carousel.js`
    - `assets/js/newsroom-carousel.js` uses **Embla Carousel** for the Case Studies slider
  - Limits loading of Embla to the `page-newsroom.php` template only.

- `page-newsroom.php`
  - Custom template: **Template Name: Newsroom**
  - Sections:
    - Hero with background image
    - Featured Case Study (hero_featured meta)
    - Popular Articles (3 articles with `is_popular` meta)
    - Recent Articles (latest 3 articles)
    - Case Studies slider (Embla; excludes hero featured case)
    - All Articles (2 + 3 layout, “More articles” button)

- `assets/css/newsroom.css`
  - All custom styling for the Newsroom layout:
    - Hero section
    - Featured case study hero card
    - Popular / Recent / All articles grids
    - Case Studies slider card
    - "View all" and "More articles" buttons
    - Responsive rules for desktop / tablet / mobile

- `assets/js/newsroom-carousel.js`
  - Initializes **EmblaCarousel** on `.newsroom-case-embla`
  - Config:
    - `loop: false`
    - `align: 'start'`
    - `slidesToScroll: 1`
  - Handles enabling/disabling previous/next arrows.

## Installation

1. Copy the `blocksy-child` folder into:
   `wp-content/themes/blocksy-child` in a WordPress installation using Blocksy.
2. Activate **Blocksy Child** theme in **Appearance → Themes**.
3. Create a page and assign the **“Newsroom”** template (`page-newsroom.php`).
4. Ensure ACF fields and post meta used:
   - Case Studies:
     - `hero_featured` (boolean or 1/0)
     - `short_intro`
   - Articles:
     - `is_popular`
     - `short_intro`

## Notes

- The Git repository intentionally contains **only the child theme code**,  
  not the entire WordPress installation, database or uploads.
