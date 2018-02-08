setup() {
    apk add --no-cache jq sudo $@
}

download_executable() {
    filename="$1"
    url="$2"
    curl --silent --location --output $filename $url
    chmod +x $filename
}

export CI_DIR=$(dirname "$(readlink -f $0)")
export SCRIPTS_DIR="$CI_DIR/scripts"
export SRC_DIR=$(readlink -f "$CI_DIR/..")

set -e -x