#!/usr/bin/env bash
#set -x

cd ../

if [ ${TRAVIS_BRANCH} == 'master' ]; then
    echo "Deploying master"
    rsync -uahP --exclude='tests' --exclude='vendor' --exclude='bin' --exclude='logs' --exclude={.*,*.json,*.enc,*.bat,*.txt,*.rst,*.md,*.lock,database.php,config.php} dataManager/ "$REMOTE_USER@$SERVER_IP:$MASTER_REMOTE_PATH"
    rsync -uahP --exclude='tests' --exclude='vendor' --exclude='bin' --exclude='logs' --exclude={.*,*.json,*.enc,*.bat,*.txt,*.rst,*.md,*.lock,database.php,config.php} dataManager/ "$REMOTE_USER@$SERVER_IP:$LIVE2_REMOTE_PATH"
    echo "Finished deploying ${TRAVIS_BRANCH} branch"
elif [ ${TRAVIS_BRANCH} == 'env/production' ]; then
    echo "Deploying staging env"
    rsync -uahP --exclude='tests' --exclude='vendor' --exclude='bin' --exclude='logs' --exclude={.*,*.json,*.enc,*.bat,*.txt,*.rst,*.md,*.lock,database.php,config.php} dataManager/ "$REMOTE_USER@$SERVER_IP:$STAGING_REMOTE_PATH"
    echo "Finished deploying ${TRAVIS_BRANCH} branch"
elif [ ${TRAVIS_BRANCH} == 'development' ]; then
    echo "Deploying dev"
    rsync -uahP --exclude='tests' --exclude='vendor' --exclude='bin' --exclude='logs' --exclude={.*,*.json,*.enc,*.bat,*.txt,*.rst,*.md,*.lock,database.php,config.php} dataManager/ "$REMOTE_USER@41.73.194.139:$REMOTE_PATH/sandbox"
    echo "Finished deploying ${TRAVIS_BRANCH} branch"
fi