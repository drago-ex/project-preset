# Agent Guide

Use this file as package-specific guidance when working in this repository. Keep changes aligned with the existing public API, project conventions, and supported PHP range.

## Package Overview
- **Package**: `drago-ex/project-preset`
- **Type**: drago-tools-resource
- **Purpose**: Overlay preset that turns an installed Drago Project into a backend-ready stack.
- **PHP**: >=8.3 <9
- **Runtime dependencies**: drago-ex/translator (^4.0), drago-ex/project-docker (^1.0), drago-ex/project-docker-db (^1.0), drago-ex/project-front (^1.0), drago-ex/project-backend (^1.0), drago-ex/project-backend-ui (^1.0), drago-ex/project-settings (^1.0), drago-ex/project-blog (^1.0), drago-ex/project-static-page (^1.0)
- **License**: MIT

## Repository Layout
- `resources/`: application resources contributed to the consuming Drago project.
- `.github/`: CI workflows; keep their PHP versions and commands consistent with Composer and the package scripts.
- `composer.json`: package metadata, dependency constraints, autoloading, and available Composer scripts.

## Key Parts
- No permissions here (user, 2026-10-27): the preset composes the project without drago-ex/permission. Everything about permissions is the overlay drago-ex/project-preset-permission (replace-priority 310), which `create-netis` installs too. Never add a permission check, `allowAny`/`allow`, `Authorization` or `WriteAccess` here.
- Menu: `Backend/Blog/6.menu.neon` (incl. the `CommentBadge` service tagged `sidebar.badge`), `Backend/Page/5.menu.neon`, `Backend/Settings/2.menu.neon` add the items of the included packages, which ship no menu file (their READMEs list their links). Items have keys (`blog`, `page`, `settings`; project-backend-ui has `dashboard`), so project-preset-permission adds `allowAny` to them in one `Admin/99.menu.neon` instead of copying these files. A new administration page of an included package needs its item here.
- Front (2026-10-24): `Front/@layout.latte` (Bootstrap navbar in a `sticky-top` header, `bg-body-tertiary` like the footer (the user: Bootstrap light, theme-aware), without borders; the brand links home, then the blog, static pages of `PageMenu`, user dropdown (no language dropdown for now, the user removed it 2026-10-24; `/en/` routes still work) written by hand because `@dropdown.latte` translates its name and the user name is data; `$user` is `CurrentUser`, the administration item uses `isPermitted('Backend:Admin', 'default-read')`), `Front/Home` (the latest seven articles of project-blog: `ArticleListFactory::create(limit: 7)` rendered by `Front/Blog/@article-list.latte`, the same list as the blog; no hero block). The front is on the body background without borders (the user likes blog.getbootstrap.com): article cards side by side with a soft background (`.blog-card`); `.blog-content` makes the article text larger, `BasePresenter` (translator, `SettingsRequire`; `beforeRender()` sets `$menuPages` only for `Front:*` presenters (`#[Nette\DI\Attributes\Inject] PageMenu`); project-preset-permission replaces it with a copy plus `Authorization` and `isReadOnlySignal()`), footer like getbootstrap.com (brand, "Built on Nette with Drago Extension.", copyright; columns Links (home, blog, menu pages), Projects (Netis, Drago Extension, Compostrap, Packagist), Built with (Nette, Latte, Dibi, Bootstrap, Texy, Naja, Vite); `.front-footer-link`), `assets/front.js` + `front.scss` (the "Reply" link of blog comments inserts `#N Name` into `#comment-form textarea`, `.comment:target` highlight and scroll-margin under the sticky header; `import 'bootstrap'` for the navbar collapse: drago-application and drago-component import the full Bootstrap, so a `bootstrap/js/dist/collapse` import registered the click handler twice and the mobile menu did not open, dropdowns, theme switcher, toasts, TexyToolbar for comments, copy button), own texts in `Front/Translate/cs.neon` (`extra.drago-translator`). project-blog and project-static-page are required, so the preset is released after them.
- `resources/package.json` replaces the project's one: keep the shared dependencies (vite, @nette/vite-plugin, `allowScripts`) in step with drago-ex/project, otherwise new projects get older tools.
- `resources/app` and `resources/assets` are installed by `replace` (`replace-once`, `replace-priority` 300), so they override the other packages once when the project is composed. `assets/admin.js`/`admin.scss` and `BasePresenter.php` are copied by project-preset-permission with its additions: change them there too.

## Dependencies

Composer constraints describe the package contract. Before changing integration behavior, inspect the source and the actual call sites in this package; do not infer runtime usage solely from dependency declarations.
Development dependencies include phpstan/phpstan-nette (^2.0).

## Essential Commands

```bash
composer phpstan                # phpstan analyse
```

## Tests

This repository does not currently define a test script in `composer.json` or contain a `tests/` directory.
Do not claim behavior is covered by tests unless you find and run a relevant suite. When adding a test suite, follow the package’s existing Nette Tester setup if one is present and add an explicit Composer script.

## Conventions & Rules

- Preserve backward compatibility unless the task explicitly permits a breaking change. Check callers and public signatures before changing behavior.
- Follow the existing PHP style: strict types, explicit parameter and return types, tabs for indentation, and single-quoted strings where practical. Match nearby code when a convention is unclear.
- Keep package-specific configuration, resources, and migrations in their established directories. Do not edit generated or consuming-project files without confirming they are part of this repository’s intended output.
- Add or update focused tests for behavioral changes when this package has a runnable test setup. Do not invent test commands; use only the scripts and configuration present here.
- Update README examples and Composer metadata when a public API or supported requirement changes.
