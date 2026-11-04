# Drago Project Preset

Overlay preset that turns an installed Drago Project into a complete backend-ready stack.

[![PHP version](https://badge.fury.io/ph/drago-ex%2Fproject-preset.svg)](https://badge.fury.io/ph/drago-ex%2Fproject-preset)
[![Coding Style](https://github.com/drago-ex/project-preset/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/project-preset/actions/workflows/coding-style.yml)

## Requirements

- PHP >= 8.3, < 9
- [Drago Project](https://github.com/drago-ex/project)
- Docker

## Installation

```bash
composer require drago-ex/project-preset
```

## Files copied into the project

The files are copied into the project by [drago-ex/project-tools](https://github.com/drago-ex/project-tools),
as set in `extra.drago-tools` of this package's `composer.json`.

## Included packages

- [Docker Setup](https://github.com/drago-ex/project-docker)
- [Database Layer](https://github.com/drago-ex/project-docker-db)
- [Authentication](https://github.com/drago-ex/project-auth)
- [Backend Admin](https://github.com/drago-ex/project-backend)
- [Backend UI](https://github.com/drago-ex/project-backend-ui)
- [Front UI](https://github.com/drago-ex/project-front-ui)
- [Application Settings](https://github.com/drago-ex/project-settings)
- [Blog](https://github.com/drago-ex/project-blog)
- [Static Pages](https://github.com/drago-ex/project-static-page)
- [Gallery](https://github.com/drago-ex/project-gallery)

## Permissions

The preset contains the permissions: every presenter is checked by its `acl.neon` (drago-ex/permission), the
buttons and the administration menu follow the privileges of the user, and
[drago-ex/project-permission](https://github.com/drago-ex/project-permission) adds the administration of roles and
privileges (menu item "Permissions").
