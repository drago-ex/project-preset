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
- [Application Settings](https://github.com/drago-ex/project-settings)
- [Blog](https://github.com/drago-ex/project-blog)
- [Static Pages](https://github.com/drago-ex/project-static-page)
- [Gallery](https://github.com/drago-ex/project-gallery)

## Front

The preset replaces the plain front layout of project-front with a Bootstrap one: a navbar with the blog and the
static pages marked "Show in the menu" (the logo leads to the home page), and the signed-in user's menu
(account, administration, theme, sign out) or a sign-in button. The home page shows
the latest articles of the blog.

---

## Optional add-ons

The package works without them. Set them up by hand as described below when the project needs them.

### Permissions

The preset contains no permissions. [drago-ex/project-preset-permission](https://github.com/drago-ex/project-preset-permission)
adds them: the administration menu by privileges, write buttons and roles from the database.

```bash
composer require drago-ex/project-preset-permission
```
