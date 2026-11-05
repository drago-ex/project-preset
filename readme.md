# Drago Project Preset

Installs the complete website with administration into a Drago Project at once and brings the administration
assets composed for all its packages.

[![PHP version](https://badge.fury.io/ph/drago-ex%2Fproject-preset.svg)](https://badge.fury.io/ph/drago-ex%2Fproject-preset)
[![Coding Style](https://github.com/drago-ex/project-preset/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/project-preset/actions/workflows/coding-style.yml)

## Requirements

- PHP >= 8.3, < 9
- [Drago Project](https://github.com/drago-ex/project)

## Installation

```bash
composer require drago-ex/project-preset
```

## Included Packages

- [Docker Database](https://github.com/drago-ex/project-docker-db)
- [Front UI](https://github.com/drago-ex/project-front-ui)
- [Backend](https://github.com/drago-ex/project-backend)
- [Backend UI](https://github.com/drago-ex/project-backend-ui)
- [Settings](https://github.com/drago-ex/project-settings)
- [Permissions](https://github.com/drago-ex/project-permission)
- [Blog](https://github.com/drago-ex/project-blog)
- [Static Pages](https://github.com/drago-ex/project-static-page)
- [Gallery](https://github.com/drago-ex/project-gallery)

They bring their own dependencies, such as authentication and user accounts.

## Assets

The preset copies `assets/admin.js` and `assets/admin.scss` into the project, replacing the ones of the other
packages once. They already register the scripts and import the styles of all included packages, so the
administration works after `npm install` and `npm run vite:build` without further changes.
