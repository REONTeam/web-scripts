# REON Web Scripts
[![License: AGPL v3](https://img.shields.io/badge/License-AGPL%20v3-blue.svg)](https://www.gnu.org/licenses/agpl-3.0)

This repository is for the web-server side of REON's Game Boy Color code; this will include scripts for all games we support that need relevant scripts, as well as some common info.

These files should be usable in their present state.

## Setup

- Set your server root correctly to the webroot/html folder. An example nginx config is supplied, but this should work with Apache as well.
- Edit core-example.php for your server id (must be 4 characters) and domain, as well as your MySQL username/pass/db.
- Ensure all index.txt files use Windows line returns; on Unix systems, use `unix2dos` to do this. If this is not the case, the Game Boy Color may error.
