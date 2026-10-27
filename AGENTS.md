# Agent Guide

Use this file as package-specific guidance when working in this repository. Keep changes aligned with the existing public API, project conventions, and supported PHP range.

## Package Overview
- **Package**: `drago-ex/project-preset`
- **Type**: drago-tools-resource
- **Purpose**: Overlay preset that turns an installed Drago Project into a backend-ready stack.
- **PHP**: >=8.3 <9
- **Runtime dependencies**: drago-ex/translator (^4.0), drago-ex/project-docker (^1.0), drago-ex/project-docker-db (^1.0), drago-ex/project-front (^1.0), drago-ex/project-backend (^1.0), drago-ex/project-backend-ui (^1.0), drago-ex/permission (^1.0), drago-ex/datagrid (^1.0), drago-ex/project-permission (^1.0), drago-ex/project-settings (^1.0), drago-ex/project-blog (^1.0), drago-ex/project-static-page (^1.0)
- **License**: MIT

## Repository Layout
- `resources/`: application resources contributed to the consuming Drago project.
- `.github/`: CI workflows; keep their PHP versions and commands consistent with Composer and the package scripts.
- `composer.json`: package metadata, dependency constraints, autoloading, and available Composer scripts.

## Key Parts
- Permission overrides of files from packages that work without permissions: `Model/User/UserRepository.php` (`getRolesByUser()` from the tables of project-permission instead of project-auth's `[]`), `Presentation/BasePresenter.php` (`Authorization` trait), and the README "Permissions" steps of project-blog and project-static-page done (2026-10-24): `Backend/Blog/Component` and `Backend/Page/Component` hold copies of `BaseControl.php` (`use WriteAccess`, `$template->writeAllowed`), `BaseTemplate.php` (`$writeAllowed`), the controls (grid actions `->setVisible($this->isWriteAllowed())`, the comment buttons of the article tab `n:if="$writeAllowed"`, the clickable comments state only with the write privilege) and the templates (`addButton: $writeAllowed`). These copies are the package files plus only those steps, made by `php netis/tools/preset-permission.php` (netis repository): run it when such a file changes in its package, otherwise the preset ships a stale fork (as its old `Backend/@layout.latte` was).
- Front (2026-10-24): `Front/@layout.latte` (Bootstrap navbar in a `sticky-top` header, `bg-body-tertiary` like the footer (the user: Bootstrap light, theme-aware), without borders; the brand links home, then the blog, static pages of `PageMenu`, user dropdown (no language dropdown for now, the user removed it 2026-10-24; `/en/` routes still work) written by hand because `@dropdown.latte` translates its name and the user name is data; `$user` is `CurrentUser`, the administration item uses `isPermitted('Backend:Admin', 'default-read')`), `Front/Home` (the latest seven articles of project-blog: `ArticleListFactory::create(limit: 7)` rendered by `Front/Blog/@article-list.latte`, the same list as the blog; no hero block). The front is on the body background without borders (the user likes blog.getbootstrap.com): article cards side by side with a soft background (`.blog-card`); `.blog-content` makes the article text larger, `BasePresenter::beforeRender()` sets `$menuPages` only for `Front:*` presenters (`#[Nette\DI\Attributes\Inject] PageMenu`), footer like getbootstrap.com (brand, "Built on Nette with Drago Extension.", copyright; columns Links (home, blog, menu pages), Projects (Netis, Drago Extension, Compostrap, Packagist), Built with (Nette, Latte, Dibi, Bootstrap, Texy, Naja, Vite); `.front-footer-link`), `assets/front.js` + `front.scss` (the "Reply" link of blog comments inserts `#N Name` into `#comment-form textarea`, `.comment:target` highlight and scroll-margin under the sticky header; `import 'bootstrap'` for the navbar collapse: drago-application and drago-component import the full Bootstrap, so a `bootstrap/js/dist/collapse` import registered the click handler twice and the mobile menu did not open, dropdowns, theme switcher, toasts, TexyToolbar for comments, copy button), own texts in `Front/Translate/cs.neon` (`extra.drago-translator`). project-blog and project-static-page are required, so the preset is released after them.
- Menu permissions (user, 2026-10-27): project-backend-ui and the packages have no permission code in the menu, so the preset overrides them with the checking versions: `Backend/Accessory/Menu/` (`SidebarMenu::build($currentUser)` with `filter()`, `SidebarBuilder::setAllowAny()`, `allowAny`/`allow` in `SidebarItem`/`SidebarSubItem`, through `CurrentUser::isPermitted()`; without an authorizator all items are shown, an unknown resource is denied, an item whose sub-items are all hidden is hidden), `Backend/BackendPresenter.php` (passes `$currentUser`), `Backend/@layout.latte` (dashboard brand and breadcrumb only with `Backend:Admin` `default-read`) and `Admin/1.menu.neon` with `allowAny`. They are copies of the backend-ui files plus only those changes. The menu neons of the other packages (`Blog/6.menu.neon` incl. the `CommentBadge` service, `Page/5.menu.neon`, `Permission/3.menu.neon`, `Settings/2.menu.neon`, with `allowAny`/`allow`) exist only here — the packages ship no menu file, their READMEs list their links (user, 2026-10-27); a new administration page of an included package needs its item added here. For the copies: when such a file changes in its package, copy it again and redo the changes (the layout especially — an older stale copy without the `noindex` robots meta had to be removed on 2026-10-22). Override other files here only when the preset really needs them different.
- `resources/package.json` replaces the project's one: keep the shared dependencies (vite, @nette/vite-plugin, `allowScripts`) in step with drago-ex/project, otherwise new projects get older tools.
- `resources/app` and `resources/assets` are installed by `replace` (`replace-once`, `replace-priority` 300), so they override the other packages once when the project is composed.
- The copied `BasePresenter` uses `Drago\Permission\Authorization` and `UserRepository` uses `drago-ex/project-permission` entities, hence both permission dependencies.
- The preset ships no `PermissionProvider` classes: they are generated by the packages' `bin/create-*-permission` scripts, run by `drago-commands` (project-tools), which `create-netis` (netis-cms/netis) runs and adds to the project's Composer scripts.

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
