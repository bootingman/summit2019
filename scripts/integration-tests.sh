#!/bin/bash

source /scripts/common.sh
source /scripts/bootstrap-helm.sh


run_tests() {
    echo Running tests...

    wait_pod_ready summit2019
}

teardown() {
    helm delete summit2019
}

main(){
    if [ -z "$KEEP_W3F_SUMMIT2019" ]; then
        trap teardown EXIT
    fi

    /scripts/build-helm.sh \
        --set environment=ci \
        --set image.tag="${CIRCLE_SHA1}" \
        summit2019 \
        ./charts/summit2019

    run_tests
}

main
