#!/usr/bin/env bash
set -euo pipefail
C=${JOOMLA_CONTAINER:-joomla_app}
ROOT=${JOOMLA_ROOT:-/var/www/html}
S="$(dirname "$0")/../src/plg_system_adminkey"
P="$ROOT/plugins/system/adminkey"

docker exec "$C" mkdir -p "$P"
docker cp "$S/adminkey.php" "$C:$P/"
for d in "$S"/language/*/; do
  docker cp "$d." "$C:$ROOT/administrator/language/$(basename "$d")/"
done

docker exec "$C" bash -c "
  chown -R www-data:www-data '$P' &&
  chown www-data:www-data '$ROOT'/administrator/language/*/*plg_system_adminkey* &&
  chmod -R u+rwX,go+rX '$P' &&
  chmod 664 '$ROOT'/administrator/language/*/*plg_system_adminkey*"
echo "Deployed. Reload the plugin page (Ctrl+F5)."
