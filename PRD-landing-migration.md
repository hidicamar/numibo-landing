# PRD — Numiboo landing site: migrate the marketing site out of mathexercises

Status: **implemented** (all phases, 2026-07-19) — pending Amar's review and the §13 open items (company identity, CookieYes ID, GA4 ID, Brevo list ID, yearly-price confirmation).

Source repo: `mathexercises` (public marketing surface, `Marketing` tier). Target repo: **this one** (`numiboo-landing`). The app itself stays in mathexercises and will live at **https://app.numiboo.com**; this project serves only the public site at the apex domain.

---

## 1. Scope & decisions (locked)

- Transfer **Home, Pricing, Blog (index + article), Legal pages (privacy / terms / cookies), newsletter signup** with all their components, styles, and 4-locale content (sl/en/de/bs).
- **Drop the `Marketing` prefix** — this whole project is the marketing site, so artifacts use plain names (§2). *(Decision 1)*
- **No auth system, no `auth()` checks anywhere.** Every login/register/app CTA becomes an external link to the app domain (§7). *(Decision 2)*
- **Products are hardcoded** — no `Product`/`ProductPrice` models, no Stripe references. Plan copy lives in `lang/*/billing.php`, prices/periods in `config/plans.php`; the half-built Filament `Products` resource (no backing model — currently crashes if opened) is **deleted**. *(Decision 3)*
- **Legal rewrite + cookie banner are in scope** — marqetir-style privacy/terms/cookies rewritten for Numiboo in all 4 locales, plus a working consent banner (§9, §10). *(Decision 4)*
- Reuse everything numiboo-landing already has: `Page/Post/PostCategory/Faq/Seo` models + migrations + Filament admin, the `components/head/*` kit, mcamara/laravel-localization + Brevo SDK + Flux Pro (all installed).

**Out of scope:** removing the marketing tier from mathexercises (separate cleanup task, after the landing site is live), the app-side `numiboo.com → app.` auth/checkout work, DNS/deploy.

---

## 2. Naming — the prefix drop

| mathexercises (source) | numiboo-landing (target) |
|---|---|
| `App\Http\Controllers\Marketing\{Home,Pricing,Post,LegalPage}Controller` | `App\Http\Controllers\{Home,Pricing,Post,LegalPage}Controller` |
| `App\Livewire\Marketing\SubscribeToNewsletter`, `…\Posts\ListPosts` | `App\Livewire\SubscribeToNewsletter`, `App\Livewire\Posts\ListPosts` |
| `resources/views/pages/marketing/{home,pricing/index,posts/*,legal/show}` | `resources/views/pages/{home,pricing/index,posts/*,legal/show}` |
| `resources/views/components/marketing/{header,footer,back-to-top}` | `resources/views/components/{header,footer,back-to-top}` |
| `resources/views/components/layouts/marketing.blade.php` | `resources/views/components/layouts/app.blade.php` → `<x-layouts.app>` |
| `resources/views/livewire/marketing/**` | `resources/views/livewire/**` |
| `App\Actions\Newsletter\SubscribeToNewsletter` | same path (kept — Actions convention) |

Copied unchanged (path-wise): `components/pricing/{plan-card,toggle}`, `components/cards/{post,feature}`, `components/partials/locale-switcher`, `partials/head`, all needed `resources/views/flux/*` overrides + custom icons.

---

## 3. Routes & localization wiring

numiboo-landing has mcamara installed + config published but **nothing wired**. Do:

1. `bootstrap/app.php`: register the three middleware aliases (`localize`, `localizationRedirect`, `localeViewPath`) exactly as in mathexercises.
2. `config/laravellocalization.php`: mirror mathexercises — `supportedLocales` sl/en/de/bs, `localesOrder = ['sl','en','de','bs']`, `hideDefaultLocaleInURL = true`, `useAcceptLanguageHeader = true`. (Verify `sl` is uncommented — current file state is unclear.)
3. `routes/web.php`: one `LaravelLocalization::setLocale()` group with `home`, `pricing`, `posts.index`, `posts.show`, `legal.privacy-policy`, `legal.terms-and-conditions`, `legal.cookies` via `transRoute('routes.…')`. Delete the stock `welcome` route + view.
4. `lang/{sl,en,de,bs}/routes.php`: copy from mathexercises, **pruned to marketing keys only** (no exercises/subscription/settings/profile slugs).

No `ManifestController` / PWA manifest — the landing site isn't the app. `partials/head.blade.php` loses the manifest link.

---

## 4. Data layer (mostly already here)

- Models/migrations/Filament for `Page`, `Post`, `PostCategory`, `Faq`, `Seo` are already built in this repo — reuse as-is. Note: this repo's `Faq` has **no `FaqCategory`** (mathexercises has one); the pricing page's optional category filter is dropped — both FAQ sections render `Faq::visible()->get()`.
- `PageSeeder`: prune to landing page types only — `home`, `posts.index`, `pricing`, `privacy-policy`, `terms-and-conditions`, `cookies` (× 4 locales). The app-page SEO types (`exercises.*`, `login`, `register`, `addition-*`, `multiplication-*`) are removed — those pages don't exist here.
- `UserSeeder` fix: it upserts `first_name`/`last_name` columns the users migration doesn't have — align with the actual schema (single `name`).
- `DatabaseSeeder`: `UserSeeder`, `PageSeeder`, `FaqSeeder`, `PostCategorySeeder` (drop the factory-user stub).

---

## 5. Foundation — layout, head, theme, assets

1. **Layout** `<x-layouts.app>`: port `marketing.blade.php` (head partial, header, footer, back-to-top, flux toast/scripts). Keep the SEO slot + title threading that already works in the source.
2. **Head**: port `partials/head.blade.php`; wire it to this repo's existing `components/head/*` kit (`favicons`, `touch-icons`, `meta/default`, `meta/dynamic`, `google-fonts`). `gtag` + `cookieyes` get wired in §10; `hotjar`/`fb`/`adstxt` stay unreferenced until wanted.
3. **CSS** (`resources/css/app.css`): port the `@theme` block (custom blue/green/zinc palettes, `--color-light/dark`, `--shadow-custom`, `--font-sans: 'Rubik'`) and utilities: `.bg-radial-picton`, `.bg-radial-picton-2`, `.nav-link`, `.nav-swap-link`, `.rich-text-editor-content`, `.blurred-footer`, the h1–h6/p type scale. Ensure Rubik is actually loaded (google-fonts head component).
4. **Vite**: single `app.css` + `app.js` input (no `pdf.css`, no `passkeys.js`).
5. **Assets**: copy `public/img/logo/**`, `img/banners/seo.png`, favicon/touch-icon sets.

---

## 6. Pages

- **Home** — port controller + view: hero, product preview, how-it-works, feature bento (`x-cards.feature`), pricing teaser, FAQ accordion, newsletter, final CTA band. Controller supplies `$page` (type `home` + seo), latest 3 published posts, visible FAQs — and `$plans` from `config('plans')` instead of `Product::with('productPrices')`.
- **Pricing** — port view + partials. `PricingController` supplies `$plans = config('plans')` + FAQs. `plan-card.blade.php` and `toggle.blade.php` are adapted from Eloquent accessors (`localized_name`, `formatted_price`, `isMonthly()`…) to plain array access + `lang/*/billing.php` keys (§8). Micro-comparison table, yearly-default toggle, Premium emphasis — all unchanged visually.
- **Blog** — port `PostController@index/@show`, `Livewire\Posts\ListPosts` (pagination 5/page), `x-cards.post`, article view with read-time + `.rich-text-editor-content` body + native Web Share. `Post` model here already has slug/media/read-time — no changes.
- **Legal** — port `LegalPageController` + `legal/show.blade.php`; content comes from the seeded `Page` rows (rewritten in §9).

---

## 7. External CTAs — the app boundary

- New config: `config/app.php` → `'app_url' => env('NUMIBOO_APP_URL', 'https://app.numiboo.com')` (+ `.env.example`).
- Header: **no auth branching**. Static links: nav (Home/Pricing/Blog), locale switcher, "Log in" → `{app_url}/login`, primary CTA "Start free" → `{app_url}/register`. No logout form, no profile/exercises links.
- Home + pricing final CTA bands: unconditional `{app_url}/register`.
- Plan cards: CTA → `{app_url}/register?plan={slug}&period={monthly|yearly}` — query params are informational for the app's future checkout threading; the app ignoring them is fine for now.
- `wire:navigate` is removed from all external links (cross-origin).

---

## 8. Plans config + lang

- `config/plans.php`: ordered array — per plan: `slug` (`starter`, `premium`), `recommended` flag, per-period `price` (minor units) + `currency` (EUR); amounts copied from the mathexercises `ProductSeeder` (verify yearly amounts there during implementation — monthly are €3.99 / €6.99).
- `lang/{locale}/billing.php`: copy from mathexercises — `billing.plans.{slug}.{name,description,features}`, `billing.pricing.*` labels. Price formatting via a small helper (or `Number::currency()` with locale) replacing the `cknow/laravel-money` + cashier-currency path — `cknow/laravel-money` is already installed here if the formatted output needs to match exactly.
- Other lang files created per locale, key-symmetric: `routes`, `home`, `pricing`, `posts`, `billing`, `titles`, `actions`, `labels`, `app`, `global`, `validation` (newsletter email attribute), `pagination`. This repo currently has **no `lang/` directory at all** — everything is a fresh copy, pruned of app-only keys.

---

## 9. Legal rewrite (privacy / terms / cookies)

- Structural reference: https://marqetir.com/privacy-policy, /terms, /cookies-policy (fetched at implementation time) — adopt their section structure and tone, rewritten for Numiboo.
- Substance must reflect this reality: Numiboo is a math-worksheet/exercise service; the landing site itself processes only **newsletter emails (Brevo)** and **cookies/analytics**; accounts, payments (Stripe), and exercise data live on `app.numiboo.com` — the documents cover the **whole Numiboo service** (they're linked from both sites) and name Brevo, Stripe, Google Analytics as processors.
- Company identity block (legal name, address, contact email) goes in as clearly marked `<!-- TODO: … -->` placeholders — **Amar supplies the real details** (§13).
- Written in **en first**, then translated to sl/de/bs; stored as `database/seeders/content/legal/{type}.{locale}.html` replacing the current copies; `PageSeeder` seeds them only when the page is blank (admin edits win — same rule as mathexercises).

---

## 10. Cookie consent + analytics

- Wire the existing (empty) `components/head/cookieyes.blade.php`: load the CookieYes script from `config('services.cookieyes.id')` (`COOKIEYES_ID` in env), rendered only when the id is set. Amar creates the CookieYes banner + supplies the id (§13).
- `gtag.blade.php`: replace the hardcoded GA4 id with `config('services.google.analytics_id')` (`GOOGLE_ANALYTICS_ID`), rendered only when set, with [Google Consent Mode](https://developers.google.com/tag-platform/security/guides/consent) defaults set to `denied` so CookieYes controls it.
- Both included from `partials/head.blade.php`; with no env values set (local dev), nothing renders.

---

## 11. Newsletter — Brevo

Port as-is: `App\Actions\Newsletter\SubscribeToNewsletter` (Brevo `CreateContactRequest`, `updateEnabled`), `App\Livewire\SubscribeToNewsletter` (email validation, hidden-field honeypot, `subscribed` flag). The SDK (`getbrevo/brevo-php` v5) and `config/services.php` brevo block already exist here — just add `BREVO_API_KEY` / `BREVO_NEWSLETTER_LIST_ID` to `.env.example`.

---

## 12. Tests & quality

- `tests/TestCase.php` gets the sqlite-`:memory:`-or-fail guard (working-agreement hard rule).
- Feature tests: route smoke per locale (home/pricing/blog index/article/3 legal pages render 200), pricing renders both plans × both periods from config, external CTAs point at `app_url`, blog pagination + published-only + 404 on unpublished, newsletter happy path + validation + honeypot no-op, legal pages render seeded content, gtag/cookieyes absent when env unset.
- Sitemap: `spatie/laravel-sitemap` is installed — add a `sitemap:generate` command covering all localized static routes + published posts (small, but it's why the package is here).
- `vendor/bin/pint --dirty --format agent` on touched PHP; `/simplify` pass at the end.

---

## 13. Open items (Amar)

1. **Company identity** for the legal pages: legal name, address, contact email (placeholders until supplied).
2. **CookieYes account**: create the banner for numiboo.com, supply `COOKIEYES_ID`.
3. **GA4 property** for numiboo.com → `GOOGLE_ANALYTICS_ID` (old hardcoded id belongs to the mathexercises domain).
4. **Brevo**: confirm the same list id is reused → `BREVO_NEWSLETTER_LIST_ID`.
5. Confirm yearly prices (monthly locked at €3.99 Starter / €6.99 Premium).

---

## 14. Build order

1. **Foundation** — localization wiring (middleware, config, routes, `lang/*/routes.php`), layout + head + CSS theme + assets, seeder fixes (§3–§5).
2. **Pages** — home, pricing (plans config + adapted partials), blog, legal with existing content (§6, §8).
3. **App boundary** — `app_url` config, header/footer/CTA externalization (§7).
4. **Newsletter** (§11).
5. **Legal rewrite + consent** — marqetir-referenced rewrite × 4 locales, CookieYes + consent-mode gtag (§9, §10).
6. **Tests + sitemap**, then `/simplify` (§12).
7. **Delete dead weight in this repo** — Filament `Products` resource, stock `welcome` view.

mathexercises cleanup (removing the marketing tier there) is a follow-up PRD once this site is live.
