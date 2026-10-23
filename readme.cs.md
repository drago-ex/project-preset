# Drago Project Preset

[English](readme.md) | Čeština

Preset, který z nainstalovaného Drago Project udělá kompletní sestavu s administrací.

[![PHP version](https://badge.fury.io/ph/drago-ex%2Fproject-preset.svg)](https://badge.fury.io/ph/drago-ex%2Fproject-preset)
[![Coding Style](https://github.com/drago-ex/project-preset/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/project-preset/actions/workflows/coding-style.yml)

## Požadavky

- PHP >= 8.3, < 9
- Nette Framework
- Composer
- Docker
- Node.js
- Bootstrap
- Naja

## Instalace

```bash
composer require drago-ex/project-preset
```

## Obsažené balíčky

- [Docker](https://github.com/drago-ex/project-docker)
- [Databáze](https://github.com/drago-ex/project-docker-db)
- [Přihlašování](https://github.com/drago-ex/project-auth)
- [Oprávnění (ACL)](https://github.com/drago-ex/project-permission)
- [Administrace](https://github.com/drago-ex/project-backend)
- [Rozhraní administrace](https://github.com/drago-ex/project-backend-ui)
- [Nastavení aplikace](https://github.com/drago-ex/project-settings)

## Providery oprávnění

Pravidla přístupu obsažených balíčků se vygenerují do projektu příkazem:

```bash
php vendor/bin/create-permission --packages
```
