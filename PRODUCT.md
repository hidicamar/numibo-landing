# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

Primary: a parent helping their own primary-school child (grades 1 to 5) practise arithmetic, usually arriving on a phone. Secondary: teachers preparing practice for a class, and the children who solve the worksheets.

## Product Purpose

Numibo generates maths worksheets in a few taps. The adult picks the operation and settings, then either downloads a printable PDF (with an answer key if they ask for one) or lets the child solve the worksheet in the browser, where answers are checked and a result is shown. This repository is the marketing site; the product itself lives in the separate `numibo-app` project and is linked from the site's calls to action.

## Operating Context

- The landing page is expected to be opened mostly on phones; desktop is secondary.
- A worksheet can be created on one device and solved on another; nothing is installed.
- Printing at home or at school is a real part of use, alongside solving on screen.

## Capabilities and Constraints

- Worksheet types in the app: addition and subtraction, times table (base multiplication and division), and custom multiplication and division.
- Solving online gives per-row correct/incorrect feedback, a score, and a celebration when everything is correct.
- Every worksheet has a PDF download. The answer-key page is optional: it is added only when the "solutions" toggle is switched on in the generator, and the toggle is off by default.
- Exercise history exists in the app ("My exercises").
- Four locales: Slovene (main), English, German, Croatian. Any app screenshot has to exist per locale.
- Early access: while `plans.early_access` is on, the site presents Numibo as free with everything included and hides plans and prices. Paid plans are planned for later.

## Brand Commitments

- Name: Numibo. Mascot: the blue cloud with a leaf.
- Slovene copy uses the informal "ti" register and reads like everyday speech; the hero phrase is "brez muke".
- Copy should not repeat the same promise across sections.

## Evidence on Hand

- App screenshots: `public/img/usage/<locale>/` (in use) and the wider set in `../numibo-screenshots/` (8 screens, mobile and desktop, 4 locales).
- The running app in `../numibo-app` for new captures, including its real PDF output.
- No testimonials, customer counts, press, or usage statistics exist. Do not invent them.

## Product Principles

- Show the real product; never illustrate a capability the app does not have.
- What the site promises must match what the screenshots and the app show (for example free early access versus trial counters).
- Phone first: a claim has to land at about 390px wide before it is tuned for desktop.
- Every locale gets the same quality of proof as Slovene.
