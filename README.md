# Admin Secret Key (`plg_system_adminkey`)

A tiny Joomla 4 / 5 / 6 system plugin that hides the administrator login behind a secret word.
Visiting `/administrator/` without the key redirects to your homepage (or a URL you choose).
Built for the S.O.D. Dojazdów site (dojazdowdzialki.pl).

## How it works

- No key: `/administrator/` redirects away.
- With key: `/administrator/?YourSecretKey` lets you through and remembers you for the whole session.
- After a normal Joomla login you don't need the key on every click.

## Install

1. System → Install → Extensions → upload `plg_adminkey_v<ver>.zip`.
2. System → Plugins → search **Admin Secret Key** → open it.
3. Set a **Secret key** (letters and digits, e.g. `G7kx92mQ`) and optionally a **Redirect URL**.
4. Enable it and save.

> **Bookmark `https://your-site/administrator/?YourSecretKey` before enabling**, or you will lock yourself out.

## Lockout recovery

- **FTP / file manager:** rename `plugins/system/adminkey/` (or add `return;` at the start of `onAfterInitialise()` in `adminkey.php`).
- **Database:** `UPDATE #__extensions SET enabled = 0 WHERE element = 'adminkey' AND folder = 'system';`
- **Local Docker:** `docker exec joomla_app mv /var/www/html/plugins/system/adminkey /var/www/html/plugins/system/adminkey.off`

## Good to know

- Use only letters and digits in the key: PHP rewrites `.` and spaces in parameter names, so such keys never match.
- The key travels in the URL, so it can appear in browser history and server logs. This is a cheap extra layer that keeps bots off the login page — it does not replace strong passwords and 2FA.
- Empty key = protection off.

## Repository layout

```
src/plg_system_adminkey/   plugin source (edit only here)
build/build.sh             builds dist/plg_adminkey_v<version>.zip
build/dev-deploy.sh        copies changes into the local Joomla container
updates/                   Joomla update-server XML
docs/CHANGELOG.md          release notes
.vscode/                   build + deploy task (Ctrl+Shift+B)
CLAUDE.md                  contributor rules / definition of done
```

## Development

1. Local Joomla in Docker (`joomla_app`, http://localhost:8080).
2. `./build/build.sh`, install `dist/plg_adminkey_v<ver>.zip` once.
3. Edit the source, press **Ctrl+Shift+B**, reload.
4. Reinstall the zip when `adminkey.xml` changes.

Override the target with `JOOMLA_CONTAINER` and `JOOMLA_ROOT`.

## Releasing

Bump the version (see `CLAUDE.md`), build, then
`gh release create vX.Y.Z dist/plg_adminkey_vX.Y.Z.zip`.

## License

GNU General Public License version 2 or later. See [LICENSE](LICENSE). Copyright (C) 2026 JOD.
