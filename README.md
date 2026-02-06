Jamin Leveranciersportaal
<p align="center"> <a href="https://laravel.com" target="_blank"> <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo"> </a> </p> <p align="center"> <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a> </p>

## Over dit project

Dit project is een leveranciers- en allergenenportaal voor Jamin, gebouwd met Laravel 10, Tailwind CSS en Breeze.

- Leveranciers kunnen bekijken, inclusief contactinformatie en adresgegevens.
- Allergenen per product kunnen bekijken met filtering en pagination.
- Snel en overzichtelijk door de data kunnen navigeren via responsive tables en dropdowns.
- Dark mode en een consistente layout ervaren via Breeze.

## Gebouwde functionaliteiten

Leverancierspagina

- Overzicht van alle leveranciers.
- Toon Naam, Contactpersoon, Mobiel, Stad, Straat en Huisnummer.
- Indien adresgegevens ontbreken, wordt dit duidelijk weergegeven in één samengevoegde kolom.
- Responsieve tabel met Tailwind CSS.

## Allergeen Overzicht

Overzicht van producten en hun allergenen.

- Dropdown filter op allergenen.
- Pagination om grote datasets overzichtelijk te tonen.
- Bewerkknop per product om direct naar de leverancier te navigeren.
- Responsive tabel met Tailwind CSS en dark mode support.

## Backend

- Stored procedures gebruikt voor het ophalen van allergenen met pagination.
- Controllers en models georganiseerd volgens Laravel best practices.
- Filters verwerkt via GET parameters.

## Frontend

- Alle pagina’s gebruiken <x-app-layout> van Laravel Breeze
- Tailwind CSS styling, responsive tables en dark mode.
- Dropdowns en pagination in Tailwind-stijl.
- Geen Bootstrap meer nodig, alles consistent.

## Project Structuur (kort overzicht)

app/
├─ Http/
│  ├─ Controllers/
│  │   ├─ LeverancierController.php
│  │   └─ AllergeenController.php
├─ Models/
│   ├─ LeverantieModel.php
│   └─ AllergeenModel.php
resources/
├─ views/
│  ├─ layouts/
│  │   └─ app.blade.php
│  ├─ leverancierOverzicht/
│  │   └─ index.blade.php
│  └─ allergenenOverzicht/
│      └─ index.blade.php
database/
├─ migrations/
├─ seeders/

## Gebruikte technologieën

- Framework: Laravel 10
- Authentication & Layout: Laravel Breeze
- Styling: Tailwind CSS (responsive tables, dropdowns, dark mode)
- Database: MySQL (met stored procedures voor pagination)
- Icons: Bootstrap Icons
- Version Control: Git

