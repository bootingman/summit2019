#!/bin/sh

ENVIRONMENT="${1}"
if [ -z "${ENVIRONMENT}" ]; then
    ENVIRONMENT=staging
fi


TAG=

if [ "${ENVIRONMENT}" = "production" ]; then
    TAG="${CIRCLE_TAG}"
else
    TAG="${CIRCLE_SHA1}"
fi

/scripts/deploy.sh -t helm -a "--set image.tag=${TAG} --set environment=${ENVIRONMENT} summit2019 ./charts/summit2019"
