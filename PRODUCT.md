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
- Premium plan features (Starter has none of them):
  - Timed exercises: when creating an exercise the parent can switch on a time limit (presets 3, 5, 10 or 15 minutes, or any whole number from 1 to 60). The clock starts on Start; when time runs out the exercise is handed in automatically and unanswered equations count as wrong. The PDF does not print the limit.
  - Child profiles: up to 4, each with a nickname and one of 12 preset animal avatars; no child login, email, birth date or photo. The parent signs in and picks the child under "Who is practising?"; results are recorded per child. Exercises belong to the parent and any child can solve any of them. Deleting a child deletes that child's results and badges.
  - Rewards, per child profile: stars per exercise (1 for handing in, 2 at 75%, 3 at 90%; the best try counts), a weekly streak (3 practice days in a week, Monday to Sunday) and 12 badges.
  - Not in the product: child logins, a lock on the parent areas, a skill map, leaderboards, spending stars, a switch to turn rewards off. Do not imply any of them.
- Five locales: Slovene (main), English, German, Croatian, Bosnian. Any app screenshot has to exist per locale.
- Early access: while `plans.early_access` is on, the site presents Numibo as free with everything included, the Premium features too, and hides plans and prices. Paid plans are planned for later.

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
