#!/bin/bash

ENVIRONMENT=${1:-staging}
TAG=

if [ "$ENVIRONMENT" = "production" ]; then
    TAG="${CIRCLE_TAG}"
else
    TAG="${CIRCLE_SHA1}"
fi

/scripts/deploy.sh helm \
                   --set image.tag="${TAG}" \
                   --set environment="${ENVIRONMENT}" \
                   summit2019 \
                   ./charts/summit2019
