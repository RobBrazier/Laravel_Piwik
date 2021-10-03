#!/bin/bash
set -exo pipefail

ftp_url="ftp://$BUNNYCDN_USERNAME:$BUNNYCDN_PASSWORD@storage.bunnycdn.com"

cd public

mkdir -p bunnycdn_errors
mv 404.html bunnycdn_errors/

ftp_options="--reverse --no-perms --transfer-all --overwrite"

lftp "$ftp_url" -e "mirror --dry-run $ftp_options --delete; bye" > ../to-delete.txt

to_delete=$(grep rm ../to-delete.txt | awk -F"$BUNNYCDN_USERNAME/" '{ print $2 }' || true)

lftp "$ftp_url" -e "mirror $ftp_options --verbose; bye"

lftp_command=""
for f in $to_delete; do
    lftp_command="rm -r $f; $lftp_command"
done
if [ -n "$lftp_command" ]; then
    lftp "$ftp_url" -e "$lftp_command bye"
fi