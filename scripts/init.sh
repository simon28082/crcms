#!/usr/bin/env bash
set -euxo pipefail

export APP_SERVICES_CACHE="$(dirname $0)/../storage/bootstrap/services.php"
export APP_PACKAGES_CACHE="$(dirname $0)/../storage/bootstrap/packages.php"