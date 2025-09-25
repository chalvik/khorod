RET=1
ATTEMPT=1
until [[ ${RET} -eq 0 || ${ATTEMPT} -gt 3 ]]; do
    echo Attempt ${ATTEMPT}
    sleep 10
    php /app/yii2-kg-checkpoints/tests/bin/yii migrate --interactive=0
    RET=$?
    ((ATTEMPT++))
done
