BASE_DIR=$(cd $(dirname $0) && pwd)
docker build -t pdmweb $BASE_DIR
