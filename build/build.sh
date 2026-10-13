#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."
VER=$(grep -oPm1 '(?<=<version>)[^<]+' src/plg_system_adminkey/adminkey.xml)
mkdir -p dist
rm -f "dist/plg_adminkey_v$VER.zip"
(cd src/plg_system_adminkey && zip -qr "../../dist/plg_adminkey_v$VER.zip" .)
echo "Built dist/plg_adminkey_v$VER.zip"
