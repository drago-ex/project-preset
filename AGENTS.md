# Agent Guide

`drago-ex/project-preset` (type drago-tools-resource, PHP >=8.3 <9): a set of `project-*` packages for the
complete website with administration, used by netis `create-netis`. The workspace rules are in `../AGENTS.md`.

## What it contains
- `composer.json` requires the included packages; that list is the content of the preset.
- `resources/assets/admin.js` and `admin.scss` register the Naja extensions and import the styles of all
  included packages. They are installed by `replace` with `replace-once` and `replace-priority` 300, so they
  replace the `admin.*` of backend-ui once when the project is composed.
- Nothing else: no PHP code, no `package.json` (npm dependencies come with the packages through `npm-loader.js`
  of drago-ex/project), no menu neons (every package ships its own `Backend/<X>/N.menu.neon`), no front design
  (that is drago-ex/project-front-ui).

## Rules
- When a package is added to or removed from the preset, update `composer.json`, `admin.js`/`admin.scss` (by the
  `## Assets` section of that package's README) and the "Included Packages" list of the README.
- Permissions are always part of the preset (project-permission); there is no preset without them.

## Commands
No tests or PHPStan; CI runs only the Nette Code Checker.
