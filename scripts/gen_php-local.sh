#!/usr/bin/bash

DEBUG=false

# check arguments
for arg in "$@"; do
  if [ "$arg" == "--debug" ]; then
    DEBUG=true
    break
  fi
done

echo "Clean old build..."
rm -rf ./schema/*
rm -rf ./apisgen/*

echo "Download last openAPI spec..."
#wget -O ./schema/openapispec-platformsh.json https://api.upsun.com/docs/openapispec-platformsh.json
cp ./data/openapispec-platformsh.json ./schema/
echo "Hotfix openAPI spec..."
sed -i '' 's/HTTP access permissions/Http access permissions/g' ./schema/openapispec-platformsh.json

echo "Generate apis_gen code..."
npm install @openapitools/openapi-generator-cli -g

PKG="apisgen"
export GIT_USER_ID=upsun
export GIT_REPO_ID=upsun-sdk-go

if $DEBUG; then
  openapi-generator-cli generate \
    -i ./schema/openapispec-platformsh.json \
    -g php \
    -o "$PKG" \
    --additional-properties=apiPackage="$PKG"
else
  openapi-generator-cli generate \
    -i ./schema/openapispec-platformsh.json \
    -g php \
    -o "$PKG" \
    --additional-properties=apiPackage="$PKG" &> /dev/null
fi

echo "Clean up unnecessary files..."
rm -rf ./$PKG/git_push.sh ./$PKG/.gitignore ./$PKG/.travis.yml ./$PKG/composer.json
# --global-property=models,apis,apiDocs,modelDocs,apiTests,modelTests,supportingFiles \
# ,supportingFiles