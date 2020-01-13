FROM python:3.8.1-alpine3.11

RUN apk update && apk add postgresql-dev gcc python3-dev musl-dev

EXPOSE 8000

COPY . /app/

WORKDIR /app/

RUN pip install -r requirements.lock

WORKDIR /app/openrpg/

ENTRYPOINT ["/app/entry.sh"]
CMD ["run"]
