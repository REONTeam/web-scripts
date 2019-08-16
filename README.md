# Web Scripts

[![License: AGPL v3](https://img.shields.io/badge/License-AGPL%20v3-blue.svg)](https://www.gnu.org/licenses/agpl-3.0)

This repository will hold general scripts for various titles, such as Pokémon Crystal and Mobile Trainer. Ensure that, on your server, Windows line encodings are used to ensure the Game Boy Color can correctly read index files.

## Setup

- Set your server root to the webroot folder, and the base to the html folder (if using Apache, `DocumentRoot /path/to/webroot/html`).
- Edit core-example.php for your server id (must be 4 characters) and domain, as well as your MySQL username/pass/db.
- Ensure all index.txt files use Windows line returns; on Unix systems, use `unix2dos` to do this.
