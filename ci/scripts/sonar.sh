#!/usr/bin/env bash
set -x
scanner_download="https://sonarsource.bintray.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-3.0.3.778.zip"
wget -qO /tmp/scanner.zip $scanner_download
unzip -q /tmp/scanner.zip -d /tmp
rm /tmp/scanner.zip
executable="$(ls /tmp/sonar*/bin/sonar-scanner)"
version="$(jq -M -r '.version' composer.json)"
cmd="$executable -Dsonar.projectVersion=$version"
if [[ "$SEMAPHORE_REPO_SLUG" == "RobBrazier/Laravel_Piwik" ]]; then
  pr_num="$(curl https://api.github.com/repos/RobBrazier/Laravel_Piwik/pulls?head=RobBrazier:$BRANCH_NAME | jq .[0].number)"
  if [[ "$pr_num" -ne "null" ]]; then
    PULL_REQUEST_NUMBER="$pr_num"
  fi
fi
sed "s/\$SONAR_TOKEN/$SONAR_TOKEN/g" sonar-project.properties
sed "s/\$GITHUB_TOKE/$GITHUB_TOKEN/g" sonar-project.properties
[[ "$BRANCH_NAME" == "master" ]] || cmd="$cmd -Dsonar.analysis.mode=issues"
[[ "$PULL_REQUEST_NUMBER" == "" ]] || cmd="$cmd -Dsonar.github.pullRequest=$PULL_REQUEST_NUMBER"
# [[ "$SONAR_TOKEN" == "" ]] || cmd="$cmd -Dsonar.login=$SONAR_TOKEN"
# [[ "$GITHUB_TOKEN" == "" ]] || cmd="$cmd -Dsonar.github.oauth=$GITHUB_TOKEN"

exec $cmd
