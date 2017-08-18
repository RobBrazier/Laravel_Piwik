#!/bin/bash
scanner_download="https://sonarsource.bintray.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-3.0.3.778-linux.zip"
wget -O /tmp/scanner.zip $scanner_download
unzip /tmp/scanner.zip -d /tmp
executable="$(ls /tmp/sonar*/bin/sonar-scanner)"
version="$(jq -M -r '.version' composer.json)"
cmd="$executable -Dsonar.projectVersion=$version"
# if [[ "$SEMAPHORE_REPO_SLUG" == "RobBrazier/Laravel_Piwik" ]]; then
#   pr_num="$(curl https://api.github.com/repos/RobBrazier/Laravel_Piwik/pulls?head=RobBrazier:$BRANCH_NAME | jq .[0].number)"
#   if [[ "$pr_num" -ne "null" ]]; then
#     CHANGE_ID="$pr_num"
#   fi
# fi
[[ "$BRANCH_NAME" == "master" ]] || cmd="$cmd -Dsonar.analysis.mode=preview"
[[ "$CHANGE_ID" == "" ]] || cmd="$cmd -Dsonar.github.pullRequest=$PULL_REQUEST_NUMBER"
[[ "$SONAR_TOKEN" == "" ]] || cmd="$cmd -Dsonar.login=$SONAR_TOKEN"
[[ "$GITHUB_TOKEN" == "" ]] || cmd="$cmd -Dsonar.github.oauth=$GITHUB_TOKEN"

exec $cmd
