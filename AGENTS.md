# Agent Guide

Use this file as package-specific guidance when working in this repository. Keep changes aligned with the existing public API, project conventions, and supported PHP range.

## Package Overview
- **Package**: `drago-ex/project-preset`
- **Type**: drago-tools-resource
- **Purpose**: Overlay preset that turns an installed Drago Project into a backend-ready stack.
- **PHP**: >=8.3 <9
- **Runtime dependencies**: drago-ex/project-docker (^1.0), drago-ex/project-docker-db (^1.1), drago-ex/project-front (^3.0), drago-ex/project-backend (^1.0), drago-ex/project-backend-ui (^1.0), drago-ex/project-front-ui (^1.0), drago-ex/project-settings (^2.0), drago-ex/project-blog (^2.0), drago-ex/project-static-page (^2.0), drago-ex/project-gallery (^1.0), drago-ex/project-permission (^3.0)
- **License**: MIT

## Repository Layout
- `resources/`: application resources contributed to the consuming Drago project.
- `.github/`: CI workflows; keep their PHP versions and commands consistent with Composer and the package scripts.
- `composer.json`: package metadata, dependency constraints, autoloading, and available Composer scripts.

## Key Parts
- Permissions are the base (user, 2026-11-03, replaces the 2026-10-27 rule "no permissions here"): `BasePresenter` (now of project-front-ui) uses the `Authorization` trait of drago-ex/permission, like the one of project-front; every presenter needs its resource in an `acl.neon`. It requires drago-ex/project-permission (^3.0) and adds its `naja/permission-toggle` in `assets/admin.js`/`admin.scss`; project-preset-permission and `create-netis --permission` were removed.
- Menu: no menu neons here (user, 2026-11-04): every included project-* package ships its own `Backend/<X>/N.menu.neon` (settings 2, permission 3, page 5, blog 6 with `CommentBadge`, gallery 7) and backend-ui shows an item only when the user may open its link.
- Front (user, 2026-11-04): the website design (`BasePresenter`, `BaseTemplate`, `Front/@layout.latte`, `Front/Home`, `Front/Translate`, `assets/front.js`, `front.scss`) moved to drago-ex/project-front-ui, the front counterpart of backend-ui; the preset requires it and keeps only `assets/admin.js` and `admin.scss`.
- No `package.json` any more (user, 2026-11-04): the npm dependencies come with the packages (`package.json` with `name` in backend-ui, front-ui, auth, account), installed by npm-loader of drago-ex/project.
- `resources/assets` (`admin.js`, `admin.scss` with the extensions of all included packages) is installed by `replace` (`replace-once`, `replace-priority` 300), so they override the other packages once when the project is composed.

## Dependencies

Composer constraints describe the package contract. Before changing integration behavior, inspect the source and the actual call sites in this package; do not infer runtime usage solely from dependency declarations.
There are no development dependencies: the preset has no PHP code any more (2026-11-04), so CI runs only the Nette Code Checker.

## Tests

This repository does not currently define a test script in `composer.json` or contain a `tests/` directory.
Do not claim behavior is covered by tests unless you find and run a relevant suite. When adding a test suite, follow the package’s existing Nette Tester setup if one is present and add an explicit Composer script.

## Conventions & Rules

- Preserve backward compatibility unless the task explicitly permits a breaking change. Check callers and public signatures before changing behavior.
- Follow the existing PHP style: strict types, explicit parameter and return types, tabs for indentation, and single-quoted strings where practical. Match nearby code when a convention is unclear.
- Keep package-specific configuration, resources, and migrations in their established directories. Do not edit generated or consuming-project files without confirming they are part of this repository’s intended output.
- Add or update focused tests for behavioral changes when this package has a runnable test setup. Do not invent test commands; use only the scripts and configuration present here.
- Update README examples and Composer metadata when a public API or supported requirement changes.
