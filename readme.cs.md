# Drago Project Preset

Preset, který z nainstalovaného Drago Project udělá kompletní sestavu s administrací.

[![PHP version](https://badge.fury.io/ph/drago-ex%2Fproject-preset.svg)](https://badge.fury.io/ph/drago-ex%2Fproject-preset)
[![Coding Style](https://github.com/drago-ex/project-preset/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/project-preset/actions/workflows/coding-style.yml)

## Požadavky

- PHP >= 8.3, < 9
- [Drago Project](https://github.com/drago-ex/project)
- Docker

## Instalace

```bash
composer require drago-ex/project-preset
```

## Soubory kopírované do projektu

Soubory do projektu kopíruje [drago-ex/project-tools](https://github.com/drago-ex/project-tools)
podle nastavení v `extra.drago-tools` v `composer.json` tohoto balíčku.

## Obsažené balíčky

- [Docker](https://github.com/drago-ex/project-docker)
- [Databáze](https://github.com/drago-ex/project-docker-db)
- [Přihlašování](https://github.com/drago-ex/project-auth)
- [Administrace](https://github.com/drago-ex/project-backend)
- [Rozhraní administrace](https://github.com/drago-ex/project-backend-ui)
- [Rozhraní webu](https://github.com/drago-ex/project-front-ui)
- [Nastavení aplikace](https://github.com/drago-ex/project-settings)
- [Blog](https://github.com/drago-ex/project-blog)
- [Statické stránky](https://github.com/drago-ex/project-static-page)
- [Galerie](https://github.com/drago-ex/project-gallery)

## Oprávnění

Preset obsahuje oprávnění: každý presenter kontroluje jeho `acl.neon` (drago-ex/permission), tlačítka i menu
administrace se řídí privilegii uživatele a [drago-ex/project-permission](https://github.com/drago-ex/project-permission)
přidává správu rolí a privilegií (položka menu „Oprávnění“).
