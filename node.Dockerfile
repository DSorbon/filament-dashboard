FROM node:18.16.0-alpine3.17

LABEL authors="dsorbon"

RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd
