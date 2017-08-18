#!/bin/bash

env
# sed -i 's/\/app/\/data/g' coverage.xml
# version="$(jq -M -r '.version' composer.json)"
# cmd="docker run -it -v $(pwd):/data letsdeal/sonar-scanner:2.8 -Dsonar.projectVersion=$version"
# if [[ "$SEMAPHORE_REPO_SLUG" == "RobBrazier/Laravel_Piwik" ]]; then
#   pr_num="$(curl https://api.github.com/repos/RobBrazier/Laravel_Piwik/pulls?head=RobBrazier:$BRANCH_NAME | jq .[0].number)"
#   if [[ "$pr_num" -ne "null" ]]; then
#     CHANGE_ID="$pr_num"
#   fi
# fi
# [[ "$BRANCH_NAME" == "master" ]] || cmd="$cmd -Dsonar.analysis.mode=preview"
# [[ "$CHANGE_ID" == "" ]] || cmd="$cmd -Dsonar.github.pullRequest=$PULL_REQUEST_NUMBER"
#
# exec $cmd
