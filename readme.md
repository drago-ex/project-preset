# Drago Project Preset

English | [Čeština](readme.cs.md)

Overlay preset that turns an installed Drago Project into a complete backend-ready stack.

[![PHP version](https://badge.fury.io/ph/drago-ex%2Fproject-preset.svg)](https://badge.fury.io/ph/drago-ex%2Fproject-preset)
[![Coding Style](https://github.com/drago-ex/project-preset/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/project-preset/actions/workflows/coding-style.yml)

## Requirements

- PHP >= 8.3, < 9
- Nette Framework
- Composer
- Docker
- Node.js
- Bootstrap
- Naja

## Installation

```bash
composer require drago-ex/project-preset
```

## Included packages

- [Docker Setup](https://github.com/drago-ex/project-docker)
- [Database Layer](https://github.com/drago-ex/project-docker-db)
- [Authentication](https://github.com/drago-ex/project-auth)
- [Permissions (ACL)](https://github.com/drago-ex/project-permission)
- [Backend Admin](https://github.com/drago-ex/project-backend)
- [Backend UI](https://github.com/drago-ex/project-backend-ui)
- [Application Settings](https://github.com/drago-ex/project-settings)
- [Blog](https://github.com/drago-ex/project-blog)
- [Static Pages](https://github.com/drago-ex/project-static-page)

## Front

The preset replaces the plain front layout of project-front with a Bootstrap one: a navbar with the home page,
the blog and the static pages marked "Show in the menu", a language switch, and the signed-in user's menu
(account, administration when the user may open it, theme, sign out) or a sign-in button. The home page shows
the latest articles of the blog.

## Permission providers

The access rules of the included packages are generated into the project by:

```bash
php vendor/bin/create-permission --packages
```
