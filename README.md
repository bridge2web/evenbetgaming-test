Install
docker compose up
cat dump.sql | docker exec -i CONTAINER /usr/bin/mysql -u username --password=password evenbetgaming-test

GET /cooks: получение постранично списка всех поваров;
HEAD /cooks: получение метаданных листинга поваров;
POST /cooks: создание нового повара;
GET /cooks/123: получение информации по конкретному повару с id равным 123;
HEAD /cooks/123: получение метаданных по конкретному повару с id равным 123;
PATCH /cooks/123 и PUT /cooks/123: изменение информации по повару с id равным 123;
DELETE /cooks/123: удаление повара с id равным 123;
OPTIONS /cooks: получение поддерживаемых методов, по которым можно обратится к /cooks;
OPTIONS /cooks/123: получение поддерживаемых методов, по которым можно обратится к /cooks/123.

То же самое:
dish - блюда
order - чеки

POST orders/<id:\d+>/dishes/<dishId:\d+> - добавление блюда к заказу
GET cooks/popular - список популярных поваров