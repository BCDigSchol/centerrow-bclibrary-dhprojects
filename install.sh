set -e

RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# The directory where this script is.
SCRIPT_DIR=$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" &>/dev/null && pwd)

# The theme to modify
TARGET_DIR=$1
TARGET_CONFIG="$TARGET_DIR/config/theme.ini"

main() {

  # Make sure both the target and source directories are valid themes.
  validate_theme "$TARGET_DIR" "$TARGET_CONFIG"
  validate_theme "$SCRIPT_DIR" "${SCRIPT_DIR}/config/theme.ini"

  create_directories

  echo "${YELLOW}Copying helper functions...${NC}"
  cp -r "${SCRIPT_DIR}/helper/" "${TARGET_DIR}/helper/"

  # Copy show-selector view files
  echo "${YELLOW}Copying show-selector files...${NC}"
  cp -r "${SCRIPT_DIR}/view/common/show-selector/" "${TARGET_DIR}/view/common/show-selector/"

  # Copy the browse preview
  echo "${YELLOW}Copying browse-preview-custom.phtml...${NC}"
  cp "${SCRIPT_DIR}/view/common/block-layout/browse-preview-custom.phtml" "${TARGET_DIR}/view/common/block-layout/browse-preview-custom.phtml"

  echo "${YELLOW}Copying item view files...${NC}"
  TARGET_SHOW_FILE="${TARGET_DIR}/view/omeka/site/item/show.phtml"
  if [ -f "$TARGET_SHOW_FILE" ]; then
    echo "\tMoved existing show.phtml to show-original.phtml"
    cp "$TARGET_SHOW_FILE" "${TARGET_DIR}/view/omeka/site/item/show-original.phtml"
  else
    cp "${SCRIPT_DIR}/view/omeka/site/item/show-original.phtml" "${TARGET_DIR}/view/omeka/site/item/show-original.phtml"
  fi
  cp "${SCRIPT_DIR}/view/omeka/site/item/show.phtml" "$TARGET_SHOW_FILE"

  echo "${YELLOW}Copying CSS...${NC}"
  cp "${SCRIPT_DIR}/asset/css/style.local.css" "${TARGET_DIR}/asset/css/style.local.css"
  cp "${SCRIPT_DIR}/asset/css/local-no-sass.css" "${TARGET_DIR}/asset/css/local-no-sass.css"

  echo "${YELLOW}Almost complete!${NC}"
  echo "See the README.md for instructions on updating the theme.ini config file"
}

# Make sure the directory we're modifying is actually a theme directory.
validate_theme() {
  if [ ! -d "$1" ]; then
    echo "${RED}view directory $1 does not exist${NC}"
    exit 1
  fi

  if [ ! -f "$2" ]; then
    echo "${RED}$1 is not a valid theme directory${NC}"
    exit 1
  fi
}

# Create any directories we might be missing.
create_directories() {
  # Create any missing directories we need
  echo "${YELLOW}Creating directories...${NC}"
  mkdir -p "$TARGET_DIR/asset/css"
  mkdir -p "$TARGET_DIR/helper"
  mkdir -p "$TARGET_DIR/view/common/show-selector"
  mkdir -p "$TARGET_DIR/view/common/block-layout"
  mkdir -p "$TARGET_DIR/view/layout"
  mkdir -p "$TARGET_DIR/view/omeka/site/item"
}

main "$@"

# Create necessary directories.
