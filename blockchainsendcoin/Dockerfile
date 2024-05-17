FROM node:18 AS nodejs

WORKDIR /app

COPY ./package*.json .

RUN npm install

COPY . .

CMD ["bash"]
