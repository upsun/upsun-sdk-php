#!/usr/bin/env bash
set -eo pipefail  # Exit immediately if any command fails and show errors in pipelines

# Configuration variables
DEBUG=false          # Debug mode flag
PKG="apisgen"        # Output package directory name
SPEC_FILE="./schema/openapispec-platformsh.json"  # OpenAPI specification file path
TEMP_SPEC="./schema/temp_openapispec.json"       # Temporary file for spec processing

# Parse command line arguments
while [[ $# -gt 0 ]]; do
  case "$1" in
    --debug)
      DEBUG=true     # Enable debug mode
      shift          # Move to next argument
      ;;
    *)
      echo "Unknown argument: $1"  # Handle unknown arguments
      exit 1
      ;;
  esac
done

# Cleanup function to remove temporary files
cleanup() {
  echo "Cleaning up temporary files..."
  rm -rf "${TEMP_SPEC}" 2>/dev/null || true  # Silently remove temp file if exists
}
trap cleanup EXIT  # Ensure cleanup runs on script exit

# Prepare fresh build environment
echo "Cleaning old build artifacts..."
rm -rf ./schema/* ./"${PKG}"/*  # Remove previous build files

# Get OpenAPI specification
echo "Downloading OpenAPI specification..."
cp ./data/openapispec-platformsh.json "${SPEC_FILE}"  # Copy spec file to working directory

# Process specification file
echo "Applying hotfixes to OpenAPI specification..."
# Use temp file to avoid direct modification of original
cp "${SPEC_FILE}" "${TEMP_SPEC}"

# Platform-independent sed operation with backup file
sed -i.bak 's/HTTP access permissions/Http access permissions/g' "${TEMP_SPEC}"
rm -f "${TEMP_SPEC}.bak"  # Remove backup file
mv "${TEMP_SPEC}" "${SPEC_FILE}"  # Replace original with modified version

# Verify changes were applied
echo "Verifying specification changes..."
if grep -q 'HTTP access permissions' "${SPEC_FILE}"; then
  echo "Warning: Some HTTP strings might remain unchanged"  # Log warning if replacements failed
fi

# Ensure openapi-generator is available
echo "Setting up openapi-generator..."
OPENAPI_GENERATOR=""
if command -v openapi-generator-cli &>/dev/null; then
  # Use globally installed version if available
  OPENAPI_GENERATOR="openapi-generator-cli"
elif [ -f "vendor/bin/openapi-generator-cli" ]; then
  # Fall back to composer-installed version
  OPENAPI_GENERATOR="vendor/bin/openapi-generator-cli"
else
  # Install globally if no version found
  echo "Installing @openapitools/openapi-generator-cli globally..."
  npm install -g @openapitools/openapi-generator-cli
  OPENAPI_GENERATOR="openapi-generator-cli"
fi

# Generate API client code
echo "Generating API client code..."
GEN_CMD=(
  "$OPENAPI_GENERATOR" generate  # Base command
  -i "${SPEC_FILE}"             # Input specification
  -g php                        # PHP language target
  -o "${PKG}"                   # Output directory
  --library="psr-18"            # PSR-18 HTTP client
)

# Add quiet flag if not in debug mode
if ! $DEBUG; then
  GEN_CMD+=(--quiet)  # Suppress output in non-debug mode
fi

# Execute the generation command
"${GEN_CMD[@]}"

# Clean up unnecessary generated files
echo "Cleaning up generated artifacts..."
rm -rf \
  "${PKG}/git_push.sh" \     # Remove unnecessary helper script
  "${PKG}/.gitignore" \      # Remove default gitignore
  "${PKG}/.travis.yml" \     # Remove CI configuration
  "${PKG}/composer.json"     # Remove generated composer file

echo "API client generation completed successfully!"
