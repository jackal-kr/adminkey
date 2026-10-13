# Admin Secret Key — working rules

- Edit only `src/plg_system_adminkey/`. Never edit a zip or `dist/`.
- Build: `./build/build.sh` → `dist/plg_adminkey_v<ver>.zip`. Local deploy: `./build/dev-deploy.sh` (Ctrl+Shift+B).
- Reinstall the zip when `adminkey.xml` changes.

## Definition of done
1. Bump `<version>` in `adminkey.xml` and `updates/adminkey.xml`; add a `docs/CHANGELOG.md` entry.
2. New text goes into both languages (en-GB, pl-PL), `.ini` and `.sys.ini`, with identical keys.
3. Source files keep the `@package / @copyright / @license` header.
4. Never weaken the check: no key → redirect; verified flag lives only in the session.
5. `php -l` and XML well-formedness pass; test lockout recovery after any change to `onAfterInitialise()`.
